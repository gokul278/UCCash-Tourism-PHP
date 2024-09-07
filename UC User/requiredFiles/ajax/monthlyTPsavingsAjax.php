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

        $invoice_id = $_POST["invoice_id"];

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) > 0) {

            $datarow = $datares->fetch_assoc();

            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];


            $checkinvoice_id = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoice_id}' AND user_id='{$values["userid"]}'");

            if (mysqli_num_rows($checkinvoice_id) == 1) {

                $getinvoicedata = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' ORDER BY id DESC LIMIT 3");

                foreach ($getinvoicedata as $row) {
                    if ($row["invoice_id"] == $invoice_id) {

                        if ($row["action"] == "pending") {
                            $date = $row["created_at"];
                            $dateTime = new DateTime($date);
                            $formattedDate = $dateTime->format('Y-m-d');

                            $getuccvalue = $con->query("SELECT * FROM uccvalue WHERE id=1");
                            $resgetuccvalue = $getuccvalue->fetch_assoc();

                            $response["invoice_id"] = $invoice_id;
                            $response["created_at"] = $formattedDate;
                            $response["deposite_value"] = round(($row["totaltp_value"] - $row["bonustp_value"]) / $resgetuccvalue["value"],2);
                            $response["status"] = "success";
                        } else if ($row["action"] == "admin") {
                            $response["status"] = "error";
                            $response["message"] = "Waiting For Approval";
                        } else if ($row["action"] == "paid") {
                            $response["status"] = "error";
                            $response["message"] = "You Already Paid the Invoice";
                        }

                        break;
                    } else {
                        $response["status"] = "error";
                        $response["message"] = "Expired Invoice ID";
                    }
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "Invalid Invoice ID";
            }


            echo json_encode($response);
        }
    } else if ($way == "submithashid") {

        $uccvalue = $_POST["uccvalue"];
        $txnhashid = $_POST["txnhashid"];
        $invoiceidval = $_POST["invoiceidval"];

        $checkinvoice_id = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}' AND user_id='{$values["userid"]}'");

        if (mysqli_num_rows($checkinvoice_id) == 1) {

            $updatestatussql = "UPDATE monthlysavingpendinginvoice SET action = 'admin' WHERE invoice_id='{$invoiceidval}' ";
            $updatestatusres = $con->query($updatestatussql);

            $getselectsql = "SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}'";
            $getselectres = $con->query($getselectsql);

            $getselectrow = $getselectres->fetch_assoc();

            $insertinvoicehistorysql = "INSERT INTO monthlytpsavinghistory (user_id, invoice_id,invoice_date, txn_hashid, payment_type, amount, tp_value, bonus_tp, credit_tp, balance_tp, action)
        VALUES ('{$values["userid"]}', '{$getselectrow["invoice_id"]}', '{$getselectrow["created_at"]}', '{$txnhashid}', 'To Crypto', '{$uccvalue}', '{$getselectrow["saving_value"]}', '{$getselectrow["bonustp_value"]}', '{$getselectrow["totaltp_value"]}', '', 'admin')";
            $insertinvoicehistoryres = $con->query($insertinvoicehistorysql);

            if ($insertinvoicehistoryres) {

                $response["status"] = "success";
                echo json_encode($response);
            } else {

                $response["status"] = $con->error;
                echo json_encode($response);
            }
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
