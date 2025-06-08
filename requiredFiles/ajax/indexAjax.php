<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$name = $_POST["name"];
$address = $_POST["address"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$phone_country = $_POST["phone_country"];
$whatsappno = $_POST["whatsappno"];
$whatsno_country = $_POST["whatsno_country"];
$tourtype = $_POST["tourtype"];
$bookingid = $_POST["bookingid"];
$noofpeople = $_POST["noofpeople"];
$package = $_POST["package"];

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
    $mail->Username = 'support@uccashtourism.com';
    $mail->Password = 'Tourism@#$2023';
    $mail->setFrom('support@uccashtourism.com', 'UCCASH Tourism');
    // uccashtourism@gmail.com
    $mail->addAddress("uccashtourism@gmail.com");
    $mail->Subject = 'Contact Us Mail From ' . $name;
    $mail->isHTML(true);
    $mail->Body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Template</title>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td align="center" bgcolor="#ffffff">
                    <table width="600" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="center" bgcolor="#000000">
                                <div style="width: 100%; max-width: 600px; height: 100px; background-color:black; display: table;">
                                    <table width="100%" cellpad ding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td align="start" style="width: 60%; height: 100%;">
                                                <img src="https://uccashtourism.com/img/logo2.png" width="90%" style="display: block; margin: 0 auto;" alt="Logo">
                                            </td>
                                            <td align="end" style="width: 40%; height: 100%;">
                                                <p style="color: white; text-align: center;font-size:120%"><b>Let\'s go</b></p>
                                                <p style="color: white; text-align: center;font-size:120%"><b>around the world</b></p>
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
                    <div style="width: 100%; max-width: 600px; height: 500px; background-color:white; display: table;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:20px"> 
                            <tr align="center" style="width: 60%;">
                                <td>
                                    <p style="color: white; text-align: center;font-size:160%;background-color: #F7C128;padding: 10px;border-radius: 10px;"><b>Enquiry Details</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Name : <b>' . $name . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Address : <b>' . $address . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Email : <b>' . $email . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Phone No : <b>+' . $phone_country . ' ' . $phone . '</b></p>
                                </td>
                            </tr><tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Whatsapp No : <b>+' . $whatsno_country . ' ' . $whatsappno . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Number of people : <b>' . $noofpeople . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Tour Type : <b>' . $tourtype . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Booking Code : <b>' . $bookingid . '</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Package : <b>' . $package . '</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                        <td align="center" bgcolor="#ffffff">
                            <div
                                style="width: 100%; max-width: 600px; height: 100px; background-color:#F7C128; display: table;padding-bottom:10px;">
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
                                                        src="https://uccashtourism.com/MailImg/fb.png" width="50%"
                                                        style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://www.instagram.com/uccashtourism"><img
                                                        src="https://uccashtourism.com/MailImg/instagram.png" width="50%"
                                                        style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://www.linkedin.com/in/uccashtourism"><img
                                                        src="https://uccashtourism.com/MailImg/linkedin.png" width="50%"
                                                        style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://t.me/uccashtourism"><img
                                                        src="https://uccashtourism.com/MailImg/telegram.png" width="50%"
                                                        style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://whatsapp.com/channel/0029VaNZVU117En3yKTBiu2b"><img
                                                        src="https://uccashtourism.com/MailImg/whatsapp.png" width="50%"
                                                        style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://x.com/uccashtourism"><img src="https://uccashtourism.com/MailImg/twitterx.png" width="50%" style="display: block; margin: 0 auto;" alt="Logo"></a>
                                            </td>
                                            <td>
                                                <a href="https://youtube.com/@UCCASHTOURISM"><img
                                                        src="https://uccashtourism.com/MailImg/youtube.png" width="50%"
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
                                                        <td align="right" style="padding-right: 5px;"><img src="https://uccashtourism.com/MailImg/website.png" width="16" height="16" alt="Logo"></td>
                                                        <td align="left"><a style="text-decoration: none; color: black;" href="https://uccashtourism.com">https://uccashtourism.com</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width: 50%; padding: 0;" align="start">
                                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                                    <tr>
                                                        <td align="right"><img src="https://uccashtourism.com/MailImg/mail.png" width="16" height="16" alt="Logo"></td>
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
