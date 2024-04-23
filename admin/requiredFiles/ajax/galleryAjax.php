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

        $getimage = $con->query("SELECT * FROM galleryimages");

        $images = array();
        foreach ($getimage as $rowimage) {
            $images[] = $rowimage["imagename"];
        }

        $response["galleryimages"] = $images;
        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "insertimage") {

        $insertimage = $_FILES["addimage"]["name"];
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . $insertimage;

        if (move_uploaded_file($_FILES["addimage"]["tmp_name"], "../../img/gallery/" . $newImageName)) {

            $imagesql = $con->query("INSERT INTO galleryimages (imagename) VALUES ('{$newImageName}')");

            if ($imagesql) {

                $response["status"] = "success";
                echo json_encode($response);

            } else {

                echo "error";

            }

        } else {
            echo "error";
        }
    } else if ($way = "deleteimage") {

        $imagename = $_POST["imagename"];

        if (unlink("../../img/gallery/" . $imagename)) {

            $deleteimage = $con->query("DELETE FROM galleryimages WHERE imagename='{$imagename}'");

            if ($deleteimage) {

                $response["status"] = "success";
                echo json_encode($response);

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