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

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_id"] = $datarow["user_id"];
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            if ($datarow["user_referalStatus"] == "notactivated") {

                $response["activation"] = "false";

            } else if ($datarow["user_referalStatus"] == "activated") {

                $response["user_sponserid"] = $datarow["user_sponserid"];
                $response["title"] = '
            Name: ' . $datarow["user_name"] . '
            Sponser: ' . $datarow["user_sponserid"] . '
            Package: Activation Package
            Activation Date: ' . date("d-m-Y", strtotime($datarow["updated_at"])) . '';

                $tree = "";


                $lvl1sponser = $con->query("SELECT * 
            FROM genealogy 
            WHERE lvl1 = '{$datarow["user_id"]}'");


                if (mysqli_num_rows($lvl1sponser) >= 1) {

                    foreach ($lvl1sponser as $rowlvl1sponser) {

                        $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$rowlvl1sponser["user_id"]}'");

                        $getuserdetails = $userdetails->fetch_assoc();

                        if ($getuserdetails["user_referalStatus"] == "activated") {

                            $tree .= '
                        <li >
                            <i class="bi bi-arrow-down" style="font-size:30px;"></i><br>
                            <a href="nextgenealogy.php?nextid=' . $getuserdetails["user_id"] . '" style="padding-left:50px"
                                title="
                                User ID: ' . $getuserdetails["user_id"] . '
                                Name: ' . $getuserdetails["user_name"] . '
                                Sponser: ' . $getuserdetails["user_sponserid"] . '
                                Package: Activation Package
                                Activation Date: ' . date("d-m-Y", strtotime($getuserdetails["updated_at"])) . '
                                ">
                        ';

                            if (isset($getuserdetails["user_profileimg"]) && strlen($getuserdetails["user_profileimg"]) > 0) {
                                $tree .= '
                            <img class="childimg" src="img/user/' . $getuserdetails["user_profileimg"] . '" style="padding: 10px;background-color:green">
                                </a>
                            </li>
                        ';
                            } else {
                                $tree .= '
                            <img class="childimg" src="img/user.png" style="padding: 10px;background-color:green">
                                </a>
                            </li>
                        ';
                            }

                        } else if ($getuserdetails["user_referalStatus"] == "notactivated") {

                            $tree .= '
                        <li>
                            <i class="bi bi-arrow-down" style="font-size:30px;"></i><br>
                            <a href="#" style="padding-left:50px"
                                    title="
                                    User ID: ' . $getuserdetails["user_id"] . '
                                    Name: ' . $getuserdetails["user_name"] . '
                                    Sponser: ' . $getuserdetails["user_sponserid"] . '
                                    Package: Not Activated
                                    ">
                            ';

                            if (isset($getuserdetails["user_profileimg"]) && strlen($getuserdetails["user_profileimg"]) > 0) {
                                $tree .= '
                            <img class="childimg" src="img/user/' . $getuserdetails["user_profileimg"] . '" style="padding: 10px;background-color:red;width:60px;height:60px">
                                </a>
                            </li>
                        ';
                            } else {
                                $tree .= '
                            <img class="childimg" src="img/user.png" style="padding: 10px;background-color:red;width:60px;height:60px">
                                </a>
                            </li>
                        ';
                            }

                        }


                    }

                    $tree .= '
                    <li>
                        <i class="bi bi-arrow-down" style="font-size:30px;"></i><br>
                        <a href="../../UC-Tour/signup.php?referral=' . $datarow["user_id"] . '" target="_blank" style="padding-left:50px"
                            title="Click to Register : ' . $datarow["user_id"] . '">
                            <img class="childimg" src="img/add.png">
                        </a>
                    </li>
                    ';

                } else {

                    $tree .= '
                <li>
                    <i class="bi bi-arrow-down" style="font-size:30px;"></i><br>
                    <a href="../../UC-Tour/signup.php?referral=' . $datarow["user_id"] . '" target="_blank" style="padding-left:50px"
                        title="Click to Register : ' . $datarow["user_id"] . '">
                        <img class="childimg" src="img/add.png">
                    </a>
                </li>
                    ';

                }


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

?>