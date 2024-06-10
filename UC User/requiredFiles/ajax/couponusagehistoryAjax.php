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

            $data = $con->query("SELECT * FROM travelcouponpoints WHERE user_id='{$values["userid"]}' AND tc_action='debit'");

            $tabledata = "";

            foreach($data as $index=>$getdata){

                $tabledata .= '
                <tr>
                    <th>'.($index+1).'</th>
                    <th>'.$getdata["tc_createdat"].'</th>
                    <th>'.$getdata["user_id"].'</th>
                    <th>Tour Booking</th>
                    <th>'.$getdata["tc_points"].'</th>
                    <th style="color:green">Successfully Booked</th>
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