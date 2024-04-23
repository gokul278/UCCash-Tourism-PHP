<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./php_jwt/vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class token
{
    static function verify()
    {
        if (isset($_COOKIE['token'])) {

            $key = "403943087a70d97327defe86ed8c237admin";

            try {

                $token = $_COOKIE['token'];
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                
                $admin_id = $decoded->data->admin_id;
                $admin_name = $decoded->data->admin_name;
                $response["admin_id"] = $admin_id;
                $response["admin_name"] = $admin_name;
                $response["status"] = "success";
                return $response;


            } catch (Exception $e) {

                $response["status"] = "auth_failed";
                $response["message"] = $e->getMessage();
                return $response;

            }



        } else {

            $response["status"] = "auth_failed";
            $response["message"] = "Invalid Token";
            return $response;

        }
    }
}

?>