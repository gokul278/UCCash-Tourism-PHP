<?php

include ("../../../requiredFiles/ajax/DBConnection.php");

$way = $_POST["way"];

if ($way == "changepass") {

    $hash_value = $_POST["hashvalue"];
    $password = md5($_POST["password"]);

    $data = $con->query("SELECT * FROM admindetails WHERE admin_id='UCT000000'");
    $getdata = $data->fetch_assoc();

    if ($getdata["admin_forgetpasshash"] == $hash_value && $getdata["admin_remark"] == "pending") {


        $updatesql = "UPDATE admindetails SET admin_password='{$password}', admin_forgetpasshash = null, admin_remark=null WHERE admin_id='UCT000000'";
        $updateres = $con->query($updatesql);

        if ($updateres) {
            $response["status"] = "success";
            echo json_encode($response);
        }else{
            $response["status"] = "error";
        echo json_encode($response);
        }


    } else {

        $response["status"] = "error";
        $response["message"] = "Try Again With New Forget Mail";
        echo json_encode($response);

    }

}else{
    echo "error";
}

?>