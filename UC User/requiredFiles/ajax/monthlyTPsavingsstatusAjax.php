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

            $tabledata="";

            $getTable = "SELECT * FROM monthlytpsavinghistory WHERE user_id='{$values["userid"]}'";
            $getTableres = $con->query($getTable);

            if (mysqli_num_rows($getTableres) >= 1) {

                $index = 0;

                foreach ($getTableres as $getTablerow) {
                    $index++;
                    $tabledata .= '<tr>';
    
                    $tabledata .= '<th scope="row">' . $index . '</th>';
                    $tabledata .= '<th scope="row">' . $getTablerow['invoice_id'] . '</th>';
                    $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['invoice_date'])) . '</td>';
                    $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['paid_date'])) . '</td>';
                    $tabledata .= '<td>' . $getTablerow['payment_type'] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["amount"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["tp_value"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["bonus_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["credit_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["debite_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["balance_tp"] . '</td>';
    
                    if ($getTablerow["action"] == "admin") {
                        $tabledata .= '<td style="color:red">Waiting for Approval</td>';
                    } else if ($getTablerow["action"] == "paid") {
                        $tabledata .= '<td><button type="button" class="btn btn-warning"><b>View</b></button></td>';
                    }
    
                    $tabledata .= '</tr>';
                }

            }else {

                $tabledata .= '<tr>';
                $tabledata .= '<td colspan=11">No Data Found</td>';
                $tabledata .= '</tr>';

            }

           

            $response["table_data"] = $tabledata;
            $response["status"] = "success";
            echo json_encode($response);

        }

    }else if($way = "filterDate"){

        $fromDate = $_POST["fromDate"];
        $toDate = $_POST["toDate"];

        $filtersql = "SELECT * FROM monthlytpsavinghistory 
        WHERE user_id='{$values["userid"]}'
        AND invoice_date BETWEEN '{$fromDate}' AND '{$toDate}';";
        $filterres = $con->query($filtersql);

        if (mysqli_num_rows($filterres) >= 1) {

            $index = 0;
            $tabledata = "";

            foreach ($filterres as $getTablerow) {
                $index++;
                $tabledata .= '<tr>';
    
                    $tabledata .= '<th scope="row">' . $index . '</th>';
                    $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['invoice_date'])) . '</td>';
                    $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['paid_date'])) . '</td>';
                    $tabledata .= '<td>' . $getTablerow['payment_type'] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["amount"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["tp_value"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["bonus_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["credit_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["debite_tp"] . '</td>';
                    $tabledata .= '<td>' . $getTablerow["balance_tp"] . '</td>';
    
                    if ($getTablerow["action"] == "pending") {
                        $tabledata .= '<td style="color:red">Pending</td>';
                    } else if ($getTablerow["action"] == "paid") {
                        $tabledata .= '<td><button type="button" class="btn btn-warning"><b>View</b></button></td>';
                    }
    
                    $tabledata .= '</tr>';
            }

            $response["filter_data"] = $tabledata;
            $response["status"] = "success";
            echo json_encode($response);

        }else{

            $tabledata = "";
            $tabledata .= '<tr>';
            $tabledata .= '<td colspan="11">No Data Found</td>';
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

?>