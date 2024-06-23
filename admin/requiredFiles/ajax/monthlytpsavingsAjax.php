<?php

require "../../../requiredFiles/ajax/DBConnection.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

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

        $gettable = $con->query("SELECT msh.*, ud.user_name
        FROM monthlytpsavinghistory AS msh
        JOIN userdetails AS ud ON msh.user_id = ud.user_id
        WHERE msh.action = 'admin'");

        $table = "";

        foreach ($gettable as $key => $rowtable) {
            $table .= '
            <tr>
                <td scope="row">' . $key + 1 . '</td>
                <td>' . $rowtable["invoice_id"] . '</td>
                <td>' . $rowtable["paid_date"] . '</td>
                <td>' . $rowtable["invoice_date"] . '</td>
                <td>' . $rowtable["user_id"] . '</td>
                <td>' . $rowtable["user_name"] . '</td>
                <td>' . $rowtable["payment_type"] . '</td>
                <td>' . $rowtable["amount"] . '</td>
                <td>' . $rowtable["txn_hashid"] . '</td>
                <td>
                    <button type="button" class="btn btn-success" onclick="approveinvoice(this)" key="' . $key . '" id="approvebtn' . $key . '" value="' . $rowtable["id"] . '" user_id="' . $rowtable["user_id"] . '"  way="approveinvoice" invoiceid="' . $rowtable["invoice_id"] . '"><b>Approve</b></button>
                </td>
                <td>
                <div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal' . $key . '">
                    <b>Reject</b>
                </button>
            </div>
            <div class="modal fade" id="exampleModal' . $key . '" tabdashboard="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #000;" class="modal-title" id="exampleModalLabel">Reject Invoice ID : ' . $rowtable["invoice_id"] . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>
                                    <div class="form-group">
                                        <label for="imgdescribe">Reason</label>
                                        <br>
                                        <input type="hidden" id="userid' . $key . '" value="' . $rowtable["user_id"] . '">
                                        <input type="hidden" id="invoiceid' . $key . '" value="' . $rowtable["invoice_id"] . '">
                                        <input type="hidden" id="id' . $key . '" value="' . $rowtable["id"] . '">
                                        <input type="hidden" id="way' . $key . '" value="rejectinvoice">
                                        <input type="text" class="form-control" id="reason' . $key . '"
                                            placeholder="Enter Reason">
                                    </div>
                            </strong>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal"><strong>Close</strong></button>
                            <button type="button" class="btn btn-primary"><strong
                            data-dismiss="modal" style="color: #000;" onclick="rejectinvoice(' . $key . ')">Submit</strong></button>
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

    } else if ($way == "rejectinvoice") {
        $userid = $_POST["userid"];
        $invoiceid = $_POST["invoiceid"];
        $reason = $_POST["reason"];
        $id = $_POST["id"];


        $pendinginvoice = $con->query("UPDATE monthlysavingpendinginvoice SET action='pending', remark='{$reason}' WHERE invoice_id='{$invoiceid}' AND  user_id='{$userid}'");

        if ($pendinginvoice) {
            $paid = $con->query("SELECT *
            FROM monthlytpsavinghistory
            WHERE paid_date = (SELECT MAX(paid_date) FROM monthlytpsavinghistory WHERE user_id = '{$userid}')
              AND user_id = '{$userid}';
            ");

            $getpaid = $paid->fetch_assoc();

            $savinghistory = $con->query("UPDATE monthlytpsavinghistory SET action='reject', remark='{$reason}' WHERE user_id='{$userid}' AND  id='{$getpaid["id"]}'");
            if ($savinghistory) {
                $response["status"] = "success";
                echo json_encode($response);
            }
        }

    } else if ($way == "approveinvoice") {

        $userid = $_POST["userid"];
        $invoiceid = $_POST["invoiceid"];
        $id = $_POST["id"];

        $pendinginvoice = $con->query("UPDATE monthlysavingpendinginvoice SET action='paid', remark='' WHERE id='{$invoiceid}' AND  user_id='{$userid}'");

        if ($pendinginvoice) {

            $sponserid = $con->query("SELECT * FROM userdetails WHERE user_id='{$userid}'");
            $ressponser = $sponserid->fetch_assoc();

            $insertuserSTP = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_action,st_bonusfrom,st_remark) VALUES ('{$userid}','55','credit','{$userid}','Savings Travel Points')");
            // $insertsponserSTP = $con->query("INSERT INTO savingsincome (user_id,si_points,si_action,si_bonusfrom,si_remark) VALUES ('{$ressponser["user_sponserid"]}','5','credit','{$userid}','Savings Income')");

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


            $incoicevalue = 50;

            for ($i = 1; $i <= 9; $i++) {

                $value = 0;

                if ($i == 1) { //lvl 1
                    $value = $incoicevalue * 0.05; // 5% * incoicevalue
                } else if ($i >= 2 && $i <= 4) { //lvl 2 to 4
                    $value = $incoicevalue * 0.02; // 2% * incoicevalue
                } else if ($i >= 5 && $i <= 7) { //lvl 5 to 7
                    $value = $incoicevalue * 0.01; // 1% * incoicevalue
                } else if ($i >= 8 && $i <= 9) {//lvl 8 to 9
                    $value = $incoicevalue * 0.005; // 0.5% * incoicevalue
                }

                $lvl = ${"lvl" . $i};

                if (strlen($lvl) >= 5) {
                    $btpoint = $con->query("INSERT INTO savingsincome (user_id,si_points,si_bonusfrom,si_lvl,si_action,si_remark)
                    VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Savings Income')");
                }

            }



            $checkbalance = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$userid}'");

            $credit_tp = 0;
            $debit_tp = 0;

            foreach ($checkbalance as $element) {
                if ($element["st_action"] == "credit") {
                    $credit_tp += (int) $element["st_points"];
                } else if ($element["st_action"] == "debit") {
                    $debit_tp += (int) $element["st_points"];

                }
            }

            $balancestp = $credit_tp - $debit_tp;

            $savinghistory = $con->query("UPDATE monthlytpsavinghistory SET action='paid', balance_tp='{$balancestp}' WHERE id='{$id}' AND  user_id='{$userid}'");
            $savingchange = $con->query("UPDATE monthlysavingpendinginvoice SET action='paid', remark='' WHERE user_id='{$userid}' AND invoice_id='{$invoiceid}'");

            $history = $con->query("SELECT * FROM monthlytpsavinghistory WHERE id='{$id}' AND  user_id='{$userid}'");
            $reshistory = $history->fetch_assoc();

            if ($savinghistory) {

                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->SMTPDebug = SMTP::DEBUG_OFF;
                    $mail->CharSet = 'UTF-8';
                    $mail->Host = 'smtpout.secureserver.net';
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        ]
                    ];
                    $mail->SMTPAuth = true;
                    $mail->Username = 'info@uccashtourism.com';
                    $mail->Password = 'Tourism@#$2023';
                    $mail->setFrom('info@uccashtourism.com', 'UCCASH Tourism');
                    $mail->addAddress($ressponser["user_email"]);
                    $mail->isHTML(true);
                    $mail->Subject = 'Completed Savings Invoice Details';
                    $mail->Body = '<!DOCTYPE html>
                                            <html lang="en">
                                            
                                            <head>
                                                <meta charset="UTF-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                <title>Email Template</title>
                                            </head>
                                            
                                            <body>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="color:black">
                                                    <tr>
                                                        <td align="center" bgcolor="#ffffff">
                                                            <table width="600" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center" bgcolor="#000000">
                                                                        <div
                                                                            style="width: 100%; max-width: 600px; height: 100px; background-color:black; display: table;">
                                                                            <table width="100%" cellpad ding="0" cellspacing="0" border="0">
                                                                                <tr>
                                                                                    <td align="start" style="width: 60%; height: 100%;">
                                                                                        <img src="https://i.ibb.co/TwMTf3t/logo2.png" width="90%"
                                                                                            style="display: block; margin: 0 auto;" alt="Logo">
                                                                                    </td>
                                                                                    <td align="end" style="width: 40%; height: 100%;">
                                                                                        <p style="color: white; text-align: center;font-size:120%"><b>Let\'s go</b>
                                                                                        </p>
                                                                                        <p style="color: white; text-align: center;font-size:120%"><b>around the
                                                                                                world</b></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" bgcolor="#ffffff">
                                                            <div style="width: 100%; max-width: 600px; background-color:white; display: table;">
                                                                <div style="margin-top: 20px;margin-bottom: 20px;">
                                                                    <table>
                                                                        <tr align="center">
                                                                            <td style="width: 50%;height: 50px;background-color: #F7C128;border-radius: 50px;"
                                                                                align="center">
                                                                                <a href="" style="text-decoration: none;color: black;">
                                                                                    Monthly savings Invoice
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div align="start" style="margin-top: 30px;">
                                                                    <p>Hello, ' . $ressponser["user_name"] . ',</p>
                                                                </div>
                                                                <div align="start">
                                                                    <p>Your latest invoice for your UCCASH Tourism® membership monthly savings is now Paid.</p>
                                                                </div>
                                                                <div align="start">
                                                                    <p>Your 55 TP Points added successfully in your Saving TP wallet.</p>
                                                                </div>
                                                                <div align="start">
                                                                    <p><b>Invoice Details:</b><br>
                                                                        Invoice Number&nbsp;:&nbsp;' . $invoiceid . '<br>
                                                                        Invoice Month&nbsp;:&nbsp;' . explode(" ", $reshistory["invoice_date"])[0] . '<br>
                                                                        Status&nbsp;:&nbsp;Completed <br>
                                                                        Creation Date&nbsp;:&nbsp;' . explode(" ", $reshistory["paid_date"])[0] . ' <br>
                                                                        Due Date&nbsp;:&nbsp;' . explode(" ", $reshistory["paid_date"])[0] . ' <br>
                                                                        Amount Due&nbsp;:&nbsp;50$ worth of UCC
                                                                    </p>
                                                                </div>
                                                                <div align="start">
                                                                    <p>
                                                                        Let us know if you have issues while paying this invoice or if you have any questions regarding it by emailing us at <a href="mailto:info@uccashtourism.com" style="text-decoration: none;color: black;"><b>info@uccashtourism.com</b></a>
                                                                    </p>
                                                                </div>
                                                                <div align="start">
                                                                    <p>Sincerely,<br>UCCASH Tourism ®</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                <td align="center" bgcolor="#ffffff">
                                    <div
                                        style="width: 100%; max-width: 600px; height: 100px; background-color:#F7C128; display: table;padding-bottom:20px;">
                                        <div>
                                            <p style="color:white;font-size:150%"><b>JOIN OUR TEAM</b></p>
                                        </div>
                                        <div>
                                            <p style="color:white;font-size:100%">Check our UCCASH Tourism Blog for new publications</p>
                                        </div>
                                        <div>
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr align="center">
                                                    <td>
                                                        <a href="https://www.facebook.com/uccashtourism"><img
                                                                src="https://i.ibb.co/VQNTT0Q/facebook.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://www.instagram.com/uccashtourism"><img
                                                                src="https://i.ibb.co/WFJGYwZ/instagram.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://www.linkedin.com/in/uccashtourism"><img
                                                                src="https://i.ibb.co/xz1ymRw/linkedin.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://t.me/uccashtourism"><img
                                                                src="https://i.ibb.co/g9kx8W3/telegram.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://whatsapp.com/channel/0029VaNZVU117En3yKTBiu2b"><img
                                                                src="https://i.ibb.co/9wGnSY4/whatsapp.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://x.com/uccashtourism"><img src="https://i.ibb.co/nkHQYgG/X.jpg" width="50%" style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://youtube.com/@UCCASHTOURISM"><img
                                                                src="https://i.ibb.co/Yc6bNND/youtube.jpg" width="50%"
                                                                style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <p style="color:white;font-size:100%">Click here to share your UCCASH Tourism story, photos, and
                                                videos with the world!</p>
                                        </div>
                                        <div>
                                            <p style="color:white;font-size:160%"><b>UCCASH TOURISM PRIVATE LIMITED</b></p>
                                        </div>
                                        <div>
                                            <p style="color:white;font-size:105%"><b>No-1, 1st Floor, Selvam Complex, Tharamangalam,</b></p>
                                        </div>
                                        <div>
                                            <p style="color:white;font-size:105%"><b>Omalur TK, Salem DT, Tamilnadu, India - 636502</b></p>
                                        </div>
                                        <div>
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr style="font-size: 100%;" align="center">
                                                    <td style="width: 50%; padding: 0;" align="start">
                                                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                                            <tr>
                                                                <td align="right" style="padding-right: 5px;"><img src="https://i.ibb.co/0QpNTr1/website.jpg" width="16" height="16" alt="Logo"></td>
                                                                <td align="left"><a style="text-decoration: none; color: black;" href="https://uccashtourism.com">https://uccashtourism.com</a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 50%; padding: 0;" align="start">
                                                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                                            <tr>
                                                                <td align="right"><img src="https://i.ibb.co/fS2MpZm/email.jpg" width="16" height="16" alt="Logo"></td>
                                                                <td align="right"  style="width: 20px;">&nbsp;&nbsp;<a style="padding-right: 5px;text-decoration: none; color: black;" href="mailto:info@uccashtourism.com">info@uccashtourism.com</a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                </table>
                                            </body>
                                            
                                            </html>
                                            ';

                    if ($mail->send()) {
                        //Success Message
                        $response["status"] = "success";
                        echo json_encode($response);
                    }

                } catch (Exception $e) {
                    //Error Message
                    $response["status"] = "error";
                    echo json_encode($response);
                }

            }

        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>