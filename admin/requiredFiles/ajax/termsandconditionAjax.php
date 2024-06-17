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

    } else if ($way == "pdfupload") {

        $pdfname = $_FILES["pdffile"]["name"];

        $newname = "UCCASH Tourism Terms and Conditions.pdf";

        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], "../../.././UC User/img/" . $newname)) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    } else if ($way == "pppdfupload") {

        $pdfname = $_FILES["pdffile"]["name"];

        $newname = "UCCASH Tourism Privacy Policy.pdf";

        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], "../../.././UC User/img/" . $newname)) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    } else if ($way == "papdfupload") {

        $pdfname = $_FILES["pdffile"]["name"];

        $newname = "UCCASH Tourism Payment Agreement.pdf";

        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], "../../.././UC User/img/" . $newname)) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    } else if ($way == "idapdfupload") {

        $pdfname = $_FILES["pdffile"]["name"];

        $newname = "UCCASH Tourism Indipendent Distributor Agreement.pdf";

        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], "../../.././UC User/img/" . $newname)) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    } else if ($way == "mapdfupload") {

        $pdfname = $_FILES["pdffile"]["name"];

        $newname = "UCCASH Tourism Membership Agreement.pdf";

        if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], "../../.././UC User/img/" . $newname)) {
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