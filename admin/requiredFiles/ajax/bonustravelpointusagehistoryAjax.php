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

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $data = $con->query("
                SELECT
                    btp.bt_id,
                    btp.user_id,
                    btp.bt_points,
                    btp.bt_bonusfrom,
                    btp.bt_lvl,
                    btp.bt_action,
                    btp.bt_remark,
                    btp.bt_createdat,
                    tbh.id AS tour_id,
                    tbh.booking_date,
                    tbh.booking_id,
                    tbh.booking_destination,
                    tbh.booking_code,
                    tbh.booking_person,
                    tbh.booking_amount,
                    tbh.paymentmethod_description,
                    tbh.payment_amount,
                    tbh.status
                FROM
                    bonustravelpoints AS btp
                INNER JOIN
                    tourbookinghistory AS tbh
                ON
                    btp.user_id = tbh.user_id
                WHERE
                    btp.bt_action = 'debit' AND btp.bt_createdat = tbh.booking_date
                ");

        $tabledata = "";
        
        foreach($data as $index=>$getdata){

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $tabledata .= '
            <tr>
                <th>'.($index+1).'</th>
                <th>'.($getdata["bt_createdat"]).'</th>
                <th>'.($getdata["user_id"]).'</th>
                <th>'.($getname["user_name"]).'</th>
                <th>'.($getdata["bt_points"]).'</th>
                <th>Tour Booking</th>
                <th>'.($getdata["booking_code"]).'</th>
                <th style="color:green">Successfully Booked</th>
            </tr>
            ';
        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>