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

        $admintable = $con->query("SELECT * FROM withdrawhistory WHERE action='admin'");

        $tabledata = "";

        $index = 0;

        foreach ($admintable as $getdata) {

            $name = $con->query("SELECT user_name FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $index++;
            $dateString = $getdata["paid_date"];

            $parts = explode(" ", $dateString);

            $date = $parts[0];
            $time = $parts[1];

            $tabledata .= '
            <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $date . '<br>' . $time . '</td>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getname["user_name"] . '</td>
                <td>' . $getdata["payment_method"] . '</td>';


                if($getdata["payment_method"] == "UCC"){
                    $tabledata .="
                    <th>".$getdata["withdraw_amount"]."$</th>
                    <th>-</th>
                    <th>-</th>
                    <th>".$getdata["net_amount"]."$</th>
                    <th>".$getdata["to_withdraw"]."</th>
                    ";
                }else{
                    $tabledata .= "
                    <th>".$getdata["withdraw_amount"]."$</th>
                    <th>".$getdata["admin_fees"]."$</th>
                    <th>".$getdata["retopup_fees"]."$</th>
                    <th>".$getdata["net_amount"]."$</th>
                    <th>".$getdata["to_withdraw"]."</th>
                    ";
                }
                // <td>' . $getdata["withdraw_amount"] . '$</td>
                // <td>' . $getdata["admin_fees"] . '$</td>
                // <td>' . $getdata["retopup_fees"] . '$</td>
                // <td>' . $getdata["net_amount"] . '$</td>
                // <td>' . $getdata["to_withdraw"] . '</td>
                $tabledata .= '<td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#accept' . $index . '">
                        <b>Approve</b>
                    </button>
                    <div class="modal fade" id="accept' . $index . '" tabdashboard="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">Enter TXN Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong><form class="custom-form">
                                        <div class="form-group">
                                            <label for="bookingCode">Transaction ID :</label>
                                            <br>
                                            <input type="text" class="form-control" id="txnid' . $index . '" placeholder="Enter Transaction ID">
                                        </div>
                                        
                                    </form></strong>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                                    <button type="button" class="btn btn-primary" onclick="approvewithdraw(' . $index . ')" id="approvebtn' . $index . '"><strong style="color: #000;">Approve</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject' . $index . '">
                        <b>Reject</b>
                    </button>
                    <div class="modal fade" id="reject' . $index . '" tabdashboard="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">Enter Reason</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong><form class="custom-form">
                                        <div class="form-group">
                                            <label for="bookingCode">Reason :</label>
                                            <br>
                                            <input type="hidden" id="id' . $index . '" value="' . $getdata["id"] . '" />
                                            <input type="text" class="form-control" id="reason' . $index . '" placeholder="Enter Reason">
                                        </div>
                                        
                                    </form></strong>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                                    <button type="button" class="btn btn-primary" onclick="rejectwithdraw(' . $index . ')" id="rejectbtn' . $index . '"><strong style="color: #000;">Reject</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>';
        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "rejectwithdraw") {
        $withdrawid = $_POST["withdrawid"];
        $rejectreason = $_POST["rejectreason"];

        $updatewithdraw = $con->query("UPDATE withdrawhistory SET txn_id='reject', remark='{$rejectreason}',
        action='reject' WHERE id='{$withdrawid}'");

        if ($updatewithdraw) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    } else if ($way == "approvewithdraw") {

        $withdrawid = $_POST["withdrawid"];
        $txnid = $_POST["txnid"];


        $updatewithdraw = $con->query("UPDATE withdrawhistory SET txn_id='{$txnid}', remark='Successfully Withdrawed',
        action='paid' WHERE id='{$withdrawid}'");


        if ($updatewithdraw) {

            $withdrawpoints = $con->query("SELECT * FROM withdrawhistory WHERE id='{$withdrawid}'");
            $getwithdrawpoints = $withdrawpoints->fetch_assoc();

            if ($getwithdrawpoints["payment_method"] == "UCC") {
                $walletvalue = $con->query("INSERT INTO uccwalletpoints (user_id,uccw_points,uccw_action,uccw_remark)
        VALUES ('{$getwithdrawpoints["user_id"]}','{$getwithdrawpoints["net_amount"]}','debit','Withdraw Successfully')");
            }

            if ($withdrawpoints && $getwithdrawpoints["payment_method"] != "UCC") {

                $reactivation = $con->query("INSERT INTO reactivationwallet (user_id,raw_points,raw_action,raw_remark)
                VALUES ('{$getwithdrawpoints["user_id"]}','{$getwithdrawpoints["retopup_fees"]}','credit','Withdrawal Fees')");

                if ($reactivation) {

                    $admin = $con->query("INSERT INTO admin_wallet (aw_points,aw_action,aw_remark)
                    VALUES ('{$getwithdrawpoints["admin_fees"]}','credit','From {$getwithdrawpoints["user_id"]}')");

                    if ($admin) {

                        $debitbalance = $con->query("INSERT INTO availablewithdrwabalance (user_id,awb_from,awb_to,awb_points,awb_action)
                        VALUES ('{$getwithdrawpoints["user_id"]}','Available Withdraw Balance','Withdrawed Amount','{$getwithdrawpoints["withdraw_amount"]}','debit')");

                        if ($debitbalance) {

                            //Check Reactivation

                            //ID Reactivation Wallet
                            $reactivationwallet = $con->query("SELECT * FROM reactivationwallet WHERE user_id='{$getwithdrawpoints["user_id"]}'");
                            $rawcredit = 0;
                            $rawdebit = 0;

                            if (mysqli_num_rows($reactivationwallet) >= 1) {

                                foreach ($reactivationwallet as $getreactivationwallet) {
                                    if (isset($getreactivationwallet["raw_action"]) && strlen($getreactivationwallet["raw_action"]) >= 1) {
                                        if ($getreactivationwallet["raw_action"] == "credit") {
                                            $rawcredit += (float) $getreactivationwallet["raw_points"];
                                        } else if ($getreactivationwallet["raw_action"] == "debit") {
                                            $rawdebit += (float) $getreactivationwallet["raw_points"];
                                        }
                                    }
                                }

                            }

                            $reactivationvalue = number_format(($rawcredit - $rawdebit), 2);

                            //Reactivation Wallet limit
                            $activationlimit = number_format(50, 2);

                            if ($reactivationvalue >= $activationlimit) {

                                $user_id = $getwithdrawpoints["user_id"];
                                $crypto_value = "50$";
                                $txnhashid = "From Reactivation Wallet";

                                $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory");

                                $idactivationid = "";

                                if (mysqli_num_rows($id) >= 1) {
                                    $getid = $id->fetch_assoc();
                                    $idval = (int) $getid["max_id"];
                                    $idactivationid = "IAI-" . ($idval + 1);
                                } else {
                                    $idactivationid = "IAI-1";
                                }




                                $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,txnhashid,action) VALUES
                                ('{$idactivationid}','{$user_id}','Wallet','{$txnhashid}','admin')");

                                $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,crypto_value,txnhash_id,travel_coupon,action,remark) VALUES
                                ('{$idactivationid}',  '{$user_id}', 'Wallet', '{$crypto_value}', '{$txnhashid}', '50','admin', 'Waiting for Approval')");



                                $userid = $getwithdrawpoints["user_id"];
                                $activationid = $idactivationid;

                                $lvl1 = "";
                                $lvl2 = "";
                                $lvl3 = "";
                                $lvl4 = "";
                                $lvl5 = "";
                                $lvl6 = "";
                                $lvl7 = "";
                                $lvl8 = "";
                                $lvl9 = "";

                                $genealogy = $con->query("SELECT * FROM genealogy WHERE user_id='{$userid}'");

                                foreach ($genealogy as $getgenealogy) {
                                    $lvl1 = isset($getgenealogy["lvl1"]) ? $getgenealogy["lvl1"] : "";
                                    $lvl2 = isset($getgenealogy["lvl2"]) ? $getgenealogy["lvl2"] : "";
                                    $lvl3 = isset($getgenealogy["lvl3"]) ? $getgenealogy["lvl3"] : "";
                                    $lvl4 = isset($getgenealogy["lvl4"]) ? $getgenealogy["lvl4"] : "";
                                    $lvl5 = isset($getgenealogy["lvl5"]) ? $getgenealogy["lvl5"] : "";
                                    $lvl6 = isset($getgenealogy["lvl6"]) ? $getgenealogy["lvl6"] : "";
                                    $lvl7 = isset($getgenealogy["lvl7"]) ? $getgenealogy["lvl7"] : "";
                                    $lvl8 = isset($getgenealogy["lvl8"]) ? $getgenealogy["lvl8"] : "";
                                    $lvl9 = isset($getgenealogy["lvl9"]) ? $getgenealogy["lvl9"] : "";
                                }

                                $idactivationhistory = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$userid}' AND action='admin'");
                                $getidactivationhistory = $idactivationhistory->fetch_assoc();
                                $tcvalue = (int) $getidactivationhistory["travel_coupon"];

                                //Travel Coupon Wallet
                                $travelcoupon = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
                                VALUES ('{$userid}','{$tcvalue}','credit','Travel Coupon')");

                                //Bonus Travel Point Wallet
                                for ($i = 1; $i <= 9; $i++) {

                                    $value = $tcvalue * 0.0166; // 1.66 % * tcvalue

                                    $lvl = ${"lvl" . $i};

                                    if (strlen($lvl) >= 5) {
                                        $btpoint = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_bonusfrom,bt_lvl,bt_action,bt_remark)
                                        VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Bonus Travel Points')");
                                    }

                                }

                                //Networking Income Wallet
                                for ($i = 1; $i <= 9; $i++) {

                                    $value = 0;

                                    if ($i == 1) { //lvl 1
                                        $value = $tcvalue * 0.1; // 10% * tcvalue
                                    } else if ($i == 2) { //lvl 2
                                        $value = $tcvalue * 0.05; // 5% * tcvalue
                                    } else if ($i == 3) { //lvl 3
                                        $value = $tcvalue * 0.03; // 3% * tcvalue
                                    } else if ($i == 4) { //lvl4
                                        $value = $tcvalue * 0.02; // 2% * tcvalue
                                    } else if ($i >= 5 && $i <= 9) {
                                        $value = $tcvalue * 0.01; // 1% * tcvalue
                                    }

                                    $lvl = ${"lvl" . $i};

                                    if (strlen($lvl) >= 5) {
                                        $btpoint = $con->query("INSERT INTO networkingincomewallet (user_id,niw_points,niw_bonusfrom,niw_lvl,niw_action,niw_remark)
                                        VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Networking Income')");
                                    }

                                }

                                //Leadership Income Wallet
                                for ($i = 1; $i <= 9; $i++) {

                                    $value = $tcvalue * 0.0044; // 0.44 % * tcvalue

                                    $lvl = ${"lvl" . $i};

                                    if (strlen($lvl) >= 5) {
                                        $btpoint = $con->query("INSERT INTO leadershipincomewallet (user_id,liw_points,liw_bonusfrom,liw_lvl,liw_action,liw_remark)
                                        VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Leadership Income')");
                                    }

                                }

                                //Car&House Fund Wallet
                                for ($i = 1; $i <= 9; $i++) {

                                    $value = $tcvalue * 0.0055; // 0.55 % * tcvalue

                                    $lvl = ${"lvl" . $i};

                                    if (strlen($lvl) >= 5) {
                                        $btpoint = $con->query("INSERT INTO carandhousefundwallet (user_id,chfw_points,chfw_bonusfrom,chfw_lvl,chfw_action,chfw_remark)
                                        VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Car & House Fund')");
                                    }

                                }

                                //Royalty Income Wallet
                                for ($i = 1; $i <= 9; $i++) {

                                    $value = $tcvalue * 0.0066; // 0.66 % * tcvalue

                                    $lvl = ${"lvl" . $i};

                                    if (strlen($lvl) >= 5) {
                                        $btpoint = $con->query("INSERT INTO royaltyincomewallet (user_id,riw_points,riw_bonusfrom,riw_lvl,riw_action,riw_remark)
                                        VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Royalty Income')");
                                    }

                                }

                                $approveactivation = $con->query("UPDATE idactivation SET action='paid', remark='' WHERE idactivation_id='{$activationid}'");

                                $approvehistory = $con->query("UPDATE idactivationhistory SET action='paid', remark='Reactivation Successful' WHERE idactivation_id='{$activationid}'");

                                $approveuserdeatils = $con->query("UPDATE userdetails SET user_referalStatus='activated' WHERE user_id='{$userid}'");

                                $debitreactivation = $con->query("INSERT INTO reactivationwallet (user_id,raw_points,raw_action,raw_remark)
                                VALUES ('{$userid}','{$activationlimit}','debit','Reactivation Fees')");

                                $response["status"] = "success";

                            } else {

                                $response["status"] = "success";

                            }

                        } else {

                            $response["status"] = "error5";

                        }

                    } else {

                        $response["status"] = "error4";

                    }


                } else {

                    $response["status"] = "error3";

                }


            } else {

                 $response["status"] = "success";

            }


        } else {

            $response["status"] = "error1";

        }

        echo json_encode($response);


    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>