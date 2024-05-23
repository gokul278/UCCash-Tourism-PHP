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

        $historydata = $con->query("SELECT iah.*, ud.user_name
        FROM idactivationhistory AS iah
        JOIN userdetails AS ud ON iah.user_id = ud.user_id
        WHERE iah.action != 'admin'");

        $tabledata = "";
        $index = 0;

        foreach ($historydata as $index => $rowhistorydata) {
            $index++;
            $tabledata .= '
            <tr align="center">
                <th scope="row">' . $index . '</th>
                <td>' . $rowhistorydata["idactivation_id"] . '</td>
                <td>' . $rowhistorydata["paid_date"] . '</td>
                <td>' . $rowhistorydata["user_id"] . '</td>
                <td>' . $rowhistorydata["user_name"] . '</td>
                <td>' . $rowhistorydata["deposite_type"] . '</td>
            ';


            if ($rowhistorydata["deposite_type"] == "Crypto") {

                $tabledata .= '
                    <td>' . $rowhistorydata["crypto_value"] . '</td>
                    <td>' . $rowhistorydata["txnhash_id"] . '</td>                    
                ';

            } else if ($rowhistorydata["deposite_type"] == "Bank") {

                $tabledata .= '
                    <td>' . $rowhistorydata["bank_value"] . '</td> 
                    <td>' . $rowhistorydata["transaction_id"] . '<br><button class="btn btn-success view-proof-image" data-src=".././UC User/img/proofImage/' . $rowhistorydata["proof_image"] . '"><i class="bi bi-eye-fill"></i></button></td>
                ';

            }

            if($rowhistorydata["action"] == "paid"){

                $tabledata .= '
                <td style="color:#49f4a4">
                    Approved
                </td>
                <td style="color:#49f4a4">
                    Activation Successful
                </td>';


            }else if($rowhistorydata["action"] == "reject"){

                $tabledata .= '
                <td style="color:red">
                    Rejected
                </td>
                <td style="color:red">
                    '.$rowhistorydata["remark"].'
                </td>';

            }

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