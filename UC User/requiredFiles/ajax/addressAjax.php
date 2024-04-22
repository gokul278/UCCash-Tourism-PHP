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
            $response["user_fathername"] = $datarow["user_fathername"];
            $response["user_address"] = $datarow["user_address"];
            $response["user_city"] = $datarow["user_city"];
            $response["user_state"] = $datarow["user_state"];
            $response["user_zipcode"] = $datarow["user_zipcode"];
            $response["user_country"] = $datarow["user_country"];
            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "updateadress") {

        $user_name = $_POST["name"];
        $user_fathername = $_POST["fathername"];
        $user_address = $_POST["address"];
        $user_city = $_POST["District"];
        $user_state = $_POST["State"];
        $user_zipcode = $_POST["Pincode"];
        $user_country = $_POST["Country"];

        $updateaddresssql = "UPDATE userDetails 
                     SET user_name = '{$user_name}', 
                     user_fathername = '{$user_fathername}', 
                     user_address = '{$user_address}', 
                     user_city = '{$user_city}', 
                     user_state = '{$user_state}', 
                     user_zipcode = '{$user_zipcode}', 
                     user_country = '{$user_country}' 
                     WHERE user_id = '{$values["userid"]}'";

        $updateaddressres = $con->query($updateaddresssql);

        if ($updateaddressres) {
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