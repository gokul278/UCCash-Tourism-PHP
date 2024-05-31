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

            //Savings Income
            $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
            $sicredit = 0;
            $sidebit = 0;

            if (mysqli_num_rows($savingsincome) >= 1) {

                foreach ($savingsincome as $getsavingsincome) {
                    if (isset($getsavingsincome["si_action"]) && strlen($getsavingsincome["si_action"]) >= 1) {
                        if ($getsavingsincome["si_action"] == "credit") {
                            $sicredit += (float) $getsavingsincome["si_points"];
                        } else if ($getsavingsincome["si_action"] == "debit") {
                            $sidebit += (float) $getsavingsincome["si_points"];
                        }
                    }
                }

            }

            $response["savingsincome"] = number_format(($sicredit - $sidebit), 2);

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "savingsincome") {

        //Savings Income
        $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
        $sicredit = 0;
        $sidebit = 0;

        if (mysqli_num_rows($savingsincome) >= 1) {

            foreach ($savingsincome as $getsavingsincome) {
                if (isset($getsavingsincome["si_action"]) && strlen($getsavingsincome["si_action"]) >= 1) {
                    if ($getsavingsincome["si_action"] == "credit") {
                        $sicredit += (float) $getsavingsincome["si_points"];
                    } else if ($getsavingsincome["si_action"] == "debit") {
                        $sidebit += (float) $getsavingsincome["si_points"];
                    }
                }
            }

        }

        $response["balanacevalue"] = number_format(($sicredit - $sidebit), 2);

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

        if ($wallettype == "savingsincome") {

            $activation = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}' AND user_referalStatus='activated'");

            if (mysqli_num_rows($activation)) {

                $checkid = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                // $getcheckid = $checkid->fetch_assoc();

                if (mysqli_num_rows($checkid) >= 1) {

                    //Savings Income
                    $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
                    $sicredit = 0;
                    $sidebit = 0;

                    if (mysqli_num_rows($savingsincome) >= 1) {

                        foreach ($savingsincome as $getsavingsincome) {
                            if (isset($getsavingsincome["si_action"]) && strlen($getsavingsincome["si_action"]) >= 1) {
                                if ($getsavingsincome["si_action"] == "credit") {
                                    $sicredit += (float) $getsavingsincome["si_points"];
                                } else if ($getsavingsincome["si_action"] == "debit") {
                                    $sidebit += (float) $getsavingsincome["si_points"];
                                }
                            }
                        }

                    }

                    $savingsincomebalance = number_format(($sicredit - $sidebit), 2);

                    if ($transferpoints <= $savingsincomebalance) {

                        $credituser = $con->query("INSERT INTO savingsincome (user_id,si_points,si_bonusfrom,si_action,si_remark)
                    VALUES ('{$userid}','{$transferpoints}','Transferred From {$values["userid"]}','credit','Savings Income')");

                        $debituser = $con->query("INSERT INTO savingsincome (user_id,si_points,si_bonusfrom,si_action,si_remark)
                    VALUES ('{$values["userid"]}','{$transferpoints}','Transferred for {$userid}','debit','Savings Income')");

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