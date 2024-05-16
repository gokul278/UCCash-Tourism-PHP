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

            $tabledata = "";
            $index = 0;
            $balance = 0;

            $data = $con->query("SELECT * FROM availablewithdrwabalance WHERE user_id='{$values["userid"]}'");

            foreach ($data as $getdata) {

                $dateString = $getdata["awb_createdat"];
                $parts = explode(" ", $dateString);
                $date = $parts[0];
                $time = $parts[1];

                $index++;
                $credit = 0;
                $debit = 0;

                $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <td>' . $date . ' <p class="time">' . $time . '</p></td>
                    <td>' . $getdata["awb_from"] . '</td>
                    <td>' . $getdata["awb_to"] . '</td>
                ';

                if ($getdata["awb_action"] == "credit") {
                    $credit = (float) $getdata["awb_points"];
                    $balance += $credit;
                    $tabledata .= '
                    <td>' . number_format($getdata["awb_points"],2) . '$</td>
                    <td></td>
                    ';
                } else if ($getdata["awb_action"] == "debit") {
                    $debit = (float) $getdata["awb_points"];
                    $balance -= $debit;
                    $tabledata .= '
                    <td></td>
                    <td>' . number_format($getdata["awb_points"],2) . '$</td>
                    ';
                }

                $tabledata .= '
                    <td>' . number_format($balance,2) . '$</td>
                </tr>';

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