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

        $getlatestnews = $con->query("SELECT * FROM latestnews WHERE 1");

        $resnews = $getlatestnews->fetch_assoc();

        $response["news"] = $resnews["news"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updatenews") {

        $news = $_POST["news"];

        $updatenews = $con->query("UPDATE latestnews SET news='{$news}' WHERE id=1");

        if ($updatenews) {

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