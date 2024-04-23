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

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_id"] = $datarow["user_id"];
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];
            $response["user_sponserid"] = $datarow["user_sponserid"];
            $response["user_referalStatus"] = $datarow["user_referalStatus"];
            $response["created_at"] = $datarow["created_at"];
            $response["status"] = "success";

            $getlatestnews = $con->query("SELECT * FROM latestnews WHERE 1");
            $resnews = $getlatestnews->fetch_assoc();
            $response["news"] = $resnews["news"];

            $getimage = $con->query("SELECT * FROM galleryimages");

            $images = array();
            foreach ($getimage as $rowimage) {
                $images[] = $rowimage["imagename"];
            }
            
            $response["galleryimages"] = $images;

            echo json_encode($response);

        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>