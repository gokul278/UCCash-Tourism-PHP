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

        $response["admin_name"] = $values["admin_name"];

        $activationvalue = $con->query("SELECT * FROM idactivationvalue WHERE id=1");
        $getactivationvalue = $activationvalue->fetch_assoc();

        $response["activationvalue"] = $getactivationvalue["value"];

        $response["status"] = "success";
        echo json_encode($response);

    }else if($way == "updateactivationvalue"){

        $activationvalue = $_POST["activationvalue"];

        $updatevalue = $con->query("UPDATE idactivationvalue SET value='{$activationvalue}' WHERE id=1");

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>