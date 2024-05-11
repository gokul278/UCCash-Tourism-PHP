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

                $response["activation"] = "true";
            }




            $response["status"] = "success";
            echo json_encode($response);
        }

    }else if($way == "levelcheck"){

        $level = $_POST["levelsend"];

        $tabledata = "";

        $leveldata = $con->query("SELECT * FROM genealogy WHERE {$level} = '{$values["userid"]}'");

        $index = 0;

        if(mysqli_num_rows($leveldata) >= 1){
            foreach($leveldata as $getleveldata){
                $index++;
    
                $userdata = $con->query("SELECT * FROM userdetails WHERE user_id='{$getleveldata['user_id']}'");
                $getuserdata = $userdata->fetch_assoc();

                $profileimg = "";


                if (!isset($getuserdata["user_profileimg"]) || empty($getuserdata["user_profileimg"])) {
                    $profileimg = "user.png";
                } else {
                    $profileimg = "user/".$getuserdata["user_profileimg"];
                }
    
                    $tabledata .= '
                    <li>';
                    if($index==1){
                        $tabledata .= '<div style="width:100%;display:flex;margin-block:-9px" align="end">
                        <div style="width:50%;height:2px;background-color:white"></div>
                        <div style="width:50%;height:2px;background-color:black"></div>
                    </div>';
                    }else if($index>1){
                        $tabledata .= '<div style="width:100%;height:2px;background-color:black;margin-block:-9px"></div>';
                    }
    
                    $tabledata .='                    
                    <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                    ';
    
                    if($getuserdata["user_referalStatus"] == "activated"){
                        $tabledata .='                    
                        <a style="padding-left:50px;cursor:pointer;" data-bs-toggle="modal"
                            data-bs-target="#exampleModal'.$index.'">
                            <img class="childimg" src="img/'.$profileimg.'">
                        </a>
                        <div class="modal fade" id="exampleModal'.$index.'" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>User ID : '.$getuserdata["user_id"].'</h4>
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
                                            <h6>Name: '.$getuserdata["user_name"].'</h6>
                                            <h6>Sponser ID: '.$getusersponser["user_sponserid"].'</h6>
                                            <h6>Sponser Name: '.$getnamesponser["user_name"].'</h6>
                                            <h6>Joining Date: '.date('d-m-Y', strtotime($getuserdata["created_at"])).'</h6>
                                            <h6>Rank: </h6>
                                            <h6>Level 1: '.$getlevel["lvl1"].'</h6>
                                            <h6>Level 2: '.$getlevel["lvl2"].'</h6>
                                            <h6>Level 3: '.$getlevel["lvl3"].'</h6>
                                            <h6>Level 4: '.$getlevel["lvl4"].'</h6>
                                            <h6>Level 5: '.$getlevel["lvl5"].'</h6>
                                            <h6>Level 6: '.$getlevel["lvl6"].'</h6>
                                            <h6>Level 7: '.$getlevel["lvl7"].'</h6>
                                            <h6>Level 8: '.$getlevel["lvl8"].'</h6>
                                            <h6>Level 9: '.$getlevel["lvl9"].'</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        ';

                    }else if($getuserdata["user_referalStatus"] == "notactivated"){
                        $tabledata .='                    
                        <a style="padding-left:50px">
                            <img class="childimg" src="img/'.$profileimg.'" style="padding: 10px;background-color:red">
                        </a><br>
                        ';
                    }
    
                    $tabledata.='
                        <span>'.$getuserdata["user_name"].'</span><br>
                        <span>'.$getuserdata["user_id"].'</span>
                    </li>
                    ';
    
            }
        }


        if(mysqli_num_rows($leveldata) == 0){
            $tabledata.='
            <li>
                <div style="width:100%;display:flex;margin-block:-9px" align="end">
                    <div style="width:50%;height:2px;background-color:white"></div>
                    <div style="width:50%;height:2px;background-color:black"></div>
                </div>
                <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                <a href="../../UC-Tour/signup.php?referral='.$values["userid"].'" target="_blank" style="padding-left:50px">
                    <img class="childimg" src="img/add.png">
                </a><br>
                <a style="color:white">a</a><br>
                <a style="color:white">a</a>
            </li>
            <li>
                <div style="width:100%;height:2px;background-color:black;margin-block:-9px"></div>
                <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
                <a href="../../UC-Tour/signup.php?referral='.$values["userid"].'" target="_blank" style="padding-left:50px">
                    <img class="childimg" src="img/add.png">
                </a><br>
                <a style="color:white">a</a><br>
                <a style="color:white">a</a>
            </li>
            ';
        }


        $tabledata.='
        <li>
            <div style="width:100%;display:flex;margin-block:-9px" align="end">
                <div style="width:50%;height:2px;background-color:black"></div>
                <div style="width:50%;height:2px;background-color:white"></div>
            </div>
            <i class="bi bi-arrow-down" style="font-size:30px;color:black"></i><br>
            <a href="../../UC-Tour/signup.php?referral='.$values["userid"].'" target="_blank" style="padding-left:50px">
                <img class="childimg" src="img/add.png">
            </a><br>
            <a style="color:white">a</a><br>
            <a style="color:white">a</a>
        </li>
        ';

        $response["treedata"] = $tabledata;


        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>