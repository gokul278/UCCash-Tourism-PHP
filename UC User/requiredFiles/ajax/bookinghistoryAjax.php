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

            $data = $con->query("SELECT * FROM tourbookinghistory WHERE user_id='{$values["userid"]}'");

            $tabledata = "";
            
            foreach($data as $index=>$getdata){

                $tabledata .= '
                <tr>
                    <th>'.($index+1).'</th>
                    <th>'.$getdata["booking_date"].'</th>
                    <th>'.$getdata["booking_amount"].' TP</th>
                    <th>'.$getdata["booking_destination"].'</th>
                    <th>'.$getdata["booking_code"].'</th>
                    <th>'.$getdata["booking_person"].'</th>
                    <th>'.$getdata["paymentmethod_description"].'</th>
                    <th>'.$getdata["payment_amount"].' TP</th>
                    <th style="color:green">Successfully Booked</th>
                    <th><button class="btn btn-warning" onclick="tourinvoice(this)" id="'.$getdata["id"].'" userid="'.$values["userid"].'"><b>View</b></button></th>
                </tr>
                ';

            }

            $response["tabledata"] = $tabledata;

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