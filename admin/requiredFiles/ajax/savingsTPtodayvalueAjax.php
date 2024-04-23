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

        $getuccvalue = $con->query("SELECT * FROM uccvalue WHERE id='1'");

        $getrowuccvalue = $getuccvalue->fetch_assoc();

        $response["admin_name"] = $values["admin_name"];
        $response["uccvalue"] = $getrowuccvalue["value"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updateuccvalue") {

        $uccvalue = $_POST["uccvalue"];

        $updateuccvalue = $con->query("UPDATE uccvalue SET value='{$uccvalue}' WHERE 1");

        if ($updateuccvalue) {

            $response["status"] = "success";
            echo json_encode($response);

        } else {

            $response["status"] = "error";
            echo json_encode($response);
            
        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>