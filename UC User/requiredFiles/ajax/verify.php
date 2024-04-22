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

            $key = "403943087a70d97327defe86ed8c237a";

            try {

                $token = $_COOKIE['token'];
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                
                $user_id = $decoded->data->user_id;
                $response["userid"] = $user_id;
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