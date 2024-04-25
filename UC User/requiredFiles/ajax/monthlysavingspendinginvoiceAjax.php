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

            $getTable = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='pending'";
            $getTableres = $con->query($getTable);

            if (mysqli_num_rows($getTableres) >= 1) {

                $index = 0;

                $checkpay = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='admin'");

                if(mysqli_num_rows($checkpay) >= 1){
                    foreach ($getTableres as $getTablerow) {
                        $index++;
                        $tabledata .= '<tr>';
        
                        $tabledata .= '<th scope="row">' . $index . '</th>';
                        $tabledata .= '<td>' . $getTablerow["id"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["user_id"] . '</td>';
                        $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['created_at'])) . '</td>';
                        $tabledata .= '<td>' . $getTablerow["saving_value"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["bonustp_value"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["totaltp_value"] . '</td>';
                        $tabledata .= '<td><a><button type="button" class="btn btn-success" disabled>Pay</button></a></td>';

                        $tabledata .= '</tr>';
                    }
                }else{
                    foreach ($getTableres as $getTablerow) {
                        $index++;
                        $tabledata .= '<tr>';
        
                        $tabledata .= '<th scope="row">' . $index . '</th>';
                        $tabledata .= '<td>' . $getTablerow["id"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["user_id"] . '</td>';
                        $tabledata .= '<td>' . date('Y-m-d', strtotime($getTablerow['created_at'])) . '</td>';
                        $tabledata .= '<td>' . $getTablerow["saving_value"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["bonustp_value"] . '</td>';
                        $tabledata .= '<td>' . $getTablerow["totaltp_value"] . '</td>';
        
                        if ($index == 1) {

                            if(isset($getTablerow["remark"])){
                                $tabledata .= '<td><a href="monthly TP savings.php"><button type="button" class="btn btn-success">Pay</button></a><br><p style="color:red">'.$getTablerow["remark"].'</p></td>';
                            }else{
                                $tabledata .= '<td><a href="monthly TP savings.php"><button type="button" class="btn btn-success">Pay</button></a></td>';
                            }

                        } else {
                            $tabledata .= '<td><a><button type="button" class="btn btn-success" disabled>Pay</button></a></td>';
                        }
        
                        $tabledata .= '</tr>';
                    }
                }

                
    
                $response["table_data"] = $tabledata;
                $response["status"] = "success";
                echo json_encode($response);
                
            }else{
                
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
                $tabledata .= '<td>' . $getTablerow["id"] . '</td>';
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

        }else{

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

?>