<?php

include ("./DBConnection.php"); //DB Connection File

$way = $_POST["way"];

if($way == "getflashbanner"){

    $getflashbanner = $con->query("SELECT * FROM flashbanner WHERE id=1");

    $flashbanner = $getflashbanner->fetch_assoc();

    $response["status"] = "success";
    $response["flashbanner"] = $flashbanner["bannerimage"];
    echo json_encode($response);

}


?>