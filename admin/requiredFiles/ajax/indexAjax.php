<?php

include ("../../../requiredFiles/ajax/DBConnection.php");

require("./php_jwt/vendor/autoload.php");

use Firebase\JWT\JWT;

$way = $_POST["way"];

if ($way == "login") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $checkidsql = "SELECT * FROM admindetails WHERE admin_email = '{$email}'";
    $checkidres = $con->query($checkidsql);

    if (mysqli_num_rows($checkidres) == 1) {

        $row = $checkidres->fetch_assoc();

        if (md5($password) == $row["admin_password"]) {

            $key = "403943087a70d97327defe86ed8c237admin";

            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600,
                    'data' => array(
                        'admin_id' => $row["admin_id"],
                        'admin_name' => $row["admin_name"]
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
        $response["message"] = "Invalid E-Mail";
        echo json_encode($response);

    }

}else if ($way == "getData") {

        
    $details = $con->query("SELECT * FROM admindetails WHERE admin_id='UCT000000'");
    
    $getdetails = $details->fetch_assoc();
    
    
    $response["admin_name"] = $getdetails["admin_name"];
    $response["profile_image"] = $getdetails["admin_profile"];

    $response["status"] = "success";
    echo json_encode($response);

} else {
    $response["status"] = "failed";
    $response["message"] = "try Again";
    echo json_encode($response);
}

?>