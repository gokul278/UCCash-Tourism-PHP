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


            //ID Reactivation Wallet
            $reactivationwallet = $con->query("SELECT * FROM reactivationwallet WHERE user_id='{$datarow["user_id"]}'");
            $rawcredit = 0;
            $rawdebit = 0;

            if (mysqli_num_rows($reactivationwallet) >= 1) {

                foreach ($reactivationwallet as $getreactivationwallet) {
                    if (isset($getreactivationwallet["raw_action"]) && strlen($getreactivationwallet["raw_action"]) >= 1) {
                        if ($getreactivationwallet["raw_action"] == "credit") {
                            $rawcredit += (float) $getreactivationwallet["raw_points"];
                        } else if ($getreactivationwallet["raw_action"] == "debit") {
                            $rawdebit += (float) $getreactivationwallet["raw_points"];
                        }
                    }
                }

            }

            $response["reactivationwallet"] = number_format(($rawcredit - $rawdebit), 2);

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