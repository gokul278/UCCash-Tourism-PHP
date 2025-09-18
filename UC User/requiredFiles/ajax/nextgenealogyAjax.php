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

        $nextid = $_POST["nextid"];

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            $gettitle = $con->query("SELECT * FROM userdetails WHERE user_id='{$nextid}'");
            $rowgettitle = $gettitle->fetch_assoc();

            $response["nextname"] = $rowgettitle["user_name"];
            $response["nextid"] = $rowgettitle["user_id"];
            $response["nextprofileimage"] = $rowgettitle["user_profileimg"];

            if ($rowgettitle["user_referalStatus"] == "notactivated") {

                $response["activation"] = "false";
            } else if ($rowgettitle["user_referalStatus"] == "activated") {

                $tree = "";

                $lvl1sponser = $con->query("
                    SELECT
                        *
                    FROM
                        genealogy g
                        JOIN userdetails u ON u.user_id = g.user_id
                    WHERE
                        g.lvl1 = '{$nextid}'
                        ORDER BY u.user_referalStatus, u.id ASC
                ");

                $index = 0;

                foreach ($lvl1sponser as $rowlvl1sponser) {

                    $index++;

                    $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$rowlvl1sponser["user_id"]}'");

                    $getuserdetails = $userdetails->fetch_assoc();

                    if ($getuserdetails["user_referalStatus"] == "activated") {

                        $tree .= '<li>';

                        if ($index == 1) {
                            $tree .= '
                        <div style="width:100%;display:flex;margin-block:-9px" align="end">
                            <div style="width:50%;height:2px;background-color:white"></div>
                            <div style="width:50%;height:2px;background-color:black"></div>
                        </div>';
                        } else {
                            $tree .= '
                        <div style="width:100%;display:flex;margin-block:-9px" align="end">
                            <div style="width:100%;height:2px;background-color:black"></div>
                        </div>';
                        }

                        $tree .= '<i class="bi bi-arrow-down" style="font-size:30px; color:black"></i><br>
                    <a style="padding-left:50px" data-bs-toggle="modal" data-bs-target="#exampleModal' . $index . '">
                    <img class="childimg" src="img/' . (isset($getuserdetails["user_profileimg"]) && strlen($getuserdetails["user_profileimg"]) > 0 ? "user/" . $getuserdetails["user_profileimg"] : "user.png") . '" style="padding: 10px;background-color:green">
                    </a>
                    <div class="modal fade" id="exampleModal' . $index . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>User ID : ' . $getuserdetails["user_id"] . '</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" align="start">';

                        $usersponser = $con->query("SELECT * FROM userdetails WHERE user_id='{$getuserdetails["user_id"]}'");
                        $getusersponser = $usersponser->fetch_assoc();

                        $namesponser = $con->query("SELECT * FROM userdetails WHERE user_id='{$getusersponser["user_sponserid"]}'");
                        $getnamesponser = $namesponser->fetch_assoc();

                        $tree .= '                                        
                    <h6>Name: ' . $getuserdetails["user_name"] . '</h6>
                    <h6>Sponsor ID: ' . $getusersponser["user_sponserid"] . '</h6>
                    <h6>Sponsor Name: ' . $getnamesponser["user_name"] . '</h6>
                    <h6>Joining Date: ' . date('d-m-Y', strtotime($getuserdetails["created_at"])) . '</h6>
                    ';

                        $final_rank = "Member";

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
                                g.{$levelColumn} = '{$getuserdetails["user_id"]}' AND u.user_referalStatus = 'activated';
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

                        // $rank = "Member";

                        // // Check if the sponsor's referral status is activated
                        // if ($getusersponser["user_referalStatus"] == "activated") {
                        //     $rank = "Distributor";
                        // }

                        // // Initialize arrays to hold level queries and thresholds
                        // $levels = ["lvl1" => 5, "lvl2" => 25, "lvl3" => 125, "lvl4" => 375, "lvl5" => 1500, "lvl6" => 5000, "lvl7" => 5000];
                        // $ranks = ["lvl1" => "Director", "lvl2" => "Senior Director", "lvl3" => "Bronze Director", "lvl4" => "Silver Director", "lvl5" => "Gold Director", "lvl6" => "Diamond Director", "lvl7" => "Crow Director"];

                        // // Loop through each level and determine the rank based on activated members
                        // foreach ($levels as $level => $threshold) {
                        //     // Query to get activated members at the current level
                        //     $levelQuery = $con->query("SELECT user_id FROM genealogy WHERE $level='{$getuserdetails["user_id"]}'");

                        //     // Count the number of activated members
                        //     $activatedCount = 0;
                        //     while ($row = $levelQuery->fetch_assoc()) {
                        //         $account = $con->query("SELECT user_referalStatus FROM userdetails WHERE user_id='{$row["user_id"]}'");
                        //         $getaccount = $account->fetch_assoc();
                        //         if ($getaccount["user_referalStatus"] == "activated") {
                        //             $activatedCount++;
                        //         }
                        //     }

                        //     // Check if the count meets or exceeds the threshold for this level
                        //     if ($activatedCount >= $threshold) {
                        //         $rank = $ranks[$level];
                        //     }
                        // }

                        // Output the rank in the table
                        $tree .= '<h6>Rank: ' . $final_rank . '</h6>';


                        for ($i = 1; $i <= 9; $i++) {
                            $levelQuery = $con->query("SELECT * FROM genealogy WHERE lvl{$i}='{$getuserdetails["user_id"]}'");

                            $levelValue = 0;

                            while ($getlevelQuery = $levelQuery->fetch_assoc()) {
                                $account = $con->query("SELECT * FROM userdetails WHERE user_id='{$getlevelQuery["user_id"]}'");
                                $getaccount = $account->fetch_assoc();

                                if ($getaccount["user_referalStatus"] == "activated") {
                                    if (strlen($getlevelQuery["user_id"]) >= 1) {
                                        $levelValue++;
                                    }
                                }
                            }

                            $tree .= '<h6>Level ' . $i . ': ' . $levelValue . '</h6>';
                        }


                        $tree .= '
                    </div>
                    </div>
                    </div>
                    </div>
                    <br><span style="height:17px;font-size:14px;text-overflow: ellipsis; white-space: nowrap; overflow: hidden; display: inline-block; max-width: 150px;">' . $getuserdetails["user_name"] . '</span>
                    <br><span>' . $getuserdetails["user_id"] . '</span>
                    <br><a href="nextgenealogy.php?nextid=' . $getuserdetails["user_id"] . '">view</a></span>
                    </li>';
                    } else if ($getuserdetails["user_referalStatus"] == "notactivated") {

                        $tree .= '<li>';

                        if ($index == 1) {
                            $tree .= '
                        <div style="width:100%;display:flex;margin-block:-9px" align="end">
                            <div style="width:50%;height:2px;background-color:white"></div>
                            <div style="width:50%;height:2px;background-color:black"></div>
                        </div>';
                        } else {
                            $tree .= '
                        <div style="width:100%;display:flex;margin-block:-9px" align="end">
                            <div style="width:100%;height:2px;background-color:black"></div>
                        </div>';
                        }

                        $tree .= '<i class="bi bi-arrow-down" style="font-size:30px; color:black"></i><br>
                    <a style="padding-left:50px">
                    <img class="childimg" src="img/' . (isset($getuserdetails["user_profileimg"]) && strlen($getuserdetails["user_profileimg"]) > 0 ? "user/" . $getuserdetails["user_profileimg"] : "user.png") . '" style="padding: 10px;background-color:red">
                    </a>
                    <br><span style="height:17px;font-size:14px;text-overflow: ellipsis; white-space: nowrap; overflow: hidden; display: inline-block; max-width: 150px;">' . $getuserdetails["user_name"] . '</span>
                    <br><span>' . $getuserdetails["user_id"] . '</span>
                    <br><a style="color:white">-</a>
                    </li>';
                    }
                }

                if ($index == 0) {
                    $tree .= '<li>
                <div style="width:100%;display:flex;margin-block:-9px" align="end">
                    <div style="width:50%;height:2px;background-color:white"></div>
                    <div style="width:50%;height:2px;background-color:black"></div>
                </div>
                <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                <a href="../signup.php?referral=' . $nextid . '" target="_blank" style="padding-left:50px">
                    <img class="childimg" src="img/add.png">
                </a><br>
                <a style="color:white">-</a><br>
                <a style="color:white">-</a><br>
                <a style="color:white">-</a>
            </li>';
                }

                // Add decreasing number of li elements based on index value
                $remainingLis = max(1, 8 - $index); // Ensure at least 1 li is added
                for ($i = 0; $i < $remainingLis; $i++) {
                    $bgColor = $i == (7 - $index) ? 'white' : 'black';
                    $tree .= '<li>
                <div style="width:100%;display:flex;margin-block:-9px" align="end">
                    <div style="width:50%;height:2px;background-color:black"></div>
                    <div style="width:50%;height:2px;background-color:' . $bgColor . '"></div>
                </div>
                <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                <a href="../signup.php?referral=' . $nextid . '" target="_blank" style="padding-left:50px">
                    <img class="childimg" src="img/add.png">
                </a><br>
                <a style="color:white">-</a><br>
                <a style="color:white">-</a><br>
                <a style="color:white">-</a>
            </li>';
                }

                $tree .= '</ul>';


                $response["tree"] = $tree;
                $response["activation"] = "true";
            }

            $response["status"] = "success";
            echo json_encode($response);
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
