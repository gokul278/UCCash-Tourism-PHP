<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

function getTargetDate(string $startDate, int $days): string
{
    $date = DateTime::createFromFormat('Y-m-d', $startDate);

    if (!$date) {
        throw new Exception("Invalid date format. Expected 'Y-m-d'");
    }

    $date->modify("+{$days} days");

    return $date->format('Y-m-d');
}



if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "login") {

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "getData") {

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        $details = $con->query("SELECT * FROM `eligiblereward`");

        $getdetails = $details->fetch_assoc();

        if (mysqli_num_rows($datares) == 1) {

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

            $tabledata = "";



            $levels = [
                ['dteam' => 5, 'idteam' => 0, 'reward' => $getdetails["lvl1reward"], "rank" => "Director"],
                ['dteam' => 5, 'idteam' => 25, 'reward' => $getdetails["lvl2reward"], "rank" => "Silver Director"],
                ['dteam' => 5, 'idteam' => 125, 'reward' => $getdetails["lvl3reward"], "rank" => "Gold Director"],
                ['dteam' => 5, 'idteam' => 625, 'reward' => $getdetails["lvl4reward"], "rank" => "Diamond Director"],
                ['dteam' => 5, 'idteam' => 3125, 'reward' => $getdetails["lvl5reward"], "rank" => "Universal Crow Director"],
            ];

            foreach ($levels as $index => $level) {
                $lvlvalue =  $index + 1;
                $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$values["userid"]}' AND level{$lvlvalue}reward_status='granted'");

                $award = mysqli_num_rows($check) >= 1 ? "<p style='color:green'>Awared</p>" : "<p style='color:red'>Not Received</p>";
                $tabledata .= "<tr>
                    <th scope='row'>" . ($index + 1) . "</th>
                    <td>" . ($index === 0 ? $level['dteam'] : $level['idteam']) . " " . ($index == 0 ? "Direct TP Team" : "TP Team") . "</td>
                    <td class='" . ((count($directTeamIds) >= $level['dteam'] && $teamMemberCount >= $level['idteam']) ? "green" : "red") . "'>"
                    . ($index == 0 ? count($directTeamIds) : $teamMemberCount)
                    . " " . ($index == 0 ? "Direct TP Team" : "TP Team") .
                    "</td>
                    <td>{$level["rank"]}</td>
                    <td class='" . ((count($directTeamIds) >= $level['dteam'] && $teamMemberCount >= $level['idteam']) ? "green" : "red") . "'>" . ((count($directTeamIds) >= $level['dteam'] && $teamMemberCount >= $level['idteam']) ? "Achieved" : "Not Achieved") . "</td>
                    <td>{$level["reward"]}</td>
                    <td>{$award}</td>
                </tr>";
            }



            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            // $tabledata = "";

            // $levels = [
            //     ['level' => 'lvl1', 'threshold' => 5, 'rank' => 'Director', 'reward' => $getdetails["lvl1reward"], 'days' => 30],
            //     ['level' => 'lvl2', 'threshold' => 25, 'rank' => 'Senior Director', 'reward' => $getdetails["lvl2reward"], 'days' => 60],
            //     ['level' => 'lvl3', 'threshold' => 125, 'rank' => 'Bronze Director', 'reward' => $getdetails["lvl3reward"], 'days' => 90],
            //     ['level' => 'lvl4', 'threshold' => 375, 'rank' => 'Silver Director', 'reward' => $getdetails["lvl4reward"], 'days' => 120],
            //     ['level' => 'lvl5', 'threshold' => 1500, 'rank' => 'Gold Director', 'reward' => $getdetails["lvl5reward"], 'days' => 150],
            //     ['level' => 'lvl6', 'threshold' => 5000, 'rank' => 'Diamond Director', 'reward' => $getdetails["lvl6reward"], 'days' => 180],
            //     ['level' => 'lvl7', 'threshold' => 15000, 'rank' => 'Crow Director', 'reward' => $getdetails["lvl7reward"], 'days' => 210]
            // ];

            // foreach ($levels as $index => $level) {
            //     $query = "
            //         SELECT COUNT(*) as count
            //         FROM genealogy g
            //         JOIN userdetails u ON g.user_id = u.user_id
            //         WHERE g.{$level['level']} = '{$values["userid"]}' AND u.user_referalStatus = 'activated'
            //     ";

            //     $result = $con->query($query);
            //     $row = $result->fetch_assoc();
            //     $count = $row['count'];
            //     $lvlvalue =  $index + 1;

            //     date_default_timezone_set('Asia/Kolkata');

            //     $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$values["userid"]}' AND level{$lvlvalue}reward_status='granted'");

            //     $award = mysqli_num_rows($check) >= 1 ? "<p style='color:green'>Awared</p>" : "<p style='color:red'>Not Received</p>";

            //     $response["lvl" . ($index + 1) . "count"] = getTargetDate(date('Y-m-d', strtotime($datarow["created_at"])), $level["days"]);
            //     $tabledata .= "<tr>
            //         <th scope='row'>" . ($index + 1) . "</th>
            //         <th>{$level['threshold']}</th>
            //         <td class='" . ($count >= $level['threshold'] ? "green" : "red") . "'>" . $count . "</td>
            //          <td class='lvl" . ($index + 1) . "count'></td>
            //         <td>{$level['rank']}</td>
            //         <td class='" . ($count >= $level['threshold'] ? "green" : "red") . "'>" . ($count >= $level['threshold'] ? "Achieved" : "Not Achieved") . "</td>
            //         <td>{$level['reward']}</td>
            //         <td>{$award}</td>
            //     </tr>";
            // }


            $response["tabledata"] = $tabledata;

            $response["status"] = "success";
            echo json_encode($response);
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
