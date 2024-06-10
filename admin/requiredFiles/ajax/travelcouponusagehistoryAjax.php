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
                    tcp.tc_id,
                    tcp.user_id,
                    tcp.tc_points,
                    tcp.tc_action,
                    tcp.tc_remark,
                    tcp.tc_createdat,
                    tbh.id,
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
                    travelcouponpoints AS tcp
                INNER JOIN
                    tourbookinghistory AS tbh
                ON
                    tcp.user_id = tbh.user_id
                WHERE
                    tcp.tc_action = 'debit' AND tcp.tc_createdat = tbh.booking_date
                ");

        $tabledata = "";
        
        foreach($data as $index=>$getdata){

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $tabledata .= '
            <tr>
                <th>'.($index+1).'</th>
                <th>'.($getdata["tc_createdat"]).'</th>
                <th>'.($getdata["user_id"]).'</th>
                <th>'.($getname["user_name"]).'</th>
                <th>'.($getdata["tc_points"]).'</th>
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