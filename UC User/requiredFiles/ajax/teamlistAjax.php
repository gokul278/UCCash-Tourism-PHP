<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "login") {

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "getflashbanner") {

        $getflashbanner = $con->query("SELECT * FROM flashbanner WHERE id=1");

        $flashbanner = $getflashbanner->fetch_assoc();

        $response["status"] = "success";
        $response["flashbanner"] = $flashbanner["bannerimage"];
        echo json_encode($response);
    } else if ($way == "getData") {

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            $tabledata = '';
            $index = 0;

            // Loop through levels 1 to 9
            for ($lvls = 1; $lvls <= 9; $lvls++) {

                $levelColumn = "lvl{$lvls}";

                // Fetch genealogy with userdetails for current level
                $result = $con->query("
                SELECT u.user_id, u.user_name, u.user_referalStatus
                FROM genealogy g
                JOIN userdetails u ON u.user_id = g.user_id
                WHERE g.{$levelColumn} = '{$values["userid"]}' AND u.user_referalStatus = 'activated'
                ");

                while ($getuserdetails = $result->fetch_assoc()) {
                    $index++;

                    // Count direct & total activated team members for this user
                    $teamMemberCount = 0;
                    $directTeamIds = [];

                    for ($lvlCount = 1; $lvlCount <= 9; $lvlCount++) {
                        $col = "lvl{$lvlCount}";

                        $result11 = $con->query("
                        SELECT g.user_id
                        FROM genealogy g
                        JOIN userdetails u ON u.user_id = g.user_id
                        WHERE g.{$col} = '{$getuserdetails["user_id"]}' 
                          AND u.user_referalStatus = 'activated'
                    ");

                        while ($row = $result11->fetch_assoc()) {
                            $teamMemberCount++;
                            if ($lvlCount === 1) {
                                $directTeamIds[] = $row["user_id"];
                            }
                        }
                    }

                    // Determine final rank
                    $directCount = count($directTeamIds);
                    if ($directCount >= 5 && $teamMemberCount >= 3125) {
                        $final_rank = "Universal Crow Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 625) {
                        $final_rank = "Diamond Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 125) {
                        $final_rank = "Gold Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 25) {
                        $final_rank = "Silver Director";
                    } elseif ($directCount >= 5) {
                        $final_rank = "Director";
                    } else {
                        $final_rank = "-";
                    }

                    // Build table row
                    $tabledata .= "
                <tr>
                    <th scope='row'>{$index}</th>
                    <td>{$getuserdetails["user_id"]}</td>
                    <td>{$getuserdetails["user_name"]}</td>
                    <td style='color:" . ($getuserdetails["user_referalStatus"] == "activated" ? "green" : "red") . "'>"
                        . ($getuserdetails["user_referalStatus"] == "activated" ? "Distributor" : "Member") . "</td>
                    <td>{$lvls}</td>
                    <td>{$final_rank}</td>
                </tr>";
                }
            }

            for ($lvls = 1; $lvls <= 9; $lvls++) {

                $levelColumn = "lvl{$lvls}";

                // Fetch genealogy with userdetails for current level
                $result = $con->query("
                SELECT u.user_id, u.user_name, u.user_referalStatus
                FROM genealogy g
                JOIN userdetails u ON u.user_id = g.user_id
                WHERE g.{$levelColumn} = '{$values["userid"]}' AND u.user_referalStatus != 'activated'
                ");

                while ($getuserdetails = $result->fetch_assoc()) {
                    $index++;

                    // Count direct & total activated team members for this user
                    $teamMemberCount = 0;
                    $directTeamIds = [];

                    for ($lvlCount = 1; $lvlCount <= 9; $lvlCount++) {
                        $col = "lvl{$lvlCount}";

                        $result11 = $con->query("
                        SELECT g.user_id
                        FROM genealogy g
                        JOIN userdetails u ON u.user_id = g.user_id
                        WHERE g.{$col} = '{$getuserdetails["user_id"]}' 
                          AND u.user_referalStatus = 'activated'
                    ");

                        while ($row = $result11->fetch_assoc()) {
                            $teamMemberCount++;
                            if ($lvlCount === 1) {
                                $directTeamIds[] = $row["user_id"];
                            }
                        }
                    }

                    // Determine final rank
                    $directCount = count($directTeamIds);
                    if ($directCount >= 5 && $teamMemberCount >= 3125) {
                        $final_rank = "Universal Crow Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 625) {
                        $final_rank = "Diamond Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 125) {
                        $final_rank = "Gold Director";
                    } elseif ($directCount >= 5 && $teamMemberCount >= 25) {
                        $final_rank = "Silver Director";
                    } elseif ($directCount >= 5) {
                        $final_rank = "Director";
                    } else {
                        $final_rank = "-";
                    }

                    // Build table row
                    $tabledata .= "
                <tr>
                    <th scope='row'>{$index}</th>
                    <td>{$getuserdetails["user_id"]}</td>
                    <td>{$getuserdetails["user_name"]}</td>
                    <td style='color:" . ($getuserdetails["user_referalStatus"] == "activated" ? "green" : "red") . "'>"
                        . ($getuserdetails["user_referalStatus"] == "activated" ? "Distributor" : "Member") . "</td>
                    <td>{$lvls}</td>
                    <td>{$final_rank}</td>
                </tr>";
                }
            }

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
