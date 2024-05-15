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

                $lvl1sponser = $con->query("SELECT * 
            FROM genealogy 
            WHERE lvl1 = '{$nextid}'");

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
                    <img class="childimg" src="img/' . (isset($getuserdetails["user_profileimg"]) && strlen($getuserdetails["user_profileimg"]) > 0 ? "user/" . $getuserdetails["user_profileimg"] : "user.png") . '" >
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
                    <h6>Rank: </h6>';

                        for ($i = 1; $i <= 9; $i++) {
                            $levelQuery = $con->query("SELECT * FROM genealogy WHERE lvl{$i}='{$getuserdetails["user_id"]}'");
                            $levelValue = 0;

                            foreach ($levelQuery as $row) {
                                if (strlen($row["user_id"]) >= 1) {
                                    $levelValue++;
                                }
                            }

                            $tree .= '<h6>Level ' . $i . ': ' . $levelValue . '</h6>';
                        }

                        $tree .= '
                    </div>
                    </div>
                    </div>
                    </div>
                    <br><span>' . $getuserdetails["user_name"] . '</span>
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
                    <br><span>' . $getuserdetails["user_name"] . '</span>
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
                <a href="../../UC-Tour/signup.php?referral=' . $nextid . '" target="_blank" style="padding-left:50px">
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
                    <div style="width:50%;height:2px;background-color:'.$bgColor.'"></div>
                </div>
                <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                <a href="../../UC-Tour/signup.php?referral=' . $nextid . '" target="_blank" style="padding-left:50px">
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

?>