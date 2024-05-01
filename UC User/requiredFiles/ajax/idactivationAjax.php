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

        $datarow = $datares->fetch_assoc();
        $response["user_name"] = $datarow["user_name"];
        $response["user_profileimg"] = $datarow["user_profileimg"];

        $checkpay = $con->query("SELECT * FROM idactivation WHERE user_id='{$values["userid"]}' AND action='admin'");

        if (mysqli_num_rows($checkpay) == 1) {

            $response["action"] = "nopay";

            $response["status"] = "success";
            echo json_encode($response);

        } else {

            $checkrow = $con->query("SELECT MAX(id) AS max_id, created_at, remark 
            FROM idactivation 
            WHERE user_id='{$values["userid"]}'
            ");

            if (mysqli_num_rows($checkrow) == 0) {

                $response["action"] = "pay";

                $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
                $getaddress = $address->fetch_assoc();

                $response["crypto_image"] = $getaddress["crypto_image"];
                $response["crypto_address"] = $getaddress["crypto_address"];
                $response["crypto_value"] = $getaddress["crypto_value"];
                $response["bankdeposit_image"] = $getaddress["bankdeposit_image"];
                $response["ac_holdername"] = $getaddress["ac_holdername"];
                $response["ac_number"] = $getaddress["ac_number"];
                $response["ifsc_code"] = $getaddress["ifsc_code"];
                $response["branch"] = $getaddress["branch"];
                $response["upi_id"] = $getaddress["upi_id"];
                $response["deposit_value"] = $getaddress["deposit_value"];
                $response["userid"] = $values["userid"];

                $response["status"] = "success";
                echo json_encode($response);

            } else {

                $getcheckrow = $checkrow->fetch_assoc();

                $datetimeString = $getcheckrow["created_at"];
                $dateOnly = date("Y-m-d", strtotime($datetimeString));

                $date = new DateTime($dateOnly);
                $today = new DateTime();
                $interval = $date->diff($today);

                if ($interval->days >= 30) {

                    $response["action"] = "pay";

                    $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
                    $getaddress = $address->fetch_assoc();

                    $response["crypto_image"] = $getaddress["crypto_image"];
                    $response["crypto_address"] = $getaddress["crypto_address"];
                    $response["crypto_value"] = $getaddress["crypto_value"];
                    $response["bankdeposit_image"] = $getaddress["bankdeposit_image"];
                    $response["ac_holdername"] = $getaddress["ac_holdername"];
                    $response["ac_number"] = $getaddress["ac_number"];
                    $response["ifsc_code"] = $getaddress["ifsc_code"];
                    $response["branch"] = $getaddress["branch"];
                    $response["upi_id"] = $getaddress["upi_id"];
                    $response["deposit_value"] = $getaddress["deposit_value"];
                    $response["userid"] = $values["userid"];

                    $response["status"] = "success";
                    echo json_encode($response);

                } else if ($interval->days <= 30 && $getcheckrow["remark"] != "") {

                    $response["action"] = "pay";

                    $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
                    $getaddress = $address->fetch_assoc();

                    $response["crypto_image"] = $getaddress["crypto_image"];
                    $response["crypto_address"] = $getaddress["crypto_address"];
                    $response["crypto_value"] = $getaddress["crypto_value"];
                    $response["bankdeposit_image"] = $getaddress["bankdeposit_image"];
                    $response["ac_holdername"] = $getaddress["ac_holdername"];
                    $response["ac_number"] = $getaddress["ac_number"];
                    $response["ifsc_code"] = $getaddress["ifsc_code"];
                    $response["branch"] = $getaddress["branch"];
                    $response["upi_id"] = $getaddress["upi_id"];
                    $response["deposit_value"] = $getaddress["deposit_value"];
                    $response["userid"] = $values["userid"];

                    $response["status"] = "success";
                    echo json_encode($response);

                } else {

                    $response["action"] = "notpay";

                    $response["status"] = "success";
                    echo json_encode($response);

                }
            }



        }

    } else if ($way == "cryptoaddress") {

        $user_id = $_POST["user_id"];
        $crypto_value = $_POST["cryptovalue"];
        $txnhashid = $_POST["txnhashid"];

        $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory WHERE user_id='{$user_id}'");

        $idactivationid = "";

        if (mysqli_num_rows($id) >= 1) {
            $getid = $id->fetch_assoc();
            $idval = (int) $getid["max_id"];
            $idactivationid = "IAI-".( $idval + 1);
        } else {
            $idactivationid = "IAI-1";
        }




        $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,txnhashid,action) VALUES
        ('{$idactivationid}','{$user_id}','Crypto','{$txnhashid}','admin')");

        $id = $con->query("SELECT MAX(id) AS max_id FROM idactivation WHERE user_id='{$user_id}'");

        $getid = $id->fetch_assoc();

        $tcvalue = $con->query("SELECT * FROM idactivationvalue");
        $gettcvalue = $tcvalue->fetch_assoc();


        $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,crypto_value,txnhash_id,travel_coupon,action,remark) VALUES
        ('{$idactivationid}',  '{$user_id}', 'Crypto', '{$crypto_value}', '{$txnhashid}', '{$gettcvalue["value"]}','admin', 'Waiting for Approval')");

        if ($insertactivationidhistory) {
            $response["status"] = "success";
            echo json_encode($response);
        } else {
            echo "error";
        }

    } else if ($way == "activationbank") {

        $user_id = $_POST["user_id"];
        $depositevalue = $_POST["depositevalue"];
        $transaction_id = $_POST["transaction_id"];

        $proofimage = $_FILES["proofimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $proofimage;

        if (move_uploaded_file($_FILES["proofimage"]["tmp_name"], "../../img/proofimage/" . $newImageName)) {

            $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory WHERE user_id='{$user_id}'");

            $idactivationid = "";

            if (mysqli_num_rows($id) >= 1) {
                $getid = $id->fetch_assoc();
                $idval = (int) $getid["max_id"];
                $idactivationid = "IAI-" . $idval + 1;
            } else {
                $idactivationid = "IAI-1";
            }


            $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,transaction_id,proof_image,action) VALUES
        ('{$idactivationid}','{$user_id}','Bank','{$transaction_id}','{$newImageName}','admin')");

           
            $tcvalue = $con->query("SELECT * FROM idactivationvalue");
            $gettcvalue = $tcvalue->fetch_assoc();

            $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,transaction_id,proof_image,bank_value,travel_coupon,action,remark) VALUES
        ('{$idactivationid}',  '{$user_id}', 'Bank', '{$transaction_id}', '{$newImageName}','{$depositevalue}', '{$gettcvalue["value"]}','admin', 'Waiting for Approval')");

            if ($insertactivationidhistory) {
                $response["status"] = "success";
                echo json_encode($response);
            } else {
                echo "error";
            }

        } else {

            echo "error";

        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>