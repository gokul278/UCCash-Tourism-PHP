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

            $checksponserid = "SELECT * FROM userdetails WHERE user_id='{$datarow["user_sponserid"]}'";
            $checksponserisres = $con->query($checksponserid);

            $datarowsponser = $checksponserisres->fetch_assoc();

            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];
            $response["sponser_name"] = $datarowsponser["user_name"];
            $response["user_phoneno"] = $datarow["user_phoneno"];
            $response["user_email"] = $datarow["user_email"];
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