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

        $tabledata = "";

        $data = $con->query("SELECT * FROM tourbookinghistory WHERE status = 'booked'");

        foreach ($data as $index => $getdata) {

            $user = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getuser = $user->fetch_assoc();

            $dateString = $getdata["booking_date"];

            $parts = explode(" ", $dateString);

            $date = $parts[0];
            $time = $parts[1];

            $tabledata .= '
            <tr>
                <th>' . ($index + 1) . '</th>
                <th>' . $getdata["user_id"] . '</th>
                <th style="white-space: nowrap;">' . $getuser["user_name"] . '</th>
                <th>' . $getuser["user_phoneno"] . '</th>
                <th>' . $getuser["user_email"] . '</th>
                <th style="white-space: nowrap;">' . $date . '<br>' . $time . '</th>
                <th>' . $getdata["booking_code"] . '</th>
                <th>' . $getdata["booking_destination"] . '</th>
                <th style="white-space: nowrap;">' . $getdata["booking_fromdate"] . '</th>
                <th style="white-space: nowrap;">' . $getdata["booking_todate"] . '</th>
                <th>' . $getdata["net_amount"] . '</th>
                <th>' . $getdata["booking_person"] . '</th>
                <th><button class="btn btn-success" onclick="changevisitedstatus(this)" id="' . $getdata["id"] . '">Change Status</button></th>
            </tr>
            ';
        }

        $data = $con->query("SELECT * FROM tourbookinghistory WHERE status = 'visited'");

        foreach ($data as $index => $getdata) {

            $user = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getuser = $user->fetch_assoc();

            $dateString = $getdata["booking_date"];

            $parts = explode(" ", $dateString);

            $date = $parts[0];
            $time = $parts[1];

            $tabledata .= '
            <tr>
                <th>' . ($index + 1) . '</th>
                <th>' . $getdata["user_id"] . '</th>
                <th style="white-space: nowrap;">' . $getuser["user_name"] . '</th>
                <th>' . $getuser["user_phoneno"] . '</th>
                <th>' . $getuser["user_email"] . '</th>
                <th style="white-space: nowrap;">' . $date . '<br>' . $time . '</th>
                <th>' . $getdata["booking_code"] . '</th>
                <th>' . $getdata["booking_destination"] . '</th>
                <th style="white-space: nowrap;">' . $getdata["booking_fromdate"] . '</th>
                <th style="white-space: nowrap;">' . $getdata["booking_todate"] . '</th>
                <th>' . $getdata["net_amount"] . '</th>
                <th>' . $getdata["booking_person"] . '</th>
                <th style="color:green">Visited</th>
            </tr>
            ';
        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way = "changevisitedstatus") {

        $id = $_POST["id"];

        $update = $con->query("UPDATE tourbookinghistory SET status='visited' WHERE id='{$id}'");

        if ($update) {

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