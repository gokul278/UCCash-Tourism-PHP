<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "verify") {

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "getData") {

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_phoneno"] = $datarow["user_phoneno"];
            $response["user_dob"] = $datarow["user_dob"];
            $response["user_aadharano"] = $datarow["user_aadharano"];
            $response["user_panno"] = $datarow["user_panno"];
            $response["user_maritalstatus"] = $datarow["user_maritalstatus"];
            $response["user_profileimg"] = $datarow["user_profileimg"];
            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "updatedetails") {

        $user_name = $_POST["inputFirstName"] . " " . $_POST["inputLastName"];
        $user_phoneno = $_POST["inputPhone"];
        $user_dob = $_POST["inputBirthday"];
        $user_aadharano = $_POST["Aadhaarnumber"];
        $user_panno = $_POST["pannumber"];
        $user_maritalstatus = "";
        if (isset($_POST["maritalstatus"])) {
            $user_maritalstatus = $_POST["maritalstatus"];
        }


        $detailsupdatesql = "UPDATE userdetails SET user_name='{$user_name}', user_dob='{$user_dob}', user_phoneno='{$user_phoneno}', user_aadharano='{$user_aadharano}', user_panno='{$user_panno}', user_maritalstatus='{$user_maritalstatus}' WHERE user_id='{$values["userid"]}'";
        $detailsupdateres = $con->query($detailsupdatesql);

        if ($detailsupdateres) {

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way = "updateimg") {

        $profileimg = $_FILES["profileimg"]["name"];
        $timestamp = date("YmdHis");

        $imagesql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $imageres = $con->query($imagesql);
        $imagerow = $imageres->fetch_assoc();
        $newImageName = $timestamp . '_' . $profileimg;

        $oldimage = $imagerow["user_profileimg"];

        if (!empty($oldimage)) {

            if (unlink("../../img/user/" . $oldimage)) {

                if (move_uploaded_file($_FILES["profileimg"]["tmp_name"], "../../img/user/" . $newImageName)) {

                    $insertimgsql = "UPDATE userdetails SET user_profileimg='{$newImageName}' WHERE user_id='{$values["userid"]}'";
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

        } else {

            if (move_uploaded_file($_FILES["profileimg"]["tmp_name"], "../../img/user/" . $newImageName)) {

                $insertimgsql = "UPDATE userdetails SET user_profileimg='{$newImageName}' WHERE user_id='{$values["userid"]}'";
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

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>