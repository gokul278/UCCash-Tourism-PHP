<?php

include ("./DBConnection.php"); //DB Connection File

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$way = $_POST["way"]; // Way for Find the Work

if ($way == "forgetPassword") {

    $userid = $_POST["userid"];

    $checkuseridsql = "SELECT * FROM userdetails WHERE user_id = '{$userid}'";
    $checkuseridres = $con->query($checkuseridsql);

    if (mysqli_num_rows($checkuseridres) == 1) {

        $row = $checkuseridres->fetch_assoc();

        $checkforgetmailsql = "SELECT * FROM forgetpassword WHERE user_id='{$userid}'";
        $checkforgetmailres = $con->query($checkforgetmailsql);

        // Generate a random string
        $randomString = uniqid(mt_rand(), true);

        // Generate MD5 hash
        $randomHash = md5($randomString);

        //Checking the forgetpassword Mail and storing the HASH Value

        if (mysqli_num_rows($checkforgetmailres) == 1) {
            $updatesql = "UPDATE forgetpassword SET forgetpass_hash = '{$randomHash}' WHERE user_id = '{$userid}'";
            $updateres = $con->query($updatesql);
        } else {
            $insertsql = "INSERT INTO forgetpassword (user_id, forgetpass_hash) VALUES ('{$userid}','{$randomHash}')";
            $insertres = $con->query($insertsql);
        }

        //Mailing the Hash Value

        $postemail = $row["user_email"];
        $name = $row["user_name"];

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'redana.food@gmail.com';
            $mail->Password = 'zibwucwdyhhzmdan';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('redana.food@gmail.com', 'Redana Team');
            $mail->addAddress($postemail);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
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
                                            <a href="http://localhost/UC-Tour/change_pwd.php?user_id=' . $userid . '&hash_value=' . $randomHash . '" style="text-decoration: none;color: black;">
                                                Reset Password
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div align="start" style="margin-top: 30px;">
                                <p>Hi ' . $name . ',</p>
                            </div>
                            <div align="start">
                                <p>Did you forget your password? If you did not, please ignore this email. If so, please click the link below.</p>
                            </div>
                            <div align="start">
                                <a href="http://localhost/UC-Tour/change_pwd.php?user_id=' . $userid . '&hash_value=' . $randomHash . '" style="color: black;">http://localhost/UC-Tour/change_pwd.php?user_id=' . $userid . '&hash_value=' . $randomHash . '</a>
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
                                            <tr style="font-size:90%" align="center">
                                                <td style="width:6%" align="end">
                                                    <a href="google.com"><img src="https://i.ibb.co/0QpNTr1/website.jpg" width="50%"
                                                            style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                </td>
                                                <td align="start" style="color:black; width:44%">
                                                    <b>
                                                        <a style="text-decoration:none; color:black;"
                                                            href="https://uccashtourism.com">https://uccashtourism.com</a>
                                                    </b>
                                                </td>
                                                <td width:6%" align="end">
                                                    <a href="google.com"><img src="https://i.ibb.co/fS2MpZm/email.jpg" width="50%"
                                                            style="display: block; margin: 0 auto;" alt="Logo"></a>
                                                </td>
                                                <td align="start" style="color:black; width:44%"">
                                                            <b>
                                                                <a style=" text-decoration:none; color:black;"
                                                    href="mailto:info@uccashtourism.com">info@uccashtourism.com</a>
                                                    </b>
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
                $response["message"] = "Forget Password Link Sended for Your Mail";
                echo json_encode($response);
            }

        } catch (Exception $e) {
            $response["status"] = "failed";
            $response["message"] = "Mail Error";
            echo json_encode($response);
        }


    } else {

        $response["status"] = "failed";
        $response["message"] = "Invalid User ID";
        echo json_encode($response);
    }

} else {
    $response["status"] = "failed";
    $response["message"] = "Try Again";
    echo json_encode($response);
}

?>