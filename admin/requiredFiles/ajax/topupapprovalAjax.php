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

        $admintable = $con->query("SELECT * FROM topupwallethistory WHERE action='admin'");

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
                <td>' . $getdata["deposite_type"] . '</td>';


            if ($getdata["deposite_type"] == "Bank") {
                $tabledata .= "
                    <th>Rs. " . $getdata["bank_value"] . "</th>
                    <th>" . $getdata["transaction_id"] . "</th>
                    ";
            } else {
                $tabledata .= "
                    <th>$ " . $getdata["crypto_value"] . "</th>
                    <th>" . $getdata["txnhash_id"] . "</th>
                    ";
            }

            $tabledata .= '
                <td>' . $getdata["topupwallet_value"] . '</td>';
            // <td>' . $getdata["withdraw_amount"] . '$</td>
            // <td>' . $getdata["admin_fees"] . '$</td>
            $tabledata .= '<td>
                    <button type="button" class="btn btn-success"  onclick="approvewithdraw(' . $getdata["id"] . ')" id="approvebtn' . $index . '">
                        <b>Approve</b>
                    </button>
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

        $updatewithdraw = $con->query("UPDATE topupwallethistory SET remark='{$rejectreason}',
        action='reject' WHERE id='{$withdrawid}'");

        if ($updatewithdraw) {
            $response["status"] = "success";
            echo json_encode($response);
        }
    } else if ($way == "approvewithdraw") {

        $approvalId = $_POST["approvalId"];

        $updatewithdraw = $con->query("UPDATE topupwallethistory SET remark='Successfully Deposited',
        action='paid' WHERE id='{$approvalId}'");

        $topupdata = $con->query("SELECT * FROM topupwallethistory WHERE id={$approvalId}");
        $gettopupdata = $topupdata->fetch_assoc();
        $AddMoneyWallet = $con->query("INSERT INTO topup_wallet(user_id,tu_points,tu_action,tu_bonusfrom,tu_remark) VALUES ('{$gettopupdata["user_id"]}','{$gettopupdata["topupwallet_value"]}','credit','{$gettopupdata["deposite_type"]}','Successfully Deposited')");

        if ($updatewithdraw && $AddMoneyWallet) {
            $response["status"] = "success";
        } else {
            $response["status"] = "failed";
        }

        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
