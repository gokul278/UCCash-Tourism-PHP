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

        $tabledata = "";
            $index = 0;

            $history = $con->query("SELECT * FROM withdrawhistory WHERE action != 'admin'");

            foreach($history as $gethistory){
                $dateString = $gethistory["paid_date"];

                $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$gethistory["user_id"]}'");
                $getname = $name->fetch_assoc();

                $parts = explode(" ", $dateString);

                $date = $parts[0];
                $time = $parts[1];
                $index++;
                $tabledata .= "
                <tr>
                    <th>".$index."</th>
                    <th>".$date.'<p class="time">'.$time."</p></th>
                    <th>".$gethistory["user_id"]."</th>
                    <th>".$getname["user_name"]."</th>
                    <th>".$gethistory["payment_method"]."</th>
                    <th>".$gethistory["withdraw_amount"]."$</th>
                    <th>".$gethistory["admin_fees"]."$</th>
                    <th>".$gethistory["retopup_fees"]."$</th>
                    <th>".$gethistory["net_amount"]."$</th>
                    <th>".$gethistory["to_withdraw"]."</th>
                ";

                if($gethistory["action"] == "reject"){
                    $tabledata .= "
                        <th>-</th>
                        <th style='color:red;'>Rejected<br>Reason: ".$gethistory["remark"]."</th>
                    </tr>
                    ";
                }else if($gethistory["action"] == "paid"){
                    $tabledata .= "
                        <th>".$gethistory["txn_id"]."</th>
                        <th style='color:green;'>".$gethistory["remark"]."</th>
                    </tr>
                    ";
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