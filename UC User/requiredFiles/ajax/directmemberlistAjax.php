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
            $tabledata = ''; // Initialize an empty string to store the table data
            $index = 0; // Initialize an index counter

            $lvl1 = $con->query("SELECT* FROM genealogy WHERE lvl1='{$values["userid"]}'");

            foreach ($lvl1 as $getlvl1) {
                $index++;

                $userdata = $con->query("SELECT * FROM userdetails WHERE user_id='{$getlvl1["user_id"]}'");
                $getuserdata = $userdata->fetch_assoc();

                $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <td>' . $getuserdata["user_id"] . '</td>
                    <td>' . $getuserdata["user_name"] . '</td>
                    <td>' . $getuserdata["user_phoneno"] . '</td>
                    <td>' . $getuserdata["user_email"] . '</td>
                    <td>' . date('d-m-Y', strtotime($getuserdata["created_at"])) . '</td>';

                if ($getuserdata["user_referalStatus"] == "activated") {
                    $tabledata .= '<td style="color: green;">Active</td>';
                } else if ($getuserdata["user_referalStatus"] == "notactivated") {
                    $tabledata .= '<td style="color: red;">In Active</td>';
                }

                $rank = "Member";

                // Check if the sponsor's referral status is activated
                if ($getuserdata["user_referalStatus"] == "activated") {
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
                $tabledata .= '<td>' . $rank . '</td>';


                $tabledata .= '
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal' . $index . '"><b>View</b></button>
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
                    </td>
                </tr>
                ';
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

?>