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
            $index = 0;

            $history = $con->query("SELECT * FROM withdrawhistory WHERE user_id='{$values["userid"]}'");

            foreach($history as $gethistory){
                $dateString = $gethistory["paid_date"];

                $parts = explode(" ", $dateString);

                $date = $parts[0];
                $time = $parts[1];
                $index++;
                $tabledata .= "
                <tr>
                    <th>".$index."</th>
                    <th>".$date.'<p class="time">'.$time."</p></th>
                    <th>".$gethistory["payment_method"]."</th>
                    
                ";


                if($gethistory["payment_method"] == "UCC"){
                    $tabledata .="
                    <th>".$gethistory["withdraw_amount"]."$</th>
                    <th>-</th>
                    <th>-</th>
                    <th>".$gethistory["net_amount"]."$</th>
                    <th>".$gethistory["to_withdraw"]."</th>
                    ";
                }else{
                    $tabledata .= "
                    <th>".$gethistory["withdraw_amount"]."$</th>
                    <th>".$gethistory["admin_fees"]."$</th>
                    <th>".$gethistory["retopup_fees"]."$</th>
                    <th>".$gethistory["net_amount"]."$</th>
                    <th>".$gethistory["to_withdraw"]."</th>
                    ";
                }

                if($gethistory["action"] == "admin"){
                    $tabledata .= "
                        <th style='color:#F7C128;%'>Waiting for Payment</th>
                        <th style='color:#F7C128;'>Pening</th>
                    </tr>
                    ";
                }else if($gethistory["action"] == "reject"){
                    $tabledata .= "
                        <th></th>
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

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>