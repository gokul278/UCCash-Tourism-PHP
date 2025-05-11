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

            $table = $con->query("SELECT * FROM topupwallethistory WHERE user_id='{$values["userid"]}'");

            $index = 0;

            foreach ($table as $index => $gettable) {
                $index++;
                $tabledata .= '
                <tr>
                    <th scope="row">' . $index . '</th>
                    <td>' . date("d-m-Y", strtotime($gettable["paid_date"])) . '</td>
                    <th scope="row">' . $gettable["deposite_type"] . '</th>
                ';


                if ($gettable["deposite_type"] == "Crypto") {

                    $tabledata .= '
                    <td> $ ' . $gettable["crypto_value"] . '</td>
                    <td>' . $gettable["txnhash_id"] . '</td>                    
                ';
                } else if ($gettable["deposite_type"] == "Bank") {

                    $tabledata .= '
                    <td>Rs. ' . $gettable["bank_value"] . '</td>
                    <td>' . $gettable["transaction_id"] . '</td>
                ';
                }

                $tabledata .= '
                    <th scope="row">' . $gettable["topupwallet_value"] . '</th>
                ';

                if ($gettable["action"] == "admin") {

                    $tabledata .= '
                <td class="red">Pending <br/>' . $gettable["remark"] . '</td>
                </tr>';
                } else if ($gettable["action"] == "paid") {
                    $tabledata .= '
                        <td class="green">Approved <br/>' . $gettable["remark"] . '</td>
                       </tr>';
                } else if ($gettable["action"] == "reject") {
                    $tabledata .= '
                        <td class="red">Rejected<br/>' . $gettable["remark"] . '</td>
=
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
        FROM topupwallethistory 
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
                <td>' . date("d-m-Y", strtotime($gettable["paid_date"])) . '</td>
                <th scope="row">' . $gettable["deposite_type"] . '</th>
            ';


            if ($gettable["deposite_type"] == "Crypto") {

                $tabledata .= '
                <td> $ ' . $gettable["crypto_value"] . '</td>
                <td>' . $gettable["txnhash_id"] . '</td>                    
            ';
            } else if ($gettable["deposite_type"] == "Bank") {

                $tabledata .= '
                <td>Rs. ' . $gettable["bank_value"] . '</td>
                <td>' . $gettable["transaction_id"] . '</td>
            ';
            }

            $tabledata .= '
                <th scope="row">' . $gettable["topupwallet_value"] . '</th>
            ';

            if ($gettable["action"] == "admin") {

                $tabledata .= '
            <td class="red">Pending <br/>' . $gettable["remark"] . '</td>
            </tr>';
            } else if ($gettable["action"] == "paid") {
                $tabledata .= '
                    <td class="green">Approved <br/>' . $gettable["remark"] . '</td>
                   </tr>';
            } else if ($gettable["action"] == "reject") {
                $tabledata .= '
                    <td class="red">Rejected<br/>' . $gettable["remark"] . '</td>
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
