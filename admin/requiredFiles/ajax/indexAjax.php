<?php

include ("../../../requiredFiles/ajax/DBConnection.php");

require ("./php_jwt/vendor/autoload.php");

use Firebase\JWT\JWT;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$way = $_POST["way"];

if ($way == "login") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $checkidsql = "SELECT * FROM admindetails WHERE admin_email = '{$email}'";
    $checkidres = $con->query($checkidsql);

    if (mysqli_num_rows($checkidres) == 1) {

        $row = $checkidres->fetch_assoc();

        if (md5($password) == $row["admin_password"]) {

            $key = "403943087a70d97327defe86ed8c237admin";

            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600,
                    'data' => array(
                        'admin_id' => $row["admin_id"],
                        'admin_name' => $row["admin_name"]
                    )
                ),
                $key,
                'HS256'
            );

            setcookie("token", $token, time() + 3600, "/", "", true, true);

            $response["status"] = "success";
            echo json_encode($response);

        } else {

            $response["status"] = "failed";
            $response["message"] = "Invalid Password";
            echo json_encode($response);

        }

    } else {

        $response["status"] = "failed";
        $response["message"] = "Invalid E-Mail";
        echo json_encode($response);

    }

} else if ($way == "getData") {


    $details = $con->query("SELECT * FROM admindetails WHERE admin_id='UCT000000'");

    $getdetails = $details->fetch_assoc();


    $response["admin_name"] = $getdetails["admin_name"];
    $response["profile_image"] = $getdetails["admin_profile"];

    $response["status"] = "success";
    echo json_encode($response);

} else if ($way == "forgetpassword") {

    // Generate a random string
    $randomString = uniqid(mt_rand(), true);

    // Generate MD5 hash
    $randomHash = md5($randomString);

    $data = $con->query("SELECT * FROM admindetails WHERE admin_id='UCT000000'");
    $getdata = $data->fetch_assoc();

    $updatesql = "UPDATE admindetails SET admin_forgetpasshash = '{$randomHash}', admin_remark='pending' WHERE admin_id='UCT000000'";
    $updateres = $con->query($updatesql);

    //Mailing the Hash Value

    $postemail = $getdata["admin_email"];
    $name = $getdata["admin_name"];

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
                                     <a href="https://uccashtourism.com/admin/change_pwd.php?hash_value=' . $randomHash . '" style="text-decoration: none;color: black;">
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
                         <a href="https://uccashtourism.com/admin/change_pwd.php?hash_value=' . $randomHash . '" style="color: black;">https://uccashtourism.com/admin/change_pwd.php?hash_value=' . $randomHash . '</a>
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
    $response["message"] = "try Again";
    echo json_encode($response);
}

?>