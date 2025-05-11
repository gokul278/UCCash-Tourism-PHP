<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

require "./vendor/autoload.php";


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

        $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
        $getaddress = $address->fetch_assoc();

        $currency = $con->query("SELECT * FROM currency_rates WHERE cr_id=1");
        $getcurrency = $currency->fetch_assoc();

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
        $response["inr_value"] = $getcurrency["inr_rate"];

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way === "cryptoaddress") {

        $cryptoDepositeVal =  $_POST["cryptoDepositeVal"];
        $user_id = $_POST["user_id"];
        $txnhashid = $_POST["txnhashid"];

        $debitwallet = $con->query("INSERT INTO topupwallethistory (user_id, deposite_type, crypto_value, txnhash_id, topupwallet_value, action, remark) VALUES ('{$user_id}', 'Crypto', '{$cryptoDepositeVal}', '{$txnhashid}', '{$cryptoDepositeVal}','admin','Waiting for Approval')");
        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way === "activationbank") {

        $depositevalue = $_POST["depositevalue"];
        $user_id = $_POST["user_id"];
        $transaction_id = $_POST["transaction_id"];

        $proofimage = $_FILES["proofimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $proofimage;

        if (move_uploaded_file($_FILES["proofimage"]["tmp_name"], "../../img/proofimage/" . $newImageName)) {

            $currency = $con->query("SELECT * FROM currency_rates WHERE cr_id=1");
            $getcurrency = $currency->fetch_assoc();

            $inr_rate  = $getcurrency["inr_rate"];

            $topupval = number_format(((float)$depositevalue / (float)$inr_rate), 2, '.', '');

            $debitwallet = $con->query("INSERT INTO topupwallethistory (user_id, deposite_type, transaction_id, proof_image, bank_value, topupwallet_value, action, remark) 
            VALUES ('{$user_id}', 'Bank', '{$transaction_id}', '{$newImageName}', '{$depositevalue}', '{$topupval}', 'admin', 'Waiting for Approval')");
            $response["status"] = "success";
            echo json_encode($response);
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
