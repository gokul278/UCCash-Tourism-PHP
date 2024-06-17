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

    } else if ($way == "imgupdate") {
        $profileimg = $_FILES["profileimg"]["name"];
        $timestamp = date("YmdHis");

        $imagesql = "SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'";
        $imageres = $con->query($imagesql);
        $imagerow = $imageres->fetch_assoc();
        $newImageName = $timestamp . '_' . $profileimg;

        if ($imagerow["admin_profile"] != null) {

            $oldimage = $imagerow["admin_profile"];

            if (!empty($oldimage)) {

                if (unlink("../../img/user/" . $oldimage)) {

                    if (move_uploaded_file($_FILES["profileimg"]["tmp_name"], "../../img/user/" . $newImageName)) {

                        $insertimgsql = "UPDATE admindetails SET admin_profile='{$newImageName}' WHERE admin_id='{$values["admin_id"]}'";
                        $insertimgres = $con->query($insertimgsql);

                        if ($insertimgres) {

                            $response["status"] = "success";
                            echo json_encode($response);

                        } else {

                            echo "error";

                        }

                    } else {

                        echo "error";

                    }

                } else {

                    echo "error";

                }
            }

        } else {
            if (move_uploaded_file($_FILES["profileimg"]["tmp_name"], "../../img/user/" . $newImageName)) {

                $insertimgsql = "UPDATE admindetails SET admin_profile='{$newImageName}' WHERE admin_id='{$values["admin_id"]}'";
                $insertimgres = $con->query($insertimgsql);

                if ($insertimgres) {

                    $response["status"] = "success";
                    echo json_encode($response);

                } else {

                    echo "error";

                }
            }
        }




    } else if ($way == "passwordchnage") {
        $currentpassword = $_POST["currentpassword"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
    
        $checkidsql = "SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'";
        $checkidres = $con->query($checkidsql);
    
        $row = $checkidres->fetch_assoc();
    
        if (md5($currentpassword) == $row["admin_password"]) {
            if ($password == $repassword) {
                $newpass = md5($password);
    
                $update = $con->query("UPDATE admindetails SET admin_password='{$newpass}' WHERE admin_id='{$values["admin_id"]}'");
    
                if ($update) {
                    $response["status"] = "success";
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Error updating password";
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "Check Confirm Password";
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Current Password Wrong";
        }
        echo json_encode($response);
    }
    

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>