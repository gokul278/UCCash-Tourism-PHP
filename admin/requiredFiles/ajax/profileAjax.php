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

    } else if ($way == "getmemberid") {

        $member_id = $_POST["memberid"];

        $checkmember = $con->query("SELECT * FROM userdetails WHERE user_id='{$member_id}'");

        if (mysqli_num_rows($checkmember) == 1) {

            $getmember = $checkmember->fetch_assoc();

            $response["user_sponserid"] = $getmember["user_sponserid"];
            $response["user_id"] = $getmember["user_id"];
            $response["user_name"] = $getmember["user_name"];
            $response["user_dob"] = $getmember["user_dob"];
            $response["user_aadharano"] = $getmember["user_aadharano"];
            $response["user_panno"] = $getmember["user_panno"];
            $response["user_phoneno"] = $getmember["user_phoneno"];
            $response["user_email"] = $getmember["user_email"];
            $response["user_gender"] = $getmember["user_gender"];

            $getwallet = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$member_id}'");

            if ($getwallet && $getwallet->num_rows > 0) {
                $gettrc = $getwallet->fetch_assoc();
                $response["trc20_address"] = $gettrc["trc20_address"];
            } else {
                $response["trc20_address"] = "";
            }


            $response["status"] = "success";
            $response["member"] = "valid";
            echo json_encode($response);

        } else {
            $response["status"] = "success";
            $response["member"] = "invalid";
            echo json_encode($response);
        }


    } else if ($way == "updateeditprofile") {

        $user_id = $_POST["userid"];
        $user_name = $_POST["username"];
        $user_dob = $_POST["dob"];
        $user_aadharano = $_POST["aadhaarno"];
        $user_panno = $_POST["panno"];
        $user_phoneno = $_POST["phoneno"];
        $user_email = $_POST["email"];
        $user_gender = isset($_POST["gender"]);
        $wallet = isset($_POST["wallet"]) ? $_POST["wallet"] : "";

        $updateuser = $con->query("UPDATE userdetails SET user_name='{$user_name}',
    user_dob='{$user_dob}', user_aadharano='{$user_aadharano}', user_panno='{$user_panno}',
    user_phoneno='{$user_phoneno}', user_email='{$user_email}', user_gender='{$user_gender}'
    WHERE user_id='{$user_id}'");

        if ($updateuser) {
            $checkbank = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$user_id}'");

            if (mysqli_num_rows($checkbank) == 1) {
                $updatebank = $con->query("UPDATE userbankdetails SET trc20_address='{$wallet}' WHERE user_id='{$user_id}'");
                if ($updatebank) {
                    $response["status"] = "success";
                    echo json_encode($response);
                } else {
                    echo "Error updating bank details: " . mysqli_error($con);
                }
            } else {
                $insertbank = $con->query("INSERT INTO userbankdetails (user_id,trc20_address) VALUES ('{$user_id}','{$wallet}')");
                if ($insertbank) {
                    $response["status"] = "success";
                    echo json_encode($response);
                } else {
                    echo "Error inserting bank details: " . mysqli_error($con);
                }
            }
        } else {
            echo "Error updating user details: " . mysqli_error($con);
        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>