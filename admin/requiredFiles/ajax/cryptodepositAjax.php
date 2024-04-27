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

        $getaddress = $con->query("SELECT * FROM idactivationdeposite");
        $rowaddress = $getaddress->fetch_assoc();

        $response["crypto_address"] = $rowaddress["crypto_address"];
        $response["crypto_value"] = $rowaddress["crypto_value"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updateaddress") {
        $depositaddress = $_POST["depositaddress"];
        $depositvalue = $_POST["depositvalue"];

        $updatedeposite = $con->query("UPDATE idactivationdeposite SET
        crypto_address='{$depositaddress}', crypto_value='{$depositvalue}'
        WHERE id=1");

        if ($updatedeposite) {
            $response["status"] = "success";
            echo json_encode($response);
        }
    } else if ($way == "updateimage") {

        $lastimage = $con->query("SELECT crypto_image FROM idactivationdeposite WHERE id=1");
        $getlastimage = $lastimage->fetch_assoc();

        $updateimage = $_FILES["updateimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $updateimage;

        if (unlink("../.././img/deposite/" . $getlastimage["crypto_image"])) {

            if (move_uploaded_file($_FILES["updateimage"]["tmp_name"], "../.././img/deposite/" . $newImageName)) {

                $insertimgsql = "UPDATE idactivationdeposite SET crypto_image ='{$newImageName}' WHERE id=1";
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

?>