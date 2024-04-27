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

        $response["ac_holdername"] = $rowaddress["ac_holdername"];
        $response["ac_number"] = $rowaddress["ac_number"];
        $response["ifsc_code"] = $rowaddress["ifsc_code"];
        $response["branch"] = $rowaddress["branch"];
        $response["upi_id"] = $rowaddress["upi_id"];
        $response["deposit_value"] = $rowaddress["deposit_value"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updatedetails") {
        
        $ac_holdername = $_POST["ac_holdername"];
        $ac_number = $_POST["ac_number"];
        $ifsc_code = $_POST["ifsc_code"];
        $branch = $_POST["branch"];
        $upi_id = $_POST["upi_id"];
        $deposit_value = $_POST["deposit_value"];

        $updatedeposite = $con->query("UPDATE idactivationdeposite SET
        ac_holdername='{$ac_holdername}', ac_number='{$ac_number}',
        ifsc_code='{$ifsc_code}', branch='{$branch}',
        upi_id='{$upi_id}', deposit_value='{$deposit_value}'
        WHERE id=1");

        if ($updatedeposite) {
            $response["status"] = "success";
            echo json_encode($response);
        }else{
            echo "error";
        }

    } else if ($way == "updateimage") {

        $lastimage = $con->query("SELECT bankdeposit_image FROM idactivationdeposite WHERE id=1");
        $getlastimage = $lastimage->fetch_assoc();

        $updateimage = $_FILES["updateimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $updateimage;

        if (unlink("../.././img/deposite/" . $getlastimage["bankdeposit_image"])) {

            if (move_uploaded_file($_FILES["updateimage"]["tmp_name"], "../.././img/deposite/" . $newImageName)) {

                $insertimgsql = "UPDATE idactivationdeposite SET bankdeposit_image ='{$newImageName}' WHERE id=1";
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