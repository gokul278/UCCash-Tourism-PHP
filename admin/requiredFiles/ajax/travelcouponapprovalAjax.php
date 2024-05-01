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

        $historydata = $con->query("SELECT iah.*, ud.user_name
        FROM idactivationhistory AS iah
        JOIN userdetails AS ud ON iah.user_id = ud.user_id
        WHERE iah.action = 'admin'");

        $tabledata = "";
        $index = 0;

        foreach ($historydata as $index => $rowhistorydata) {
            $index++;
            $tabledata .= '
            <tr align="center">
                <th scope="row">' . $index . '</th>
                <td>' . $rowhistorydata["idactivation_id"] . '</td>
                <td>' . $rowhistorydata["paid_date"] . '</td>
                <td>' . $rowhistorydata["user_id"] . '</td>
                <td>' . $rowhistorydata["user_name"] . '</td>
                <td>' . $rowhistorydata["deposite_type"] . '</td>
            ';


            if ($rowhistorydata["deposite_type"] == "Crypto") {

                $tabledata .= '
                    <td>' . $rowhistorydata["crypto_value"] . '</td>
                    <td>' . $rowhistorydata["txnhash_id"] . '</td>                    
                ';

            } else if ($rowhistorydata["deposite_type"] == "Bank") {

                $tabledata .= '
                    <td>' . $rowhistorydata["bank_value"] . '</td> 
                    <td>' . $rowhistorydata["transaction_id"] . '<br><button class="btn btn-success view-proof-image" data-src=".././UC User/img/proofImage/' . $rowhistorydata["proof_image"] . '"><i class="bi bi-eye-fill"></i></button></td>
                ';

            }

            $tabledata .= '
                <td>
                    <button type="button" class="btn btn-success" onclick="approveactivation(' . $index . ')"><b>Approve</b></button>
                </td>
                <td>
                <div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal' . $index . '">
                    <b>Reject</b>
                </button>
            </div>
            <div class="modal fade" id="exampleModal' . $index . '" tabdashboard="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">Reject Activation ID : ' . $rowhistorydata["idactivation_id"] . '</h5>
                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>
                                    <div class="form-group">
                                        <label for="imgdescribe">Reason</label>
                                        <br>
                                        <input type="hidden" id="userid' . $index . '" value="' . $rowhistorydata["user_id"] . '">
                                        <input type="hidden" id="activationid' . $index . '" value="' . $rowhistorydata["idactivation_id"] . '">
                                        <input type="text" class="form-control" id="reason' . $index . '"
                                            placeholder="Enter Reason">
                                    </div>
                            </strong>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal"><strong>Close</strong></button>
                            <button type="button" class="btn btn-primary"><strong
                            data-dismiss="modal" style="color: #000;" onclick="rejectinvoice(' . $index . ')">Submit</strong></button>
                        </div>
                    </div>
                </div>
            </div>
                </td>
            </tr>
            ';
        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "rejectactivation") {

        $userid = $_POST["userid"];
        $activationid = $_POST["activationid"];
        $reason = $_POST["reason"];

        $rejectactivation = $con->query("DELETE FROM idactivation WHERE idactivation_id='{$activationid}'");

        $rejecthistory = $con->query("UPDATE idactivationhistory SET action='reject', remark='{$reason}' WHERE idactivation_id='{$activationid}'");

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "approveactivation") {

        $userid = $_POST["userid"];
        $activationid = $_POST["activationid"];

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

        // foreach()
        

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>