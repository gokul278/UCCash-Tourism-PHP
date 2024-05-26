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

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $response["status"] = "success";
        echo json_encode($response);

    }else if ($way == "getusername") {

        $user_id = $_POST["userid"];

        $user = $con->query("SELECT * FROM userdetails WHERE user_id='{$user_id}'");

        if (mysqli_num_rows($user) >= 1) {

            $getuser = $user->fetch_assoc();
            $response["message"] = $getuser["user_name"];
            $response["status"] = "success";
            echo json_encode($response);


        } else {

            $response["message"] = "noid";
            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "depositucc"){

        $userid = $_POST["userid"];
        $depositevalue = $_POST["depositvalue"];

        $depositevalue = number_format($depositevalue, 2);

        $walletvalue = $con->query("INSERT INTO uccwalletpoints (user_id,uccw_points,uccw_action,uccw_remark)
        VALUES ('{$userid}','{$depositevalue}','credit','UCC Wallet')");

        if($walletvalue){
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