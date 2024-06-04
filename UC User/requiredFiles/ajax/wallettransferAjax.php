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
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            //Savings Travel Points
            $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$datarow["user_id"]}'");
            $stcredit = 0;
            $stdebit = 0;

            if (mysqli_num_rows($savingtravel) >= 1) {

                foreach ($savingtravel as $getsavingtravel) {
                    if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                        if ($getsavingtravel["st_action"] == "credit") {
                            $stcredit += (float) $getsavingtravel["st_points"];
                        } else if ($getsavingtravel["st_action"] == "debit") {
                            $stdebit += (float) $getsavingtravel["st_points"];
                        }
                    }
                }

            }

            $response["savingstravelpoints"] = number_format(($stcredit - $stdebit), 2);

            $tabledata = "";
            
            $data = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}' AND st_remark='transfer'");

            foreach($data as $index=>$getData){
                $tabledata .= '
                <tr>
                    <th scope="col">'.($index+1).'</th>
                    <th>'.$getData["st_createdat"].'</th>
                    <th>'.$getData["st_bonusfrom"].'</th>
                ';

                if($getData['st_action'] == 'credit'){
                    $tabledata .= '
                            <th>Recived</th>
                            <th>'.$getData["st_points"].'</th>
                            <th></th>
                        </tr>
                    ';
                }else if($getData['st_action'] == 'debit'){
                    $tabledata .= '
                        <th>Transferred</th>
                        <th></th>
                        <th>'.$getData["st_points"].'</th>
                    </tr>
                ';
                }
            }

            $response["tabledata"] = $tabledata;

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "savingstravelpoints") {

        //Savings Travel Points
        $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}'");
        $stcredit = 0;
        $stdebit = 0;

        if (mysqli_num_rows($savingtravel) >= 1) {

            foreach ($savingtravel as $getsavingtravel) {
                if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                    if ($getsavingtravel["st_action"] == "credit") {
                        $stcredit += (float) $getsavingtravel["st_points"];
                    } else if ($getsavingtravel["st_action"] == "debit") {
                        $stdebit += (float) $getsavingtravel["st_points"];
                    }
                }
            }
        }

        $response["balanacevalue"] = number_format(($stcredit - $stdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "checksponser") {

        // Checking the Sponser ID - start

        $sponser_id = $_POST["userid"];

        $sql = "SELECT * FROM userdetails WHERE user_id = '{$sponser_id}'";

        $res = $con->query($sql);

        $getdata = $res->fetch_assoc();

        if (mysqli_num_rows($res) == 1) {

            //Checking the Sponser ID
            $row = $res->fetch_assoc();

            if ($getdata["user_id"] == $values["userid"]) {
                $response["status"] = "success";
                $response["message"] = "invalid";
                $response["stage"] = "not";
            } else {
                $response["status"] = "success";
                $response["message"] = $getdata["user_name"];
                $response["stage"] = "ok";

            }


        } else {

            $response["status"] = "success";
            $response["message"] = "invalid";
            $response["stage"] = "not";

        }

        echo json_encode($response);

        // Checking the Sponser ID - start
    } else if ($way == "transferwallet") {

        $wallettype = $_POST["wallettype"];
        $userid = $_POST["userid"];
        $transferpoints = number_format(($_POST["transferpoints"]), 2);

        if ($wallettype == "savingstravelpoints") {

            $activation = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}' AND user_referalStatus='activated'");

            if (mysqli_num_rows($activation)) {

                $checkid = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                // $getcheckid = $checkid->fetch_assoc();

                if (mysqli_num_rows($checkid) >= 1) {

                    //Savings Travel Points
                    $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}'");
                    $stcredit = 0;
                    $stdebit = 0;

                    if (mysqli_num_rows($savingtravel) >= 1) {

                        foreach ($savingtravel as $getsavingtravel) {
                            if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                                if ($getsavingtravel["st_action"] == "credit") {
                                    $stcredit += (float) $getsavingtravel["st_points"];
                                } else if ($getsavingtravel["st_action"] == "debit") {
                                    $stdebit += (float) $getsavingtravel["st_points"];
                                }
                            }
                        }

                    }

                    $savingsincomebalance = number_format(($stcredit - $stdebit), 2);

                    if ($transferpoints <= $savingsincomebalance) {

                        $credituser = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_bonusfrom,st_action,st_remark)
                    VALUES ('{$userid}','{$transferpoints}','Transferred From {$values["userid"]}','credit','transfer')");

                        $debituser = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_bonusfrom,st_action,st_remark)
                    VALUES ('{$values["userid"]}','{$transferpoints}','Transferred for {$userid}','debit','transfer')");

                        if ($credituser && $debituser) {
                            $response["status"] = "success";
                            echo json_encode($response);
                        } else {
                            $response["status"] = "error";
                            $response["message"] = "sql error";
                            echo json_encode($response);
                        }

                    } else {

                        $response["status"] = "error";
                        $response["message"] = "Insufficient balance";
                        echo json_encode($response);


                    }



                } else {

                    $response["status"] = "error";
                    $response["message"] = "Invalid User ID";
                    echo json_encode($response);


                }

            } else {

                $response["status"] = "error";
                $response["message"] = "Activate Your ID";
                echo json_encode($response);


            }


        } else {

            $response["status"] = "error";
            $response["message"] = "Choose Wallet Type";
            echo json_encode($response);


        }



    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>