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

            $checkdetailssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
            $checkdetailsres = $con->query($checkdetailssql);

            if (mysqli_num_rows($checkdetailsres) == 1) {

                $detailsrow = $checkdetailsres->fetch_assoc();
                $response["ac_holdername"] = $detailsrow["ac_holdername"];
                $response["ac_bankname"] = $detailsrow["ac_bankname"];
                $response["ac_number"] = $detailsrow["ac_number"];
                $response["ifsc_code"] = $detailsrow["ifsc_code"];
                $response["branch"] = $detailsrow["branch"];

            } else if (mysqli_num_rows($checkdetailsres) == 0) {

                $response["ac_holdername"] = "";
                $response["ac_bankname"] = "";
                $response["ac_number"] = "";
                $response["ifsc_code"] = "";
                $response["branch"] = "";

            }

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "bankdetailsupdate") {

        $checkdetailssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
        $checkdetailsres = $con->query($checkdetailssql);

        $ac_holdername = $_POST["acholdername"];
        $ac_bankname = $_POST["acbankname"];
        $ac_number = $_POST["acnumber"];
        $ifsc_code = $_POST["ifsccode"];
        $branch = $_POST["branch"];

        if (mysqli_num_rows($checkdetailsres) == 1) {

            $updatebankdetailssql = "UPDATE userbankdetails SET 
                        ac_holdername = '{$ac_holdername}', 
                        ac_bankname = '{$ac_bankname}', 
                        ac_number = '{$ac_number}', 
                        ifsc_code = '{$ifsc_code}', 
                        branch = '{$branch}' 
                        WHERE user_id = '{$values["userid"]}'";
            $updatebankdetailsres = $con->query($updatebankdetailssql);

            if ($updatebankdetailsres) {

                $response["status"] = "success";
                echo json_encode($response);

            }


        } else if (mysqli_num_rows($checkdetailsres) == 0) {

            $insertbandetailssql = "INSERT INTO userbankdetails (user_id, ac_holdername, ac_bankname, ac_number, ifsc_code, branch) VALUES
            ('{$values["userid"]}','{$ac_holdername}','{$ac_bankname}','{$ac_number}','{$ifsc_code}','{$branch}')";
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