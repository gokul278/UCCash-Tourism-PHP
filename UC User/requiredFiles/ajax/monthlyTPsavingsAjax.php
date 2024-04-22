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

            $getinvoicesql = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' AND action='pending'";
            $getinvoiceres = $con->query($getinvoicesql);

            if (mysqli_num_rows($getinvoiceres) >= 1) {

                $getinvoicerow = $getinvoiceres->fetch_assoc();

                $response["invoiceid"] = $getinvoicerow["id"];
                $response["invoicedate"] = date("Y-m-d", strtotime($getinvoicerow["created_at"]));

                $getuccsql = "SELECT * FROM uccvalue";
                $getuccres = $con->query($getuccsql);

                $getuccrow = $getuccres->fetch_assoc();

                $response["uccvalue"] = $getuccrow["value"];
                $response["status"] = "success";
                echo json_encode($response);

            }else{


                $response["invoiceid"] = "nullID";
                $getuccsql = "SELECT * FROM uccvalue";
                $getuccres = $con->query($getuccsql);

                $getuccrow = $getuccres->fetch_assoc();

                $response["uccvalue"] = $getuccrow["value"];
                $response["status"] = "success";
                echo json_encode($response);

            }

        }

    } else if ($way == "submithashid") {

        $uccvalue = $_POST["uccvalue"];
        $txnhashid = $_POST["txnhashid"];
        $invoiceidval = $_POST["invoiceidval"];

        $updatestatussql = "UPDATE monthlysavingpendinginvoice SET action = 'paid' WHERE id='{$invoiceidval}' ";
        $updatestatusres = $con->query($updatestatussql);

        $getselectsql = "SELECT * FROM monthlysavingpendinginvoice WHERE id='{$invoiceidval}'";
        $getselectres = $con->query($getselectsql);

        $getselectrow = $getselectres->fetch_assoc();

        $checkbalancesql = "SELECT * FROM monthlytpsavinghistory WHERE user_id = '{$values["userid"]}'";
        $checkbalanceres = $con->query($checkbalancesql);

        $credit_tp = 0;
        $debit_tp = 0;

        foreach ($checkbalanceres as $checkbalancerow) {
            $credit_tp += isset($checkbalancerow["credit_tp"]) ? (int)$checkbalancerow["credit_tp"] : 0;
            $debit_tp += isset($checkbalancerow["debit_tp"]) ? (int)$checkbalancerow["debit_tp"] : 0;
        }        
        
        $balance = $credit_tp - $debit_tp;
        $balance += 55;

        $insertinvoicehistorysql = "INSERT INTO monthlytpsavinghistory (user_id, invoice_date, txn_hashid, payment_type, amount, tp_value, bonus_tp, credit_tp, balance_tp, action)
        VALUES ('{$values["userid"]}', '{$getselectrow["created_at"]}', '{$txnhashid}', 'To Crypto', '{$uccvalue}', '50', '5', '55', '{$balance}', 'pending')";
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