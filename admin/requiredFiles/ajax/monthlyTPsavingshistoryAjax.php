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

        $gettable = $con->query("SELECT msh.*, ud.user_name
        FROM monthlytpsavinghistory AS msh
        JOIN userdetails AS ud ON msh.user_id = ud.user_id
        WHERE msh.action != 'admin'");

        $table = "";

        foreach ($gettable as $key => $element) {
            $table .= '
            <tr align="center">
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $element["invoice_id"] . '</td>
                <td>' . $element["paid_date"] . '</td>
                <td>' . $element["invoice_date"] . '</td>
                <td>' . $element["user_id"] . '</td>
                <td>' . $element["user_name"] . '</td>
                <td>' . $element["payment_type"] . '</td>
                <td>' . $element["txn_hashid"] . '</td>
                <td>' . $element["amount"] . '</td>
                ';

            if ($element["action"] == "reject") {
                $table .= '
                        <td></td>
                        <td class="red">Rejected<br>' . $element["remark"] . '</td>
                    </tr>';
            } else if ($element["action"] == "paid") {
                $table .= '
                        <td>' . $element["credit_tp"] . ' TP</td>
                        <td class="green">Approved</td>
                    </tr>';
            }
        }

        $response["table"] = $table;
        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>