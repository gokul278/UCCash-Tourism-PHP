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

            $table = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$values["userid"]}'");

            $index = 0;

            foreach ($table as $index => $gettable) {
                $index++;
                $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <th>' . $gettable["idactivation_id"] . '</th>
                    <td>' . date("d-m-Y", strtotime($gettable["paid_date"])) . '</td>
                    <td>' . $gettable["user_id"] . '</td>
                    <td>' . $gettable["deposite_type"] . '</td>
                ';

                if ($gettable["deposite_type"] == "Crypto") {

                    $tabledata .= '
                    <td>' . $gettable["crypto_value"] . '</td>
                    <td>' . $gettable["travel_coupon"] . '</td>
                    <td>' . $gettable["txnhash_id"] . '</td>                    
                ';

                } else if ($gettable["deposite_type"] == "Bank") {

                    $tabledata .= '
                    <td>' . $gettable["bank_value"] . '</td>
                    <td>' . $gettable["travel_coupon"] . '</td>
                    <td>' . $gettable["transaction_id"] . '</td>
                ';

                }

                if ($gettable["action"] == "admin") {

                    $tabledata .= '
                <td class="red">' . $gettable["remark"] . '</td>
                <td style="color:#bf7036">Pending</td>
                </tr>';

                } else if ($gettable["action"] == "paid") {
                    $tabledata .= '
                    <td class="green">' . $gettable["remark"] . '</td>
                        <td>
                            <button type="button" class="btn btn-warning"><b>View</b></button>
                        </td>
                    </tr>';
                } else if ($gettable["action"] == "reject"){
                    $tabledata .= '
                        <td class="red">' . $gettable["remark"] . '</td>
                        <td style="color:red">Rejected</td>
                        </tr>';
                }

            }

            $response["tabledata"] = $tabledata;
            $response["status"] = $values["status"];
            echo json_encode($response);

        }

    } else if ($way == "filterdate") {
        $fromDate = $_POST["fromDate"];
        $toDate = $_POST["toDate"];

        $table = $con->query("SELECT * 
        FROM idactivationhistory 
        WHERE user_id = '{$values["userid"]}'
        AND paid_date BETWEEN '{$fromDate}' AND '{$toDate}';
        ");

        $tabledata = "";

        $index = 0;

        foreach ($table as $index => $gettable) {
            $index++;
            $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <th>' . $gettable["idactivation_id"] . '</th>
                    <td>' . date("d-m-Y", strtotime($gettable["paid_date"])) . '</td>
                    <td>' . $gettable["user_id"] . '</td>
                    <td>' . $gettable["deposite_type"] . '</td>
                ';

            if ($gettable["deposite_type"] == "Crypto") {

                $tabledata .= '
                    <td>' . $gettable["crypto_value"] . '</td>
                    <td>' . $gettable["travel_coupon"] . '</td>
                    <td>' . $gettable["txnhash_id"] . '</td>                    
                ';

            } else if ($gettable["deposite_type"] == "Bank") {

                $tabledata .= '
                    <td>' . $gettable["bank_value"] . '</td>
                    <td>' . $gettable["travel_coupon"] . '</td>
                    <td>' . $gettable["transaction_id"] . '</td>
                ';

            }

            if ($gettable["action"] == "admin") {
                $tabledata .= '
                <td class="red">' . $gettable["remark"] . '</td>
                <td style="color:#bf7036">Pending</td>
                </tr>';

            } else if ($gettable["action"] == "paid") {
                $tabledata .= '
                    <td class="green">' . $gettable["remark"] . '</td>
                        <td>
                            <button type="button" class="btn btn-warning"><b>View</b></button>
                        </td>
                    </tr>';
            } else if ($gettable["action"] == "reject"){
                $tabledata .= '
                    <td class="red">' . $gettable["remark"] . '</td>
                        <td>
                        </td>
                    </tr>';
            }

        }

        $response["tabledata"] = $tabledata;
        $response["status"] = $values["status"];
        echo json_encode($response);


    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>