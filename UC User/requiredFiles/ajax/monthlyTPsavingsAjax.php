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

            $checckpay = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='admin'");

            if (mysqli_num_rows($checckpay) >= 1) {

                $response["invoiceid"] = "Waiting for Admin Approve for Previous Pay";
                $getuccsql = "SELECT * FROM uccvalue";
                $getuccres = $con->query($getuccsql);

                $getuccrow = $getuccres->fetch_assoc();

                $response["uccvalue"] = $getuccrow["value"];
                $response["status"] = "success";
                echo json_encode($response);

            } else {

                $getinvoicesql = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='pending'";
                $getinvoiceres = $con->query($getinvoicesql);

                if (mysqli_num_rows($getinvoiceres) >= 1) {

                    $getinvoicerow = $getinvoiceres->fetch_assoc();

                    $getuccsql = "SELECT * FROM uccvalue";
                    $getuccres = $con->query($getuccsql);
                    
                    $getuccrow = $getuccres->fetch_assoc();
                    
                    $response["uccvalue"] = $getuccrow["value"];
                    $response["status"] = "success";


                    $checkrow = $con->query("SELECT MAX(paid_date) as created_at FROM monthlytpsavinghistory WHERE user_id='{$values["userid"]}' AND action='paid'");

                    if (mysqli_num_rows($checkrow) >= 1) {
                        $getcheckrow = $checkrow->fetch_assoc();

                        $datetimeString = $getcheckrow["created_at"];
                        $dateOnly = date("Y-m-d", strtotime($datetimeString));

                        $date = new DateTime($dateOnly);
                        $today = new DateTime();
                        $interval = $date->diff($today);

                        if ($interval->days > 30) {
                            $response["invoiceid"] = $getinvoicerow["invoice_id"];
                            $response["invoicedate"] = date("Y-m-d", strtotime($getinvoicerow["created_at"]));
                        } else {
                            $response["invoiceid"] = "nextmonth";
                        }
                    } else {
                        $response["invoiceid"] = $getinvoicerow["invoice_id"];
                        $response["invoicedate"] = date("Y-m-d", strtotime($getinvoicerow["created_at"]));
                    }
                    
                    echo json_encode($response);
                    
                } else {


                    $response["invoiceid"] = "nullID";
                    $getuccsql = "SELECT * FROM uccvalue";
                    $getuccres = $con->query($getuccsql);

                    $getuccrow = $getuccres->fetch_assoc();

                    $response["uccvalue"] = $getuccrow["value"];
                    $response["status"] = "success";
                    echo json_encode($response);

                }

            }



        }

    } else if ($way == "submithashid") {

        $uccvalue = $_POST["uccvalue"];
        $txnhashid = $_POST["txnhashid"];
        $invoiceidval = $_POST["invoiceidval"];

        $updatestatussql = "UPDATE monthlysavingpendinginvoice SET action = 'admin' WHERE invoice_id='{$invoiceidval}' ";
        $updatestatusres = $con->query($updatestatussql);

        $getselectsql = "SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}'";
        $getselectres = $con->query($getselectsql);

        $getselectrow = $getselectres->fetch_assoc();

        $insertinvoicehistorysql = "INSERT INTO monthlytpsavinghistory (user_id, invoice_id,invoice_date, txn_hashid, payment_type, amount, tp_value, bonus_tp, credit_tp, balance_tp, action)
        VALUES ('{$values["userid"]}', '{$getselectrow["invoice_id"]}', '{$getselectrow["created_at"]}', '{$txnhashid}', 'To Crypto', '{$uccvalue}', '50', '5', '55', '', 'admin')";
        $insertinvoicehistoryres = $con->query($insertinvoicehistorysql);

        if ($insertinvoicehistoryres) {

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