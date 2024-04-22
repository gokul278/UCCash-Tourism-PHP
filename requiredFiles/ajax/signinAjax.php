<?php

include ("./DBConnection.php"); //DB Connection File

require ("../../UC User/requiredFiles/ajax/php_jwt/vendor/autoload.php");

use Firebase\JWT\JWT;

$way = $_POST["way"];


if ($way == "login") {

    $userid = $_POST["userid"];
    $password = $_POST["password"];

    $checkidsql = "SELECT * FROM userdetails WHERE user_id = '{$userid}'";
    $checkidres = $con->query($checkidsql);

    if (mysqli_num_rows($checkidres) == 1) {

        $row = $checkidres->fetch_assoc();


        if (md5($password) == $row["user_password"]) {

            $key = "403943087a70d97327defe86ed8c237a";

            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600,
                    'data' => array(
                        'user_id' => $userid,
                        'user_name' => $row["user_name"]
                    )
                ), 
                $key,
                'HS256'
            );

            setcookie("token", $token, time()+3600, "/", "", true, true);

            $response["status"] = "success";
            echo json_encode($response);

        } else {

            $response["status"] = "failed";
            $response["message"] = "Invalid Password";
            echo json_encode($response);

        }

    } else {

        $response["status"] = "failed";
        $response["message"] = "Invalid User ID";
        echo json_encode($response);

    }

} else {
    $response["status"] = "failed";
    $response["message"] = "try Again";
    echo json_encode($response);
}
?>