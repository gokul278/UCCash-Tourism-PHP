<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "login") {

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "getData") {

        $response = [];

        $response["admin_name"] = $values["admin_name"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");
        $getdetails = $details->fetch_assoc();
        $response["profile_image"] = $getdetails["admin_profile"];

        // Get data as array
        $historydata = $con->query("
    SELECT iah.*, ud.user_name
    FROM idactivationhistory AS iah
    JOIN userdetails AS ud ON iah.user_id = ud.user_id
    WHERE iah.action = 'admin'
");

        $data = [];
        foreach ($historydata as $row) {
            $data[] = [
                "idactivation_id" => $row["idactivation_id"],
                "paid_date"       => $row["paid_date"],
                "user_id"         => $row["user_id"],
                "user_name"       => $row["user_name"],
                "deposite_type"   => $row["deposite_type"],
                "crypto_value"    => $row["crypto_value"],
                "txnhash_id"      => $row["txnhash_id"],
                "bank_value"      => $row["bank_value"],
                "transaction_id"  => $row["transaction_id"],
                "proof_image"     => $row["proof_image"]
            ];
        }

        $response["table_rows"] = $data;
        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "rejectactivation") {

        $userid = $_POST["userid"];
        $activationid = $_POST["activationid"];
        $reason = $_POST["reason"];

        $rejectactivation = $con->query("DELETE FROM idactivation WHERE idactivation_id='{$activationid}'");

        $rejecthistory = $con->query("UPDATE idactivationhistory SET action='reject', remark='{$reason}' WHERE idactivation_id='{$activationid}'");

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "approveactivation") {

        $userid = $_POST["userid"];
        $activationid = $_POST["activationid"];

        //Reward bonus Checking
        $getSponserId = $con->query("SELECT user_sponserid FROM userdetails WHERE user_id='{$userid}'");
        $getSponserId = $getSponserId->fetch_assoc();

        $sponserid = $getSponserId["user_sponserid"];

        $sponser = $con->query("SELECT * FROM userdetails WHERE user_id='{$sponserid}'");
        $getsponser = $sponser->fetch_assoc();

        if ($getsponser["user_referalStatus"] == "activated") {
            $checkrewardbonus = $con->query("SELECT * FROM rewardbonus WHERE user_id='{$sponserid}' ORDER BY rb_id DESC LIMIT 1");

            if ($checkrewardbonus && $checkrewardbonus->num_rows >= 1) {
                $rewardRow = $checkrewardbonus->fetch_assoc();

                $userCount = 0;

                if ($rewardRow["rb_usercount"]) {
                    $userCount = $rewardRow["rb_usercount"];
                }

                $userCount += 1;

                if ($rewardRow["rb_usercount"] == 4) {
                    $UpdateRewardBonus = $con->query("UPDATE rewardbonus SET rb_point=25, rb_description='Reached Reward Bonus', rb_usercount='{$userCount}' WHERE rb_id='{$rewardRow["rb_id"]}'");
                    $RewardAddAWB = $con->query("INSERT INTO availablewithdrwabalance (user_id,awb_from,awb_to,awb_points,awb_action) VALUES ('{$sponserid}','Reward Bonus','Available Withdraw Balance','25','credit')");
                } else {
                    $UpdateRewardBonus = $con->query("UPDATE rewardbonus SET rb_usercount='{$userCount}' WHERE rb_id='{$rewardRow["rb_id"]}'");
                }
            }
        }

        $lvl1 = "";
        $lvl2 = "";
        $lvl3 = "";
        $lvl4 = "";
        $lvl5 = "";
        $lvl6 = "";
        $lvl7 = "";
        $lvl8 = "";
        $lvl9 = "";

        $genealogy = $con->query("SELECT * FROM genealogy WHERE user_id='{$userid}'");

        foreach ($genealogy as $getgenealogy) {
            $lvl1 = isset($getgenealogy["lvl1"]) ? $getgenealogy["lvl1"] : "";
            $lvl2 = isset($getgenealogy["lvl2"]) ? $getgenealogy["lvl2"] : "";
            $lvl3 = isset($getgenealogy["lvl3"]) ? $getgenealogy["lvl3"] : "";
            $lvl4 = isset($getgenealogy["lvl4"]) ? $getgenealogy["lvl4"] : "";
            $lvl5 = isset($getgenealogy["lvl5"]) ? $getgenealogy["lvl5"] : "";
            $lvl6 = isset($getgenealogy["lvl6"]) ? $getgenealogy["lvl6"] : "";
            $lvl7 = isset($getgenealogy["lvl7"]) ? $getgenealogy["lvl7"] : "";
            $lvl8 = isset($getgenealogy["lvl8"]) ? $getgenealogy["lvl8"] : "";
            $lvl9 = isset($getgenealogy["lvl9"]) ? $getgenealogy["lvl9"] : "";
        }

        $idactivationhistory = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$userid}' AND action='admin'");
        $getidactivationhistory = $idactivationhistory->fetch_assoc();
        $tcvalue = (int) $getidactivationhistory["travel_coupon"];

        //Travel Coupon Wallet
        $travelcoupon = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
        VALUES ('{$userid}','{$tcvalue}','credit','Travel Coupon')");

        //Travel Coupon Convert to Available amount for Level 1
        if (strlen($lvl1) >= 5) {
            //calculate Travel Coupon
            $travelcoupon = $con->query("SELECT * FROM travelcouponpoints WHERE user_id='{$lvl1}'");
            $tccredit = 0;
            $tcdebit = 0;

            if (mysqli_num_rows($travelcoupon) >= 1) {

                foreach ($travelcoupon as $gettravelcoupon) {
                    if (isset($gettravelcoupon["tc_action"]) && strlen($gettravelcoupon["tc_action"]) >= 1) {
                        if ($gettravelcoupon["tc_action"] == "credit") {
                            $tccredit += (float) $gettravelcoupon["tc_points"];
                        } else if ($gettravelcoupon["tc_action"] == "debit") {
                            $tcdebit += (float) $gettravelcoupon["tc_points"];
                        }
                    }
                }
            }

            $lvl1travelCouponBalance = number_format(($tccredit - $tcdebit), 2);

            if ($lvl1travelCouponBalance >= 5.00) {
                $travelcoupondebit = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
                                VALUES ('{$lvl1}','5','debit','Travel Coupon')");
                $availablewithdrawabalance = $con->query("INSERT INTO availablewithdrwabalance (user_id,awb_from,awb_to,awb_points,awb_action)
                                VALUES ('{$lvl1}','Travel Coupon','Available Withdraw Balance','5','credit')");
            }
        }


        //Bonus Travel Point Wallet
        for ($i = 1; $i <= 9; $i++) {

            // $value = $tcvalue * 0.0222; // 2.22 % * tcvalue
            $value = $tcvalue * 0.0166; // 1.66 % * tcvalue

            $lvl = ${"lvl" . $i};

            if (strlen($lvl) >= 5) {
                $btpoint = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_bonusfrom,bt_lvl,bt_action,bt_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Bonus Travel Points')");
            }
        }

        //Networking Income Wallet
        for ($i = 1; $i <= 9; $i++) {

            $value = 0;

            if ($i == 1) { //lvl 1
                $value = $tcvalue * 0.1; // 10% * tcvalue
            } else if ($i == 2) { //lvl 2
                $value = $tcvalue * 0.05; // 5% * tcvalue
            } else if ($i == 3) { //lvl 3
                $value = $tcvalue * 0.03; // 3% * tcvalue
            } else if ($i == 4) { //lvl4
                $value = $tcvalue * 0.02; // 2% * tcvalue
            } else if ($i >= 5 && $i <= 9) {
                $value = $tcvalue * 0.02; // 2% * tcvalue
            }

            $lvl = ${"lvl" . $i};

            if (strlen($lvl) >= 5) {
                $btpoint = $con->query("INSERT INTO networkingincomewallet (user_id,niw_points,niw_bonusfrom,niw_lvl,niw_action,niw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Networking Income')");
            }
        }

        //Leadership Income Wallet
        for ($i = 1; $i <= 9; $i++) {

            $value = $tcvalue * 0.0044; // 0.44 % * tcvalue

            $lvl = ${"lvl" . $i};

            if (strlen($lvl) >= 5) {
                $btpoint = $con->query("INSERT INTO leadershipincomewallet (user_id,liw_points,liw_bonusfrom,liw_lvl,liw_action,liw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Leadership Income')");
            }
        }

        //Car&House Fund Wallet
        for ($i = 1; $i <= 9; $i++) {

            $value = $tcvalue * 0.0055; // 0.55 % * tcvalue

            $lvl = ${"lvl" . $i};

            if (strlen($lvl) >= 5) {
                $btpoint = $con->query("INSERT INTO carandhousefundwallet (user_id,chfw_points,chfw_bonusfrom,chfw_lvl,chfw_action,chfw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Car & House Fund')");
            }
        }

        // //Royalty Income Wallet
        // for ($i = 1; $i <= 9; $i++) {

        //     $value = $tcvalue * 0.0066; // 0.66 % * tcvalue

        //     $lvl = ${"lvl" . $i};

        //     if (strlen($lvl) >= 5) {
        //         $btpoint = $con->query("INSERT INTO royaltyincomewallet (user_id,riw_points,riw_bonusfrom,riw_lvl,riw_action,riw_remark)
        //         VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Royalty Income')");
        //     }
        // }

        $approveactivation = $con->query("UPDATE idactivation SET action='paid', remark='' WHERE idactivation_id='{$activationid}'");

        $approvehistory = $con->query("UPDATE idactivationhistory SET action='paid', remark='Activation Successful' WHERE idactivation_id='{$activationid}'");

        $approveuserdeatils = $con->query("UPDATE userdetails SET user_referalStatus='activated' WHERE user_id='{$userid}'");


        $response["status"] = "success";
        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
