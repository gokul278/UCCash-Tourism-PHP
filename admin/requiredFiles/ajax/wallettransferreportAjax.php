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

        $index = 0;

        $data = $con->query("SELECT * FROM availablewithdrwabalance WHERE awb_action='credit'");

        foreach ($data as $getdata) {

            $index++;

            $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $tabledata .= '
            <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $getdata["awb_createdat"] . '</td>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getname["user_name"] . '</td>
                <td>' . $getdata["awb_from"] . '</td>
                <td>' . $getdata["awb_to"] . '</td>
                <td>' . $getdata["awb_points"] . '</td>
                <td class="green">Successfully Credited</td>
            </tr>
            ';

        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "seachid") {

        $userid = $_POST["userid"];


        $tabledata = "";

        $index = 0;

        $data = $con->query("SELECT * FROM availablewithdrwabalance WHERE user_id='{$userid}' AND awb_action='credit'");

        $checkuser = $con->query("SELECT * FROM userdetails WHERE user_id='{$userid}'");


        if (mysqli_num_rows($checkuser) >= 1) {

            foreach ($data as $getdata) {

                $index++;

                $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
                $getname = $name->fetch_assoc();

                $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <td>' . $getdata["awb_createdat"] . '</td>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>' . $getdata["awb_from"] . '</td>
                    <td>' . $getdata["awb_to"] . '</td>
                    <td>' . $getdata["awb_points"] . '</td>
                    <td class="green">Successfully Credited</td>
                </tr>
                ';

            }

        } else {

            $tabledata .= '<tr><td colspan="8">Invalid User ID</td></tr>';

        }



        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "searchdate") {

        $fromdate = $_POST["fromdate"];
        $todate = $_POST["todate"];

        // Sanitize and validate the input dates
        $fromdate = date('Y-m-d 00:00:00', strtotime($fromdate));
        $todate = date('Y-m-d 23:59:59', strtotime($todate));

        $tabledata = "";
        $index = 0;

        // Prepare and execute the query with date filtering
        $stmt = $con->prepare("SELECT * FROM availablewithdrwabalance WHERE awb_createdat >= ? AND awb_createdat <= ?;");
        $stmt->bind_param("ss", $fromdate, $todate);
        $stmt->execute();
        $result = $stmt->get_result();


        foreach ($result as $getdata) {

            $index++;

            $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $tabledata .= '
            <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $getdata["awb_createdat"] . '</td>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getname["user_name"] . '</td>
                <td>' . $getdata["awb_from"] . '</td>
                <td>' . $getdata["awb_to"] . '</td>
                <td>' . $getdata["awb_points"] . '</td>
                <td class="green">Successfully Credited</td>
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