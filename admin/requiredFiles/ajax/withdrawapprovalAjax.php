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
                <td>' . $getdata["payment_method"] . '</td>
                <td>' . $getdata["withdraw_amount"] . '$</td>
                <td>' . $getdata["admin_fees"] . '$</td>
                <td>' . $getdata["retopup_fees"] . '$</td>
                <td>' . $getdata["net_amount"] . '$</td>
                <td>' . $getdata["to_withdraw"] . '</td>
                <td>
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

            if ($withdrawpoints) {

                $reactivation = $con->query("INSERT INTO reactivationwallet (user_id,raw_points,raw_action,raw_remark)
                VALUES ('{$getwithdrawpoints["user_id"]}','{$getwithdrawpoints["retopup_fees"]}','credit','Withdrawal Fees')");

                if ($reactivation) {

                    $admin = $con->query("INSERT INTO admin_wallet (aw_points,aw_action,aw_remark)
                    VALUES ('{$getwithdrawpoints["admin_fees"]}','credit','From {$getwithdrawpoints["user_id"]}')");

                    if ($admin) {

                        $debitbalance = $con->query("INSERT INTO availablewithdrwabalance (user_id,awb_from,awb_to,awb_points,awb_action)
                        VALUES ('{$getwithdrawpoints["user_id"]}','Available Withdraw Balance','Withdrawed Amount','{$getwithdrawpoints["withdraw_amount"]}','debit')");

                        if ($debitbalance) {

                            $response["status"] = "success";

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

                $response["status"] = "error2";

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