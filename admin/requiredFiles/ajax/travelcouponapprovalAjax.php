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
                    <button type="button" class="btn btn-success" onclick="approveactivation(' . $index . ')" id="approvebtn'.$index.'"><b>Approve</b></button>
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
        for($i = 1; $i <=9; $i++){

            $value = $tcvalue * 0.0166; // 1.66 % * tcvalue

            $lvl = ${"lvl" . $i};

            if(strlen($lvl)>=5){
                $btpoint = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_bonusfrom,bt_lvl,bt_action,bt_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Bonus Travel Points')");
            }

        }

        //Networking Income Wallet
        for($i = 1; $i <=9; $i++){

            $value=0;

            if($i == 1){ //lvl 1
                $value = $tcvalue * 0.1; // 10% * tcvalue
            }else if($i == 2){ //lvl 2
                $value = $tcvalue * 0.05; // 5% * tcvalue
            }else if($i == 3){ //lvl 3
                $value = $tcvalue * 0.03; // 3% * tcvalue
            }else if ($i == 4){ //lvl4
                $value = $tcvalue * 0.02; // 2% * tcvalue
            }else if($i >= 5 && $i<=9){
                $value = $tcvalue * 0.01; // 1% * tcvalue
            }            

            $lvl = ${"lvl" . $i};

            if(strlen($lvl)>=5){
                $btpoint = $con->query("INSERT INTO networkingincomewallet (user_id,niw_points,niw_bonusfrom,niw_lvl,niw_action,niw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Networking Income')");
            }

        }

        //Leadership Income Wallet
        for($i = 1; $i <=9; $i++){

            $value = $tcvalue * 0.0044; // 0.44 % * tcvalue

            $lvl = ${"lvl" . $i};

            if(strlen($lvl)>=5){
                $btpoint = $con->query("INSERT INTO leadershipincomewallet (user_id,liw_points,liw_bonusfrom,liw_lvl,liw_action,liw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Leadership Income')");
            }

        }

        //Car&House Fund Wallet
        for($i = 1; $i <=9; $i++){

            $value = $tcvalue * 0.0055; // 0.55 % * tcvalue

            $lvl = ${"lvl" . $i};

            if(strlen($lvl)>=5){
                $btpoint = $con->query("INSERT INTO carandhousefundwallet (user_id,chfw_points,chfw_bonusfrom,chfw_lvl,chfw_action,chfw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Car & House Fund')");
            }

        }

        //Royalty Income Wallet
        for($i = 1; $i <=9; $i++){

            $value = $tcvalue * 0.0066; // 0.66 % * tcvalue

            $lvl = ${"lvl" . $i};

            if(strlen($lvl)>=5){
                $btpoint = $con->query("INSERT INTO royaltyincomewallet (user_id,riw_points,riw_bonusfrom,riw_lvl,riw_action,riw_remark)
                VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Royalty Income')");
            }

        }

        $approveactivation = $con->query("DELETE FROM idactivation WHERE idactivation_id='{$activationid}'");

        $approvehistory = $con->query("UPDATE idactivationhistory SET action='paid', remark='Activation Successful' WHERE idactivation_id='{$activationid}'");

        $approveuserdeatils = $con->query("UPDATE userdetails SET user_referalStatus='activated' WHERE user_id='{$userid}'");

        
        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>