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

        $response["admin_name"] = $values["admin_name"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $tabledata = "";

        $data = $con->query("SELECT * FROM userdetails");

        foreach ($data as $no => $getdata) {

            $rank = "Member";

            $lvl1status = "<p style='color:red'>Not Achieved</p>";
            $lvl2status = "<p style='color:red'>Not Achieved</p>";
            $lvl3status = "<p style='color:red'>Not Achieved</p>";
            $lvl4status = "<p style='color:red'>Not Achieved</p>";
            $lvl5status = "<p style='color:red'>Not Achieved</p>";
            $lvl6status = "<p style='color:red'>Not Achieved</p>";
            $lvl7status = "<p style='color:red'>Not Achieved</p>";

            $lvl1date = "-";
            $lvl2date = "-";
            $lvl3date = "-";
            $lvl4date = "-";
            $lvl5date = "-";
            $lvl6date = "-";
            $lvl7date = "-";

            if ($getdata["user_referalStatus"] == "activated") {

                $rank = "Distributor";

                $reward = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$getdata["user_id"]}'");

                $getreward = $reward->fetch_assoc();

                $lvl1rewarddate = isset($getreward["level1reward_date"]) ? $getreward["level1reward_date"] : '-';
                $lvl1rewardstatus = isset($getreward["level1reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl2rewarddate = isset($getreward["level2reward_date"]) ? $getreward["level2reward_date"] : '-';
                $lvl2rewardstatus = isset($getreward["level2reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl3rewarddate = isset($getreward["level3reward_date"]) ? $getreward["level3reward_date"] : '-';
                $lvl3rewardstatus = isset($getreward["level3reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl4rewarddate = isset($getreward["level4reward_date"]) ? $getreward["level4reward_date"] : '-';
                $lvl4rewardstatus = isset($getreward["level4reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl5rewarddate = isset($getreward["level5reward_date"]) ? $getreward["level5reward_date"] : '-';
                $lvl5rewardstatus = isset($getreward["level5reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl6rewarddate = isset($getreward["level6reward_date"]) ? $getreward["level6reward_date"] : '-';
                $lvl6rewardstatus = isset($getreward["level6reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl7rewarddate = isset($getreward["level7reward_date"]) ? $getreward["level7reward_date"] : '-';
                $lvl7rewardstatus = isset($getreward["level7reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";


                $lvl1 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl1 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");


                if (mysqli_num_rows($lvl1) >= 5 ) {

                    $rank = "Director";
  
                    foreach ($lvl1 as $index => $getlvl1) {

                        if ($index + 1 == 1) {
                            
                            $lvl1rewardstatus = isset($getreward["level1reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl1reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl1status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl1["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl1date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl2 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl2 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl2) >= 25) {
                    $rank = "Senior Director";

                    foreach ($lvl2 as $index => $getlvl2) {

                        if ($index + 1 == 2) {

                            $lvl2rewardstatus = isset($getreward["level2reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl2reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl2status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl2["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl2date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl3 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl3 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl3) >= 125) {
                    $rank = "Bronze Director";

                    foreach ($lvl3 as $index => $getlvl3) {

                        if ($index + 1 == 125) {

                            $lvl3rewardstatus = isset($getreward["level3reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl3reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl3status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl3["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl3date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl4 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl4 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl4) >= 375) {
                    $rank = "Silver Director";

                    foreach ($lvl4 as $index => $getlvl4) {

                        if ($index + 1 == 375) {

                            $lvl4rewardstatus = isset($getreward["level4reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl4reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl4status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl4["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl4date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }
                }

                $lvl5 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl5 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl5) >= 1500) {
                    $rank = "Gold Director";

                    foreach ($lvl5 as $index => $getlvl5) {

                        if ($index + 1 == 1500) {

                            $lvl5rewardstatus = isset($getreward["level5reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl5reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl5status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl5["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl5date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl6 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl6 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl6) >= 5000) {
                    $rank = "Diamond Director";

                    foreach ($lvl6 as $index => $getlvl6) {

                        if ($index + 1 == 5000) {

                            $lvl6rewardstatus = isset($getreward["level6reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl6reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl6status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl6["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl6date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl7 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl7 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl7) >= 15000) {
                    $rank = "Crow Director";

                    foreach ($lvl7 as $index => $getlvl7) {

                        if ($index + 1 == 15000) {

                            $lvl7rewardstatus = isset($getreward["level7reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl7reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl6status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl7["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl7date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }
            }



            $tabledata .= '
            <tr>
                <th scope="row">' . ($no + 1) . '</th>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getdata["user_name"] . '</td>
                <td>' . $rank . '</td>
                <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal' . $no . '"><b>View</b></button>
                <div class="modal fade" id="exampleModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $no . '" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#191C24">
                                <h1 class="modal-title fs-5" id="exampleModalLabel' . $no . '">Rank Board for ' . $getdata["user_id"] . '</h1>
                                <button type="button" class="btn-close btn btn-danger" style="background-color: red;color:white" data-bs-dismiss="modal" aria-label="Close"></button>
                                <hr>
                            </div>
                            <div class="modal-body" style="background-color:#000">
                                <div class="table-responsive">
                                    <table style="text-align: center;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Level</th>
                                                <th scope="col">Rank</th>
                                                <th scope="col">Rank Status</th>
                                                <th scope="col">Achieved Members</th>
                                                <th scope="col">Achieved Date</th>
                                                <th scope="col">Award Given Date</th>
                                                <th scope="col">Award Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Director</td>
                                                <td>' . $lvl1status . '</td>
                                                <td>' . mysqli_num_rows($lvl1) . '</td>
                                                <td>' . $lvl1date . '</td>
                                                <td>' . $lvl1rewarddate . '</td>
                                                <td>' . $lvl1rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Senior Director</td>
                                                <td>' . $lvl2status . '</td>
                                                <td>' . mysqli_num_rows($lvl2) . '</td>
                                                <td>' . $lvl2date . '</td>
                                                <td>' . $lvl2rewarddate . '</td>
                                                <td>' . $lvl2rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Bronze Director</td>
                                                <td>' . $lvl3status . '</td>
                                                <td>' . mysqli_num_rows($lvl3) . '</td>
                                                <td>' . $lvl3date . '</td>
                                                <td>' . $lvl3rewarddate . '</td>
                                                <td>' . $lvl3rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Silver Director</td>
                                                <td>' . $lvl4status . '</td>
                                                <td>' . mysqli_num_rows($lvl4) . '</td>
                                                <td>' . $lvl4date . '</td>
                                                <td>' . $lvl4rewarddate . '</td>
                                                <td>' . $lvl4rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Gold Director</td>
                                                <td>' . $lvl5status . '</td>
                                                <td>' . mysqli_num_rows($lvl5) . '</td>
                                                <td>' . $lvl5date . '</td>
                                                <td>' . $lvl5rewarddate . '</td>
                                                <td>' . $lvl5rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Diamond Director</td>
                                                <td>' . $lvl6status . '</td>
                                                <td>' . mysqli_num_rows($lvl6) . '</td>
                                                <td>' . $lvl6date . '</td>
                                                <td>' . $lvl6rewarddate . '</td>
                                                <td>' . $lvl6rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Crow Director</td>
                                                <td>' . $lvl7status . '</td>
                                                <td>' . mysqli_num_rows($lvl7) . '</td>
                                                <td>' . $lvl7date . '</td>
                                                <td>' . $lvl7rewarddate . '</td>
                                                <td>' . $lvl7rewardstatus . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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

    } else if ($way == "typesearch") {
        $type = $_POST["type"];

        $tabledata = "";

        $data = $con->query("SELECT * FROM userdetails");

        foreach ($data as $no => $getdata) {

            $rank = "Member";

            $lvl1status = "<p style='color:red'>Not Achieved</p>";
            $lvl2status = "<p style='color:red'>Not Achieved</p>";
            $lvl3status = "<p style='color:red'>Not Achieved</p>";
            $lvl4status = "<p style='color:red'>Not Achieved</p>";
            $lvl5status = "<p style='color:red'>Not Achieved</p>";
            $lvl6status = "<p style='color:red'>Not Achieved</p>";
            $lvl7status = "<p style='color:red'>Not Achieved</p>";

            $lvl1date = "-";
            $lvl2date = "-";
            $lvl3date = "-";
            $lvl4date = "-";
            $lvl5date = "-";
            $lvl6date = "-";
            $lvl7date = "-";

            if ($getdata["user_referalStatus"] == "activated") {

                $rank = "Distributor";

                $reward = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$getdata["user_id"]}'");

                $getreward = $reward->fetch_assoc();

                $lvl1rewarddate = isset($getreward["level1reward_date"]) ? $getreward["level1reward_date"] : '-';
                $lvl1rewardstatus = isset($getreward["level1reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl2rewarddate = isset($getreward["level2reward_date"]) ? $getreward["level2reward_date"] : '-';
                $lvl2rewardstatus = isset($getreward["level2reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl3rewarddate = isset($getreward["level3reward_date"]) ? $getreward["level3reward_date"] : '-';
                $lvl3rewardstatus = isset($getreward["level3reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl4rewarddate = isset($getreward["level4reward_date"]) ? $getreward["level4reward_date"] : '-';
                $lvl4rewardstatus = isset($getreward["level4reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl5rewarddate = isset($getreward["level5reward_date"]) ? $getreward["level5reward_date"] : '-';
                $lvl5rewardstatus = isset($getreward["level5reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl6rewarddate = isset($getreward["level6reward_date"]) ? $getreward["level6reward_date"] : '-';
                $lvl6rewardstatus = isset($getreward["level6reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";

                $lvl7rewarddate = isset($getreward["level7reward_date"]) ? $getreward["level7reward_date"] : '-';
                $lvl7rewardstatus = isset($getreward["level7reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' disabled>Give</button>";


                $lvl1 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl1 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");


                if (mysqli_num_rows($lvl1) >= 5) {

                    $rank = "Director";

                    foreach ($lvl1 as $index => $getlvl1) {

                        if ($index + 1 == 5) {

                            $lvl1rewardstatus = isset($getreward["level1reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl1reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl1status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl1["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl1date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl2 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl2 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl2) >= 25) {
                    $rank = "Senior Director";

                    foreach ($lvl2 as $index => $getlvl2) {

                        if ($index + 1 == 25) {

                            $lvl2rewardstatus = isset($getreward["level2reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl2reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl2status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl2["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl2date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl3 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl3 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl3) >= 125) {
                    $rank = "Bronze Director";

                    foreach ($lvl3 as $index => $getlvl3) {

                        if ($index + 1 == 125) {

                            $lvl3rewardstatus = isset($getreward["level3reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl3reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl3status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl3["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl3date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl4 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl4 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl4) >= 375) {
                    $rank = "Silver Director";

                    foreach ($lvl4 as $index => $getlvl4) {

                        if ($index + 1 == 375) {

                            $lvl4rewardstatus = isset($getreward["level4reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl4reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl4status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl4["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl4date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }
                }

                $lvl5 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl5 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl5) >= 1500) {
                    $rank = "Gold Director";

                    foreach ($lvl5 as $index => $getlvl5) {

                        if ($index + 1 == 1500) {

                            $lvl5rewardstatus = isset($getreward["level5reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl5reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl5status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl5["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl5date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl6 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl6 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl6) >= 5000) {
                    $rank = "Diamond Director";

                    foreach ($lvl6 as $index => $getlvl6) {

                        if ($index + 1 == 5000) {

                            $lvl6rewardstatus = isset($getreward["level6reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl6reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl6status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl6["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl6date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }

                $lvl7 = $con->query("SELECT *
                FROM genealogy g
                JOIN userdetails u ON g.user_id = u.user_id
                WHERE g.lvl7 = '{$getdata["user_id"]}' AND u.user_referalStatus = 'activated'");

                if (mysqli_num_rows($lvl7) >= 15000) {
                    $rank = "Crow Director";

                    foreach ($lvl7 as $index => $getlvl7) {

                        if ($index + 1 == 15000) {

                            $lvl7rewardstatus = isset($getreward["level7reward_date"]) ? "<p class='green'>Granded</p>" : "<button class='btn btn-warning' onclick='lvl7reward(this)' userid='" . $getdata["user_id"] . "' data-bs-dismiss='modal'>Give</button>";

                            $lvl6status = "<p style='color:green'>Achieved</p>";

                            $checkdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$getlvl7["user_id"]}' AND remark='Activation Successful'");
                            $getcheckdate = $checkdate->fetch_assoc();

                            $lvl7date = isset($getcheckdate["paid_date"]) ? $getcheckdate["paid_date"] : '';

                        }

                    }

                }
            }

            if ($rank == $type) {
                $tabledata .= '<tr>
                <th scope="row">' . ($no + 1) . '</th>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getdata["user_name"] . '</td>
                <td>' . $rank . '</td>
                <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal' . $no . '"><b>View</b></button>
                <div class="modal fade" id="exampleModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#191C24">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rank Board for ' . $getdata["user_id"] . '</h1>
                                <button type="button" class="btn-close btn btn-danger" style="background-color: red;color:white" data-bs-dismiss="modal" aria-label="Close"></button>
                                <hr>
                            </div>
                            <div class="modal-body" style="background-color:#000">
                                <div class="table-responsive">
                                    <table style="text-align: center;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Level</th>
                                                <th scope="col">Rank</th>
                                                <th scope="col">Rank Status</th>
                                                <th scope="col">Achieved Members</th>
                                                <th scope="col">Achieved Date</th>
                                                <th scope="col">Award Given Date</th>
                                                <th scope="col">Award Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Director</td>
                                                <td>' . $lvl1status . '</td>
                                                <td>' . mysqli_num_rows($lvl1) . '</td>
                                                <td>' . $lvl1date . '</td>
                                                <td>' . $lvl1rewarddate . '</td>
                                                <td>' . $lvl1rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Senior Director</td>
                                                <td>' . $lvl2status . '</td>
                                                <td>' . mysqli_num_rows($lvl2) . '</td>
                                                <td>' . $lvl2date . '</td>
                                                <td>' . $lvl2rewarddate . '</td>
                                                <td>' . $lvl2rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Bronze Director</td>
                                                <td>' . $lvl3status . '</td>
                                                <td>' . mysqli_num_rows($lvl3) . '</td>
                                                <td>' . $lvl3date . '</td>
                                                <td>' . $lvl3rewarddate . '</td>
                                                <td>' . $lvl3rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Silver Director</td>
                                                <td>' . $lvl4status . '</td>
                                                <td>' . mysqli_num_rows($lvl4) . '</td>
                                                <td>' . $lvl4date . '</td>
                                                <td>' . $lvl4rewarddate . '</td>
                                                <td>' . $lvl4rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Gold Director</td>
                                                <td>' . $lvl5status . '</td>
                                                <td>' . mysqli_num_rows($lvl5) . '</td>
                                                <td>' . $lvl5date . '</td>
                                                <td>' . $lvl5rewarddate . '</td>
                                                <td>' . $lvl5rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Diamond Director</td>
                                                <td>' . $lvl6status . '</td>
                                                <td>' . mysqli_num_rows($lvl6) . '</td>
                                                <td>' . $lvl6date . '</td>
                                                <td>' . $lvl6rewarddate . '</td>
                                                <td>' . $lvl6rewardstatus . '</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Crow Director</td>
                                                <td>' . $lvl7status . '</td>
                                                <td>' . mysqli_num_rows($lvl7) . '</td>
                                                <td>' . $lvl7date . '</td>
                                                <td>' . $lvl7rewarddate . '</td>
                                                <td>' . $lvl7rewardstatus . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                </td>
            </tr>
            ';
            }

        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    }else if($way == "awardlvl1"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level1reward_date='{$date}',  level1reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level1reward_date,level1reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl2"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level2reward_date='{$date}',  level2reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level2reward_date,level2reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl3"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level3reward_date='{$date}',  level3reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level3reward_date,level3reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl4"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level4reward_date='{$date}',  level4reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level4reward_date,level4reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl5"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level5reward_date='{$date}',  level5reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level5reward_date,level5reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl6"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level6reward_date='{$date}',  level6reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level6reward_date,level6reward_status)
            VALUES ('{$userid}','{$date}','granted')");

            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if($way == "awardlvl7"){
        $userid= $_POST["userid"];
        $date = date('Y-m-d H:i:s');

        $check = $con->query("SELECT * FROM rankboardaward WHERE user_id='{$userid}'");

        if (mysqli_num_rows($check) >= 1 ) {

            $update = $con->query("UPDATE rankboardaward SET level7reward_date='{$date}',  level7reward_status='granted' WHERE user_id='{$userid}'");

            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $insert = $con->query("INSERT INTO rankboardaward (user_id,level7reward_date,level7reward_status)
            VALUES ('{$userid}','{$date}','granted')");

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