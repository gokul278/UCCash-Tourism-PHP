<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

require "./vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

$values = token::verify();

$coinvalue = 0;

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

            $bankdetails = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
            $getbankdetails = $bankdetails->fetch_assoc();


            $checkpay = $con->query("SELECT * FROM withdrawhistory WHERE user_id='{$values["userid"]}' AND action='admin'");

            //UCC Wallet
            $uccwallet = $con->query("SELECT * FROM uccwalletpoints WHERE user_id='{$datarow["user_id"]}'");
            $uccwcredit = 0;
            $uccwdebit = 0;

            if (mysqli_num_rows($uccwallet) >= 1) {

                foreach ($uccwallet as $getuccwallet) {
                    if (isset($getuccwallet["uccw_action"]) && strlen($getuccwallet["uccw_action"]) >= 1) {
                        if ($getuccwallet["uccw_action"] == "credit") {
                            $uccwcredit += (float) $getuccwallet["uccw_points"];
                        } else if ($getuccwallet["uccw_action"] == "debit") {
                            $uccwdebit += (float) $getuccwallet["uccw_points"];
                        }
                    }
                }

            }

            $response["uccwallet"] = number_format(($uccwcredit - $uccwdebit), 2);

            if (mysqli_num_rows($checkpay) == 0) {

                $response["bep20_address"] = "";


                if (mysqli_num_rows($bankdetails) == 1) {
                    $response["bep20_address"] = $getbankdetails["bep20_address"];
                }




                $response["status"] = "success";
                echo json_encode($response);

            } else {

                $response["status"] = "nopay";
                $response["message"] = "Previous Withdraw Pending";
                echo json_encode($response);

            }



        }

    } else if ($way == "cryptootp") {

        $amount = $_POST["amount"];
        $coinvalue = $amount;
        $email = "";
        $name = "";
        $bep20_address = "";

        $details = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
        $getdetails = $details->fetch_assoc();
        $email = $getdetails["user_email"];
        $name = $getdetails["user_name"];

        $bankdetails = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getbankdetails = $bankdetails->fetch_assoc();
        $bep20_address = $getbankdetails["bep20_address"];


        $otp = rand(100000, 999999);

        $updateotp = $con->query("UPDATE userbankdetails SET otp='{$otp}' WHERE user_id='{$values["userid"]}'");

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
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Withdraw Request OTP';
            $mail->Body = '
            <!DOCTYPE html>
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
                                                    <a style="text-decoration: none;color: black;">
                                                        Withdraw Request
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div align="start" style="margin-top: 30px;">
                                        <p>Hello ' . $name . ',</p>
                                    </div>
                                    <div align="start">
                                        <p>Did you make a withdraw request?. If so, please check your details and use OTP for withdrawal</p>
                                    </div>
                                    <div align="start">
                                        <p><b>Withdraw Details:</b><br>
                                            Type&nbsp;:&nbsp;UCC<br>
                                            BEP20 Address&nbsp;:&nbsp;' . $bep20_address . '<br>
                                            Withdrawal Coin&nbsp;:&nbsp;' . $amount . '
                                        </p>
                                    </div>
                                    <div align="start" style="margin-top: 40px;margin-bottom: 40px;">
                                        <table>
                                            <tr align="center">
                                                <td style="width: 50%;height: 50px;background-color: #F7C128;border-radius: 50px;">
                                                    <a style="text-decoration: none;color: black;">
                                                        OTP&nbsp;:&nbsp;' . $otp . '
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div align="start">
                                        <p>
                                            Let us know if you have issues while paying this applying withdraw or if you have any questions regarding it by emailing us at <a href="mailto:info@uccashtourism.com" style="text-decoration: none;color: black;"><b>info@uccashtourism.com</b></a>
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
                $response["status"] = "success";
                echo json_encode($response);
            }

        } catch (Exception $e) {
            $response["status"] = "error";
            echo json_encode($response);
        }




    } else if ($way == "cryptowithdraw") {

        $withdrawvalue = $_POST["withdrawvalue"];
        $otp = $_POST["otp"];

        $checkactivation = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");

        $getcheckactivation = $checkactivation->fetch_assoc();

        if ($getcheckactivation["user_referalStatus"] == "activated") {

            $activationdate = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$values["userid"]}' AND remark='Activation Successful'");
            $getactivationdate = $activationdate->fetch_assoc();

            $date = new DateTime($getactivationdate["paid_date"]);

            $date->modify('+3 years');

            // Get the current date
            $currentDate = new DateTime();

            if ($currentDate >= $date) {

                // Use prepared statements to prevent SQL injection
                $stmt = $con->prepare("SELECT * FROM userbankdetails WHERE user_id=?");
                $stmt->bind_param('s', $values["userid"]);
                $stmt->execute();
                $checkotp = $stmt->get_result();
                $getcheckotp = $checkotp->fetch_assoc();

                if ($otp == $getcheckotp["otp"]) {


                    //Available Withdraw Balance
                    $stmt = $con->prepare("SELECT * FROM uccwalletpoints WHERE user_id=?");
                    $stmt->bind_param('s', $values["userid"]);
                    $stmt->execute();
                    $availablewithdrwabalance = $stmt->get_result();
                    $uccwcredit = 0;
                    $uccwdebit = 0;

                    while ($getavailablewithdrwabalance = $availablewithdrwabalance->fetch_assoc()) {
                        if (isset($getavailablewithdrwabalance["uccw_action"]) && strlen($getavailablewithdrwabalance["uccw_action"]) >= 1) {
                            if ($getavailablewithdrwabalance["uccw_action"] == "credit") {
                                $uccwcredit += (float) $getavailablewithdrwabalance["uccw_points"];
                            } else if ($getavailablewithdrwabalance["uccw_action"] == "debit") { // Fix this line
                                $uccwdebit += (float) $getavailablewithdrwabalance["uccw_points"];
                            }
                        }
                    }

                    $totalbalance = $uccwcredit - $uccwdebit;
                    $formattedTotalBalance = number_format($totalbalance, 2);

                    $netamount = number_format(($withdrawvalue), 2);

                    if ($totalbalance < $withdrawvalue) {
                        $response["status"] = "error";
                        $response["message"] = "Insufficient Balance";
                        echo json_encode($response);
                    } else {
                        // Use prepared statements for inserting data
                        $stmt = $con->prepare("INSERT INTO withdrawhistory (user_id, payment_method, withdraw_amount, admin_fees, retopup_fees, net_amount, to_withdraw, txn_id, remark, action) VALUES (?, 'UCC', ?, '', '', ?, ?, 'pending', 'waiting for Payment', 'admin')");
                        $stmt->bind_param('ssss', $values["userid"], $withdrawvalue, $netamount, $getcheckotp["bep20_address"]);
                        $cryptowithdraw = $stmt->execute();

                        if ($cryptowithdraw) {
                            $updateotp = $con->query("UPDATE userbankdetails SET otp=NULL WHERE user_id='{$values["userid"]}'");

                            $response["status"] = "success";
                            $coinvalue = 0;
                        } else {
                            $response["status"] = "failed";
                        }
                        echo json_encode($response);
                    }
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Invalid OTP";
                    echo json_encode($response);
                }

            } else {
                $response["status"] = "error";
                $response["message"] = "You are not eligible for withdraw the Amount";
                echo json_encode($response);
            }

        } else {
            $response["status"] = "error";
            $response["message"] = "Activate your Account";
            echo json_encode($response);
        }




    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>