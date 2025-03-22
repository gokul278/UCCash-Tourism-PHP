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

        $getaddress = $con->query("SELECT * FROM monthlysavings");
        $rowaddress = $getaddress->fetch_assoc();

        $response["crypto_address"] = $rowaddress["crypto_address"];
        $response["crypto_value"] = $rowaddress["ucc_value"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "updateaddress") {
        $depositaddress = $_POST["depositaddress"];
        $depositvalue = $_POST["depositvalue"];

        $updatedeposite = $con->query("UPDATE monthlysavings SET
        crypto_address='{$depositaddress}', ucc_value='{$depositvalue}'
        WHERE id=1");

        if ($updatedeposite) {
            $response["status"] = "success";
            echo json_encode($response);
        }
    } else if ($way == "updateimage") {

        $lastimage = $con->query("SELECT crypto_image FROM monthlysavings WHERE id=1");
        $getlastimage = $lastimage->fetch_assoc();

        $updateimage = $_FILES["updateimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $updateimage;

        if (unlink("../.././img/monthly/" . $getlastimage["crypto_image"])) {

            if (move_uploaded_file($_FILES["updateimage"]["tmp_name"], "../.././img/monthly/" . $newImageName)) {

                $insertimgsql = "UPDATE monthlysavings SET crypto_image ='{$newImageName}' WHERE id=1";
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
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
