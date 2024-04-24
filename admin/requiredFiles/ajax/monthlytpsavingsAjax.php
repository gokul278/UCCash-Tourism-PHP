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

        $gettable = $con->query("SELECT msh.*, ud.user_name
        FROM monthlytpsavinghistory AS msh
        JOIN userdetails AS ud ON msh.user_id = ud.user_id
        WHERE msh.action = 'admin'");

        $table = "";

        foreach ($gettable as $key => $rowtable) {
            $table .= '
            <tr>
                <td scope="row">' . $key+1 . '</td>
                <td>' . $rowtable["invoice_id"] . '</td>
                <td>' . $rowtable["paid_date"] . '</td>
                <td>' . $rowtable["invoice_date"] . '</td>
                <td>' . $rowtable["user_id"] . '</td>
                <td>' . $rowtable["user_name"] . '</td>
                <td>' . $rowtable["payment_type"] . '</td>
                <td>' . $rowtable["amount"] . '</td>
                <td>' . $rowtable["txn_hashid"] . '</td>
                <td>
                    <button type="button" class="btn btn-success" onclick="approveinvoice(this)" value="' . $rowtable["id"] . '" user_id="' . $rowtable["user_id"] . '"><b>Approve</b></button>
                </td>
                <td>
                <div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal'.$key.'">
                    <b>Reject</b>
                </button>
            </div>
            <div class="modal fade" id="exampleModal'.$key.'" tabdashboard="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">Reject Invoice ID : '. $rowtable["invoice_id"] .'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>
                                <form class="custom-form">

                                    <div class="form-group">
                                        <label for="imgdescribe">Reason</label>
                                        <br>
                                        <input type="text" class="form-control" id="bookingCode"
                                            placeholder="Enter Reason">
                                    </div>
                                </form>
                            </strong>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal"><strong>Close</strong></button>
                            <button type="button" class="btn btn-primary"><strong
                                    style="color: #000;">Submit</strong></button>
                        </div>
                    </div>
                </div>
            </div>
                </td>
            </tr>
            
            ';
        }

        $response["tabledata"] = $table;
        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>