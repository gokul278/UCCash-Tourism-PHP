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

                $tabledata .= '
                    <td></td>
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

                $level = $con->query("SELECT * FROM genealogy WHERE user_id='{$getuserdata["user_id"]}'");
                $getlevel = $level->fetch_assoc();

                $tabledata .= '                                        
                                            <h6>Name: ' . $getuserdata["user_name"] . '</h6>
                                            <h6>Sponser ID: ' . $getusersponser["user_sponserid"] . '</h6>
                                            <h6>Sponser Name: ' . $getnamesponser["user_name"] . '</h6>
                                            <h6>Joining Date: ' . date('d-m-Y', strtotime($getuserdata["created_at"])) . '</h6>
                                            <h6>Rank: </h6>
                                            <h6>Level 1: ' . $getlevel["lvl1"] . '</h6>
                                            <h6>Level 2: ' . $getlevel["lvl2"] . '</h6>
                                            <h6>Level 3: ' . $getlevel["lvl3"] . '</h6>
                                            <h6>Level 4: ' . $getlevel["lvl4"] . '</h6>
                                            <h6>Level 5: ' . $getlevel["lvl5"] . '</h6>
                                            <h6>Level 6: ' . $getlevel["lvl6"] . '</h6>
                                            <h6>Level 7: ' . $getlevel["lvl7"] . '</h6>
                                            <h6>Level 8: ' . $getlevel["lvl8"] . '</h6>
                                            <h6>Level 9: ' . $getlevel["lvl9"] . '</h6>
                                        </div>
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