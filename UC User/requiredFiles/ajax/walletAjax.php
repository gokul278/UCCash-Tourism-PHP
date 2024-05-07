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
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            $walletaddresssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
            $walletaddressres = $con->query($walletaddresssql);

            if(mysqli_num_rows($walletaddressres) == 1){

                $walletaddressrow = $walletaddressres->fetch_assoc();
                $response["trc20_address"] = $walletaddressrow["trc20_address"];
                $response["bep20_address"] = $walletaddressrow["bep20_address"];

            }else{

                $response["trc20_address"] = "";
                $response["bep20_address"] = "";

            }

            $response["status"] = "success";
            echo json_encode($response);

        }

    }else if($way == "updatewallet"){

        $checkdetailssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
        $checkdetailsres = $con->query($checkdetailssql);

        $trc20_address = isset($_POST["trc20_address"]) ? $_POST["trc20_address"] : "";
        $bep20_address = isset($_POST["bep20_address"]) ? $_POST["bep20_address"] : "";

        if (mysqli_num_rows($checkdetailsres) == 1) {

            $updatebankdetailssql = "UPDATE userbankdetails SET 
                        trc20_address = '{$trc20_address}', 
                        bep20_address = '{$bep20_address}',
                        WHERE user_id = '{$values["userid"]}'";
            $updatebankdetailsres = $con->query($updatebankdetailssql);

            if ($updatebankdetailsres) {

                $response["status"] = "success";
                echo json_encode($response);

            }


        } else if (mysqli_num_rows($checkdetailsres) == 0) {

            $insertbandetailssql = "INSERT INTO userbankdetails (user_id, trc20_address, bep20_address) VALUES
            ('{$values["userid"]}','{$trc20_address}','{$bep20_address}')";
            $insertbandetailsres = $con->query($insertbandetailssql);

            if ($insertbandetailsres) {

                $response["status"] = "success";
                echo json_encode($response);

            }

        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>