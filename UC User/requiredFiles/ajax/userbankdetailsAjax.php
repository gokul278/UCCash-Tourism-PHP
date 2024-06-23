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

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            $checkdetailssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
            $checkdetailsres = $con->query($checkdetailssql);

            if (mysqli_num_rows($checkdetailsres) == 1) {

                $detailsrow = $checkdetailsres->fetch_assoc();
                $response["ac_holdername"] = $detailsrow["ac_holdername"];
                $response["ac_bankname"] = $detailsrow["ac_bankname"];
                $response["ac_number"] = $detailsrow["ac_number"];
                $response["ifsc_code"] = $detailsrow["ifsc_code"];
                $response["branch"] = $detailsrow["branch"];
                $response["trc20_address"] = $detailsrow["trc20_address"];
                $response["bep20_address"] = $detailsrow["bep20_address"];

            } else if (mysqli_num_rows($checkdetailsres) == 0) {

                $response["ac_holdername"] = "";
                $response["ac_bankname"] = "";
                $response["ac_number"] = "";
                $response["ifsc_code"] = "";
                $response["branch"] = "";
                $response["trc20_address"] = "";
                $response["bep20_address"] = "";

            }

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "otpmail") {

        $userid = $values["userid"];

        $data = $con->query("SELECT * FROM userdetails WHERE user_id='{$userid}'");
        $getdata = $data->fetch_assoc();

        $email = $getdata["user_email"];

        $otp = rand(100000, 999999);

        $check = $con->query("SELECT * FROM userbankdetails WHERE user_id='$userid'");

        if (mysqli_num_rows($check) == 1) {
            $updateotp = $con->query("UPDATE userbankdetails SET otp='{$otp}' WHERE user_id='{$userid}'");
        } else {
            $insertotp = $con->query("INSERT INTO userbankdetails (user_id,otp) VALUES ('{$userid}','{$otp}')");
        }

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
            $mail->Subject = 'Changing Bank Details';
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
                                            Change Bank Details
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div align="start" style="margin-top: 30px;">
                                <p>Hi ' . $getdata["user_name"] . ',</p>
                            </div>
                            <div align="start">
                                <p>Did you Change your Bank Details? If you did not, please ignore this email. If so, please use the OTP.</p>
                            </div>
                            <div align="center">
                            <div style="color: black; text-align: center;font-size:120%">Your OTP : <span style="background-color:yellow;color: black;padding:5px;border-radius:5px">' . $otp . '</span></div>
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
            $response["status"] = "failed";
            $response["message"] = $e->getMessage();
            echo json_encode($response);
        }

    } else if ($way == "bankdetailsupdate") {

        $checkdetailssql = "SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'";
        $checkdetailsres = $con->query($checkdetailssql);

        $ac_holdername = $_POST["acholdername"];
        $ac_bankname = $_POST["acbankname"];
        $ac_number = $_POST["acnumber"];
        $ifsc_code = $_POST["ifsccode"];
        $branch = $_POST["branch"];
        $trc20address = $_POST["trc20address"];
        $bep20address = $_POST["bep20address"];
        $otp = $_POST["otp"];

        $checkotp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getcheckotp = $checkotp->fetch_assoc();

        if ($otp == $getcheckotp["otp"]) {

            $updatebankdetails = $con->query("UPDATE userbankdetails SET 
                            ac_holdername = '{$ac_holdername}', 
                            ac_bankname = '{$ac_bankname}', 
                            ac_number = '{$ac_number}', 
                            ifsc_code = '{$ifsc_code}', 
                            branch = '{$branch}' ,
                            trc20_address = '{$trc20address}',
                            bep20_address = '{$bep20address}',
                            otp = null
                            WHERE user_id = '{$values["userid"]}'");

            if ($updatebankdetails) {
                $response["status"] = "success";
                echo json_encode($response);
            }



        } else {
            $response["status"] = "failed";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>