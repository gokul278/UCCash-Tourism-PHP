<?php

require "./requiredFiles/ajax/DBConnection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./requiredFiles/ajax/vendor/autoload.php";

$mail = new PHPMailer(true);

$checkdate = "SELECT id, user_id, MAX(created_at) AS latest_date
              FROM monthlysavingpendinginvoice
              GROUP BY user_id;";
$checkdateres = $con->query($checkdate);

foreach ($checkdateres as $checkrow) {
    // Check if "created_at" exists in the row
    if (isset($checkrow["latest_date"])) {
        $datetimeString = $checkrow["latest_date"];
        $dateOnly = date("Y-m-d", strtotime($datetimeString));

        $date = new DateTime($dateOnly); // Create a DateTime object with the date-only string
        $today = new DateTime();
        $interval = $date->diff($today);

        if ($interval->days >= 30) {

            $invoiceid = $con->query("SELECT MAX(id) as id FROM monthlytpsavinghistory");

            if(mysqli_num_rows($invoiceid) >=1){
                
                $getinvoiceid = $invoiceid->fetch_assoc();
                $id = (int) $getinvoiceid["id"] + 1;
                $invoiceid="MSI-".$id;

            }else{
                $invoiceid="MSI-1";
            }

            $insertsql = "INSERT INTO  monthlysavingpendinginvoice (invoice_id, user_id, saving_value, bonustp_value, totaltp_value, action)
            VALUES ('{$invoiceid}','{$checkrow["user_id"]}','50$','5','55','pending')";
            $insertres = $con->query($insertsql);

            $getmailsql = "SELECT * FROM userdetails WHERE user_id='{$checkrow["user_id"]}'";
            $getmailres = $con->query($getmailsql);
            $getmailrow = $getmailres->fetch_assoc();

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
                $mail->addAddress($getmailrow["user_email"]);
                $mail->isHTML(true);
                $mail->Subject = 'Monthly savings Pending Invoice';
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
                            <p>Hello, ' . $getmailrow["user_name"] . ',</p>
                        </div>
                        <div align="start">
                            <p>Your latest invoice for your UCCASH Tourism® membership is now past due.</p>
                        </div>
                        <div align="start">
                            <p>As a reminder, your 55 Savings Travel Points will be add in from your cleared invoice</p>
                        </div>
                        <div align="start">
                            <p>Your Savings TP will not receive until this invoice is paid.</p>
                        </div>
                        <div align="start">
                            <p><b>Invoice Details:</b><br>
                                Invoice Number&nbsp;:&nbsp;' . $invoiceid . '<br>
                                Status&nbsp;:&nbsp;Pending <br>
                                Creation Date&nbsp;:&nbsp;' . date("d-m-Y") . ' <br>
                                Amount Due&nbsp;:&nbsp;50$ worth of UCC
                            </p>
                        </div>
                        <div align="start" style="margin-top: 40px;margin-bottom: 40px;">
                            <table>
                                <tr align="center">
                                    <td style="width: 50%;height: 50px;background-color: #F7C128;border-radius: 50px;">
                                        <a href="http://localhost/UC-Tour/UC%20User/monthly%20TP%20savings.php" style="text-decoration: none;color: black;">
                                            View and Pay Invoice
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div align="start">
                            <p>
                                Let us know if you have issues while paying this invoice or if you have any questions regarding it by emailing us at <a href="mailto:billing@uccashtourism.com" style="text-decoration: none;color: black;"><b>billing@uccashtourism.com</b></a>
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
                    echo json_encode($response);
                }

            } catch (Exception $e) {
                $response["status"] = "error";
                echo json_encode($response);
            }

        }
    }
}


?>