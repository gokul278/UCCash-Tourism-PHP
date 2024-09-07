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


            $getTable = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' ORDER BY id DESC LIMIT 3";
            $getTableres = $con->query($getTable);

            if ($getTableres->num_rows >= 1) {
                $tabledata = "";

                $index = 0;

                foreach ($getTableres as $row) {

                    $index++;
                    $date = $row["created_at"];
                    $dateTime = new DateTime($date);
                    $formattedDate = $dateTime->format('Y-m-d');

                    $tabledata .= '<tr><td>' . $index . '</td>';
                    $tabledata .= '<td>' . $row["invoice_id"] . '</td>';
                    $tabledata .= '<td>' . $row["user_id"] . '</td>';
                    $tabledata .= '<td>' . $formattedDate . '</td>';
                    $tabledata .= '<td>' . $row["saving_value"] . '</td>';
                    $tabledata .= '<td>' . $row["bonustp_value"] . '</td>';
                    $tabledata .= '<td>' . $row["totaltp_value"] . '</td>';

                    if ($row["action"] == "pending") {
                        if (strlen($row["remark"]) > 0) {
                            $tabledata .= '<td><a href="monthly TP savings.php?invoice_id='.$row["invoice_id"].'"><button type="button" class="btn btn-success">Pay</button></a><br/><span style="color:red">' . $row["remark"] . '</span></td></tr>';
                        } else {
                            $tabledata .= '<td><a href="monthly TP savings.php?invoice_id='.$row["invoice_id"].'"><button type="button" class="btn btn-success">Pay</button></a></td></tr>';
                        }
                    } else if ($row["action"] == "admin") {
                        $tabledata .= '<td style="color:red">Waiting for Admin Approve</td></tr>';
                    } else if ($row["action"] == "paid") {
                        $tabledata .= '<td style="color:green">Paided</td></tr>';
                    }
                }


                $response["table_data"] = $tabledata;
                $response["status"] = "success";
                echo json_encode($response);
            } else {

                $tabledata = "";
                $tabledata .= '<tr>';
                $tabledata .= '<td colspan="7">No Data Found</td>';
                $tabledata .= '</tr>';

                $response["table_data"] = $tabledata;
                $response["status"] = "success";
                echo json_encode($response);
            }
        }
    } else if ($way = "filterdate") {

        $getpaysql = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='pending'";
        $getpayres = $con->query($getpaysql);

        $getpayrow = $getpayres->fetch_assoc();

        $payid = $getpayrow["id"];

        $fromDate = $_POST["fromDate"];
        $toDate = $_POST["toDate"];

        $filtersql = "SELECT * FROM monthlysavingpendinginvoice 
        WHERE user_id='{$values["userid"]}' 
        AND action='pending' 
        AND created_at BETWEEN '{$fromDate}' AND '{$toDate}';";
        $filterres = $con->query($filtersql);

        if (mysqli_num_rows($filterres) >= 1) {

            $index = 0;
            $tabledata = "";

            foreach ($filterres as $getTablerow) {
                $index++;
                $tabledata .= '<tr>';

                $tabledata .= '<th scope="row">' . $index . '</th>';
                $tabledata .= '<td>' . $getTablerow["invoice_id"] . '</td>';
                $tabledata .= '<td>' . $getTablerow["user_id"] . '</td>';
                $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['created_at'])) . '</td>';
                $tabledata .= '<td>' . $getTablerow["saving_value"] . '</td>';
                $tabledata .= '<td>' . $getTablerow["bonustp_value"] . '</td>';
                $tabledata .= '<td>' . $getTablerow["totaltp_value"] . '</td>';

                if ($getTablerow["id"] == $payid) {
                    $tabledata .= '<td><a href="monthly TP savings.php"><button type="button" class="btn btn-success">Pay</button></a></td>';
                } else {
                    $tabledata .= '<td><a><button type="button" class="btn btn-success" disabled>Pay</button></a></td>';
                }

                $tabledata .= '</tr>';
            }

            $response["filter_data"] = $tabledata;
            $response["status"] = "success";
            echo json_encode($response);
        } else {

            $tabledata = "";
            $tabledata .= '<tr>';
            $tabledata .= '<td colspan="7">No Data Found</td>';
            $tabledata .= '</tr>';

            $response["filter_data"] = $tabledata;
            $response["status"] = "success";
            echo json_encode($response);
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
