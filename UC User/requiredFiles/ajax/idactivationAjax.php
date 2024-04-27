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

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>