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

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows(result: $datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_id"] = $datarow["user_id"];
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            if ($datarow["user_referalStatus"] == "notactivated") {

                $response["activation"] = "false";
            } else if ($datarow["user_referalStatus"] == "activated") {

                $response["activation"] = "true";
            }




            $response["status"] = "success";
            echo json_encode($response);
        }
    } else if ($way == "levelcheck") {

        $level = $_POST["levelsend"];

        $tabledata = "";

        $leveldata = $con->query("SELECT * FROM genealogy WHERE {$level} = '{$values["userid"]}'");

        $index = 0;

        if (mysqli_num_rows($leveldata) >= 1) {
            foreach ($leveldata as $getleveldata) {
                $index++;

                $userdata = $con->query("SELECT * FROM userdetails WHERE user_id='{$getleveldata['user_id']}'");
                $getuserdata = $userdata->fetch_assoc();

                $profileimg = "";

                if (!isset($getuserdata["user_profileimg"]) || empty($getuserdata["user_profileimg"])) {
                    $profileimg = "user.png";
                } else {
                    $profileimg = "user/" . $getuserdata["user_profileimg"];
                }

                $tabledata .= '<li>';
                if ($index == 1) {
                    $tabledata .= '<div style="width:100%;display:flex;margin-block:-9px" align="end">
                <div style="width:50%;height:2px;background-color:white"></div>
                <div style="width:50%;height:2px;background-color:black"></div>
            </div>';
                } else if ($index > 1) {
                    $tabledata .= '<div style="width:100%;height:2px;background-color:black;margin-block:-9px"></div>';
                }

                $tabledata .= '<i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>';

                if ($getuserdata["user_referalStatus"] == "activated") {
                    $tabledata .= '<a style="padding-left:50px;cursor:pointer;" data-bs-toggle="modal"
                data-bs-target="#exampleModal' . $index . '">
                <img class="childimg" src="img/' . $profileimg . '" style="padding: 10px;background-color:green">
            </a>
            <div class="modal fade" id="exampleModal' . $index . '" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>User ID : ' . $getuserdata["user_id"] . '</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" align="start">';

                    $usersponser = $con->query("SELECT * FROM userdetails WHERE user_id='{$getuserdata["user_id"]}'");
                    $getusersponser = $usersponser->fetch_assoc();

                    $namesponser = $con->query("SELECT * FROM userdetails WHERE user_id='{$getusersponser["user_sponserid"]}'");
                    $getnamesponser = $namesponser->fetch_assoc();

                    $tabledata .= '<h6>Name: ' . $getuserdata["user_name"] . '</h6>
                    <h6>Sponsor ID: ' . $getusersponser["user_sponserid"] . '</h6>
                    <h6>Sponsor Name: ' . $getnamesponser["user_name"] . '</h6>
                    <h6>Joining Date: ' . date('d-m-Y', strtotime($getuserdata["created_at"])) . '</h6>
                    ';


                    $rank = "Member";

                    // Check if the sponsor's referral status is activated
                    if ($getusersponser["user_referalStatus"] == "activated") {
                        $rank = "Distributor";
                    }

                    // Initialize arrays to hold level queries and thresholds
                    $levels = ["lvl1" => 5, "lvl2" => 25, "lvl3" => 125, "lvl4" => 375, "lvl5" => 1500, "lvl6" => 5000, "lvl7" => 5000];
                    $ranks = ["lvl1" => "Director", "lvl2" => "Senior Director", "lvl3" => "Bronze Director", "lvl4" => "Silver Director", "lvl5" => "Gold Director", "lvl6" => "Diamond Director", "lvl7" => "Crow Director"];

                    // Loop through each level and determine the rank based on activated members
                    foreach ($levels as $level => $threshold) {
                        // Query to get activated members at the current level
                        $levelQuery = $con->query("SELECT user_id FROM genealogy WHERE $level='{$getuserdata["user_id"]}'");

                        // Count the number of activated members
                        $activatedCount = 0;
                        while ($row = $levelQuery->fetch_assoc()) {
                            $account = $con->query("SELECT user_referalStatus FROM userdetails WHERE user_id='{$row["user_id"]}'");
                            $getaccount = $account->fetch_assoc();
                            if ($getaccount["user_referalStatus"] == "activated") {
                                $activatedCount++;
                            }
                        }

                        // Check if the count meets or exceeds the threshold for this level
                        if ($activatedCount >= $threshold) {
                            $rank = $ranks[$level];
                        }
                    }

                    // Output the rank in the table
                    $tabledata .= '<h6>Rank: ' . $rank . '</h6>';


                    for ($i = 1; $i <= 9; $i++) {
                        $levelQuery = $con->query("SELECT * FROM genealogy WHERE lvl{$i}='{$getuserdata["user_id"]}'");

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

                        $tabledata .= '<h6>Level ' . $i . ': ' . $levelValue . '</h6>';
                    }

                    $tabledata .= '</div>
                </div>
                </div>
                </div>
                <br>
                <span>' . $getuserdata["user_name"] . '</span><br>
                <span>' . $getuserdata["user_id"] . '</span><br>
                <span><a href="./nextgenealogy.php?nextid=' . $getuserdata["user_id"] . '">view</a><span>
            </li>';
                } else if ($getuserdata["user_referalStatus"] == "notactivated") {
                    $tabledata .= '<a style="padding-left:50px">
                <img class="childimg" src="img/' . $profileimg . '" style="padding: 10px;background-color:red">
            </a><br>
            <span>' . $getuserdata["user_name"] . '</span><br>
            <span>' . $getuserdata["user_id"] . '</span><br>
            <span style="color:white">-</span>
        </li>';
                }
            }
        }

        if ($index == 0) {
            $tabledata .= '<li>
        <div style="width:100%;display:flex;margin-block:-9px" align="end">
            <div style="width:50%;height:2px;background-color:white"></div>
            <div style="width:50%;height:2px;background-color:black"></div>
        </div>
        <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
        <a href="../signup.php?referral=' . $values["userid"] . '" target="_blank" style="padding-left:50px">
            <img class="childimg" src="img/add.png">
        </a><br>
        <a style="color:white">-</a><br>
        <a style="color:white">-</a><br>
        <a style="color:white">-</a>
    </li>';
        }

        if ($index > 8) {
            $index = 1; // Reset index to 1 for the additional logic
        }

        for ($i = 0; $i < (8 - $index); $i++) {
            $bgColor = $i == (7 - $index) ? 'white' : 'black';
            $tabledata .= '<li>
        <div style="width:100%;display:flex;margin-block:-9px" align="end">
            <div style="width:50%;height:2px;background-color:black"></div>
            <div style="width:50%;height:2px;background-color:' . $bgColor . '"></div>
        </div>
        <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
        <a href="../signup.php?referral=' . $values["userid"] . '" target="_blank" style="padding-left:50px">
            <img class="childimg" src="img/add.png">
        </a><br>
        <a style="color:white">-</a><br>
        <a style="color:white">-</a><br>
        <a style="color:white">-</a>
    </li>';
        }


        $response["treedata"] = $tabledata;


        $response["status"] = "success";
        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
