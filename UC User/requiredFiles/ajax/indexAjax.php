<?php
require "../../../requiredFiles/ajax/DBConnection.php";
require "./verify.php";
$values = token::verify();

function getDaysDifference($givenDate)
{
    $today = new DateTime();
    $inputDate = new DateTime($givenDate);
    $diff = $today->diff($inputDate);
    return $diff->days;
}

// Helper: fetch SUM credit/debit per wallet in one query
function fetchWallet($con, $table, $user_id, $credit_col, $action_col)
{
    $data = ["credit" => 0, "debit" => 0];
    $q = $con->query("SELECT $action_col, SUM($credit_col) AS points FROM $table WHERE user_id='$user_id' GROUP BY $action_col");
    while ($row = $q->fetch_assoc()) {
        if ($row[$action_col] == 'credit') $data['credit'] = (float)$row['points'];
        if ($row[$action_col] == 'debit') $data['debit'] = (float)$row['points'];
    }
    return number_format($data['credit'] - $data['debit'], 2);
}

if ($values["status"] == "success") {
    $way = $_POST["way"];

    if ($way == "login") {
        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "getflashbanner") {
        $flashbanner = $con->query("SELECT bannerimage FROM flashbanner WHERE id=1")->fetch_assoc();
        $response["status"] = "success";
        $response["flashbanner"] = $flashbanner["bannerimage"] ?? "";
        echo json_encode($response);
    } else if ($way == "getData") {
        $user_id = $values["userid"];

        // 1. Fetch all user + genealogy info at once
        $sql = "SELECT u.*, g.lvl1, g.lvl2, g.lvl3, g.lvl4, g.lvl5, g.lvl6, g.lvl7 
                FROM userdetails u 
                LEFT JOIN genealogy g ON u.user_id = g.user_id 
                WHERE u.user_id = '$user_id' LIMIT 1";
        $user = $con->query($sql)->fetch_assoc();

        if (!$user) {
            echo json_encode(['status' => 'fail', 'message' => 'User not found']);
            exit;
        }

        // 2. Fetch static data with single queries
        $news = $con->query("SELECT news FROM latestnews LIMIT 1")->fetch_assoc()['news'] ?? "";
        $galleryimages = [];
        $imgs = $con->query("SELECT imagename FROM galleryimages");
        while ($r = $imgs->fetch_assoc()) $galleryimages[] = $r["imagename"];

        // 3. Wallets: fetch each in 1 query with helper
        $response = [
            "user_id" => $user["user_id"],
            "user_name" => $user["user_name"],
            "user_profileimg" => $user["user_profileimg"],
            "user_sponserid" => $user["user_sponserid"],
            "user_referalStatus" => $user["user_referalStatus"],
            "created_at" => $user["created_at"],
            "galleryimages" => $galleryimages,
            "news" => $news,
            "savingtravel"      => fetchWallet($con, "savingstravelpoints", $user_id, "st_points", "st_action"),
            "bonustravel"       => fetchWallet($con, "bonustravelpoints", $user_id, "bt_points", "bt_action"),
            "travelcoupon"      => fetchWallet($con, "travelcouponpoints", $user_id, "tc_points", "tc_action"),
            "savingsincome"     => fetchWallet($con, "savingsincome", $user_id, "si_points", "si_action"),
            "networkingincome"  => fetchWallet($con, "networkingincomewallet", $user_id, "niw_points", "niw_action"),
            "leadershipincome"  => fetchWallet($con, "leadershipincomewallet", $user_id, "liw_points", "liw_action"),
            "carandhousefund"   => fetchWallet($con, "carandhousefundwallet", $user_id, "chfw_points", "chfw_action"),
            "royaltyincome"     => fetchWallet($con, "royaltyincomewallet", $user_id, "riw_points", "riw_action"),
            "availablewithdrwabalance" => fetchWallet($con, "availablewithdrwabalance", $user_id, "awb_points", "awb_action"),
            "reactivationwallet" => fetchWallet($con, "reactivationwallet", $user_id, "raw_points", "raw_action"),
            "uccwallet"         => fetchWallet($con, "uccwalletpoints", $user_id, "uccw_points", "uccw_action"),
            "tu_points"         => fetchWallet($con, "topup_wallet", $user_id, "tu_points", "tu_action"),
        ];

        // 4. Compute rank using a single query for each level (JOIN + COUNT)
        $final_rank = "Member";
        // $ranks = [
        //     1 => ["name" => "Director",         "min" => 5],
        //     2 => ["name" => "Senior Director",  "min" => 25],
        //     3 => ["name" => "Bronze Director",  "min" => 125],
        //     4 => ["name" => "Silver Director",  "min" => 375],
        //     5 => ["name" => "Gold Director",    "min" => 1500],
        //     6 => ["name" => "Diamond Director", "min" => 5000],
        //     7 => ["name" => "Crow Director",    "min" => 15000],
        // ];

        // $default_rank = $user["user_referalStatus"] == "activated" ? "Distributor" : "Member";

        // // Level counts (all at once)
        // $levels = [];
        // foreach ($ranks as $i => $rk) {
        //     $lvl_col = "lvl$i";
        //     $q = $con->query("
        //         SELECT COUNT(*) AS cnt
        //         FROM genealogy g
        //         JOIN userdetails u ON g.user_id = u.user_id
        //         WHERE g.$lvl_col = '$user_id' AND u.user_referalStatus = 'activated'
        //     ");
        //     $row = $q->fetch_assoc();
        //     $levels[$i] = (int)$row['cnt'];
        //     if ($levels[$i] >= $rk['min']) $final_rank = $rk['name'];
        // }
        // $response["rank"] = $final_rank;

        $teamMemberCount = 0;
        $directTeamIds = [];

        // Loop through levels 1 to 9 to count total team members
        for ($lvls = 1; $lvls <= 9; $lvls++) {
            $levelColumn = "lvl{$lvls}";
            $result = $con->query("
            SELECT
                g.user_id
            FROM
                genealogy g
            JOIN userdetails u ON
                u.user_id = g.user_id
            WHERE
                g.{$levelColumn} = '{$values["userid"]}' AND u.user_referalStatus = 'activated';
            ");

            while ($row = $result->fetch_assoc()) {
                $teamMemberCount++;

                // If it's level 1, collect direct team member IDs
                if ($lvls === 1) {
                    $directTeamIds[] = $row["user_id"];
                }
            }
        }

        if (count($directTeamIds) >= 5 && $teamMemberCount >= 3125) {
            $final_rank = "Universal Crow Director";
        } else if (count($directTeamIds) >= 5 && $teamMemberCount >= 625) {
            $final_rank = "Diamond Director";
        } else if (count($directTeamIds) >= 5 && $teamMemberCount >= 125) {
            $final_rank = "Gold Director";
        } else if (count($directTeamIds) >= 5 && $teamMemberCount >= 25) {
            $final_rank = "Silver Director";
        } else if (count($directTeamIds) >= 5) {
            $final_rank = "Director";
        } else if (count($directTeamIds) < 5) {
            $final_rank = "Member";
        }



        $response["rank"] = $final_rank;
        $response["val1"] = count($directTeamIds);
        $response["val2"] = $teamMemberCount;

        // -- Rankboard Status logic --
        // Helper: get lvlX achieved date
        function getLevelAchievedDate($con, $user_id, $level, $required)
        {
            $col = "lvl$level";
            $q = $con->query("
                SELECT g.user_id
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.$col = '$user_id' AND u.user_referalStatus = 'activated'
                LIMIT $required
            ");
            if ($q->num_rows < $required) return '-';
            // Get activation date of the first user to reach required
            $index = 1;
            while ($row = $q->fetch_assoc()) {
                if ($index == $required) {
                    $h = $con->query("SELECT paid_date FROM idactivationhistory WHERE user_id='{$row['user_id']}' AND remark='Activation Successful' LIMIT 1");
                    return $h->num_rows ? $h->fetch_assoc()["paid_date"] : '';
                }
                $index++;
            }
            return '-';
        }

        // $lvl_dates = [];
        // foreach ($ranks as $i => $rk) {
        //     $lvl_dates[$i] = getLevelAchievedDate($con, $user_id, $i, $rk['min']);
        // }
        // date_default_timezone_set('Asia/Kolkata');
        // $daydifference = getDaysDifference(date('Y-m-d', strtotime($user["created_at"])));
        // $response["rankboardStatus"] = false;
        // // Get eligible reward texts
        // $rewardrow = $con->query("SELECT * FROM eligiblereward LIMIT 1")->fetch_assoc();
        // $rankboard_map = [
        //     1 => ["days" => 31, "hour" => 12, "label" => $rewardrow["lvl1reward"] ?? ""],
        //     2 => ["days" => 61, "hour" => 12, "label" => $rewardrow["lvl2reward"] ?? ""],
        //     3 => ["days" => 91, "hour" => 12, "label" => $rewardrow["lvl3reward"] ?? ""],
        //     4 => ["days" => 121, "hour" => 12, "label" => $rewardrow["lvl4reward"] ?? ""],
        //     5 => ["days" => 151, "hour" => 12, "label" => $rewardrow["lvl5reward"] ?? ""],
        //     6 => ["days" => 181, "hour" => 12, "label" => $rewardrow["lvl6reward"] ?? ""],
        //     7 => ["days" => 211, "hour" => 12, "label" => $rewardrow["lvl7reward"] ?? ""],
        // ];
        // foreach ($rankboard_map as $i => $rb) {
        //     if ($daydifference <= $rb["days"] && (int)date('H') < $rb["hour"] && $lvl_dates[$i] == "-") {
        //         $response["rankboardStatus"] = true;
        //         $response["rankboardDate"] = date('Y-m-d', strtotime($user["created_at"]));
        //         $response["rankboardLabel"] = $rb["label"];
        //         $response["rankboardAchiveDays"] = $rb["days"] - 1;
        //         break;
        //     }
        // }

        //Reward Status
        $rewardstatus = $user["user_referalStatus"];
        $userCount = 0;
        $startdate = "";
        $enddate = "";

        // if ($rewardstatus === "activated") {
            $getRewardBonus = $con->query("SELECT * FROM rewardbonus WHERE user_id = '{$user_id}' ORDER BY rb_id DESC LIMIT 1")->fetch_assoc();
            if ((int)$getRewardBonus["rb_usercount"] >= 5) {
                $rewardstatus = "finished";
            } else if ((int)$getRewardBonus["rb_usercount"] < 5 ||  $getRewardBonus["rb_usercount"]  === null) {
                $rewardstatus = "pending";
            }

            $userCount = $getRewardBonus["rb_usercount"] ?  $getRewardBonus["rb_usercount"] : 0;
            $startdate = $getRewardBonus["rb_start"];
            $enddate = $getRewardBonus["rb_end"];
        // }

        $response["rewardstatus"] = $rewardstatus;
        $response["rewardUsercount"] = $userCount;
        $response["rewardStartdate"] = $startdate;
        $response["rewardEnddate"] = $enddate;

        $response["status"] = "success";
        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {
    echo json_encode([
        "status" => $values["status"],
        "message" => $values["message"]
    ]);
}
