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

        $imagedata = $con->query("SELECT * FROM flashbanner WHERE id =1");
        $getimagedata = $imagedata->fetch_assoc();

        $response["bannerimage"] = $getimagedata["bannerimage"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updateflashbanner") {

        $flashimage = $_FILES["flashbanner"]["name"];
        $timestamp = date("YmdHis");

        $imagesql = "SELECT * FROM flashbanner WHERE id=1";
        $imageres = $con->query($imagesql);
        $imagerow = $imageres->fetch_assoc();
        $newImageName = $timestamp . '_' . $flashimage;

        $oldimage = $imagerow["bannerimage"];

        if (!empty($oldimage)) {

            if (unlink("../../../img/flashbanner/" . $oldimage)) {

                if (move_uploaded_file($_FILES["flashbanner"]["tmp_name"], "../../../img/flashbanner/" . $newImageName)) {

                    $insertimgsql = "UPDATE flashbanner SET bannerimage ='{$newImageName}' WHERE id=1";
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

        }else{

            if (move_uploaded_file($_FILES["flashbanner"]["tmp_name"], "../../../img/flashbanner/" . $newImageName)) {

                    $insertimgsql = "UPDATE flashbanner SET bannerimage ='{$newImageName}' WHERE id=1";
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

        }

    } else if ($way == "deleteimage") { {

            $bannername = $_POST["bannername"];

            if (unlink("../../../img/flashbanner/" . $bannername)) {

                $deleteimage = $con->query("UPDATE flashbanner SET bannerimage=NULL WHERE id=1");

                if ($deleteimage) {
                    $response["status"] = "success";
                    echo json_encode($response);
                }

            }else{
                echo "fileerror";
            }

        }
    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>