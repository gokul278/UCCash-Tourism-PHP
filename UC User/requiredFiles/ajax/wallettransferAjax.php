<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";


require "../../../requiredFiles/ajax/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

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

            //Savings Travel Points
            $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$datarow["user_id"]}'");
            $stcredit = 0;
            $stdebit = 0;

            if (mysqli_num_rows($savingtravel) >= 1) {

                foreach ($savingtravel as $getsavingtravel) {
                    if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                        if ($getsavingtravel["st_action"] == "credit") {
                            $stcredit += (float) $getsavingtravel["st_points"];
                        } else if ($getsavingtravel["st_action"] == "debit") {
                            $stdebit += (float) $getsavingtravel["st_points"];
                        }
                    }
                }

            }

            $response["savingstravelpoints"] = number_format(($stcredit - $stdebit), 2);

            $tabledata = "";

            $data = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}' AND st_remark='transfer'");

            foreach ($data as $index => $getData) {
                $tabledata .= '
                <tr>
                    <th scope="col">' . ($index + 1) . '</th>
                    <th>' . $getData["st_createdat"] . '</th>
                    <th>' . $getData["st_bonusfrom"] . '</th>
                ';

                if ($getData['st_action'] == 'credit') {
                    $tabledata .= '
                            <th>Recived</th>
                            <th>' . $getData["st_points"] . '</th>
                            <th></th>
                        </tr>
                    ';
                } else if ($getData['st_action'] == 'debit') {
                    $tabledata .= '
                        <th>Transferred</th>
                        <th></th>
                        <th>' . $getData["st_points"] . '</th>
                    </tr>
                ';
                }
            }

            $response["tabledata"] = $tabledata;

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "savingstravelpoints") {

        //Savings Travel Points
        $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}'");
        $stcredit = 0;
        $stdebit = 0;

        if (mysqli_num_rows($savingtravel) >= 1) {

            foreach ($savingtravel as $getsavingtravel) {
                if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                    if ($getsavingtravel["st_action"] == "credit") {
                        $stcredit += (float) $getsavingtravel["st_points"];
                    } else if ($getsavingtravel["st_action"] == "debit") {
                        $stdebit += (float) $getsavingtravel["st_points"];
                    }
                }
            }
        }

        $response["balanacevalue"] = number_format(($stcredit - $stdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "checksponser") {

        // Checking the Sponser ID - start

        $sponser_id = $_POST["userid"];

        $sql = "SELECT * FROM userdetails WHERE user_id = '{$sponser_id}'";

        $res = $con->query($sql);

        $getdata = $res->fetch_assoc();

        if (mysqli_num_rows($res) == 1) {

            //Checking the Sponser ID
            $row = $res->fetch_assoc();

            if ($getdata["user_id"] == $values["userid"]) {
                $response["status"] = "success";
                $response["message"] = "invalid";
                $response["stage"] = "not";
            } else {
                $response["status"] = "success";
                $response["message"] = $getdata["user_name"];
                $response["stage"] = "ok";

            }


        } else {

            $response["status"] = "success";
            $response["message"] = "invalid";
            $response["stage"] = "not";

        }

        echo json_encode($response);

        // Checking the Sponser ID - start
    } else if ($way == "transferwallet") {

        $wallettype = $_POST["wallettype"];
        $userid = $_POST["userid"];
        $transferpoints = $_POST["transferpoints"];
        $otp = $_POST["otp"];

        $checkotp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getcheckotp = $checkotp->fetch_assoc();

        if ($getcheckotp["otp"] == $otp) {

            if ($wallettype == "savingstravelpoints") {

                $activation = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}' AND user_referalStatus='activated'");

                if (mysqli_num_rows($activation)) {

                    $checkid = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                    // $getcheckid = $checkid->fetch_assoc();

                    if (mysqli_num_rows($checkid) >= 1) {

                        //Savings Travel Points
                        $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}'");
                        $stcredit = 0;
                        $stdebit = 0;

                        if (mysqli_num_rows($savingtravel) >= 1) {

                            foreach ($savingtravel as $getsavingtravel) {
                                if (isset($getsavingtravel["st_action"]) && strlen($getsavingtravel["st_action"]) >= 1) {
                                    if ($getsavingtravel["st_action"] == "credit") {
                                        $stcredit += (float) $getsavingtravel["st_points"];
                                    } else if ($getsavingtravel["st_action"] == "debit") {
                                        $stdebit += (float) $getsavingtravel["st_points"];
                                    }
                                }
                            }

                        }

                        $savingsincomebalance = $stcredit - $stdebit;

                        if ($transferpoints <= $savingsincomebalance) {

                            $debituser = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_bonusfrom,st_action,st_remark)
                            VALUES ('{$values["userid"]}','{$transferpoints}','Transferred for {$userid}','debit','transfer')");

                            $credituser = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_bonusfrom,st_action,st_remark)
                            VALUES ('{$userid}','{$transferpoints}','Transferred From {$values["userid"]}','credit','transfer')");


                            if ($credituser && $debituser) {
                                $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                                $response["status"] = "success";
                                echo json_encode($response);
                            } else {
                                $response["status"] = "error";
                                $response["message"] = "sql error";
                                echo json_encode($response);
                            }

                        } else {

                            $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                            $response["status"] = "error";
                            $response["message"] = "Insufficient balance";
                            echo json_encode($response);


                        }



                    } else {

                        $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                        $response["status"] = "error";
                        $response["message"] = "Invalid User ID";
                        echo json_encode($response);


                    }

                } else {

                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Activate Your ID";
                    echo json_encode($response);

                }


            } else {

                $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "Choose Wallet Type";
                echo json_encode($response);


            }

        } else {

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);

        }






    } else if ($way == "getotp") {

        $userid = $_POST["userid"];
        $points = $_POST["points"];

        $userdata = $con->query("SELECT * from Userdetails WHERE user_id='{$values["userid"]}'");
        $getuserdata = $userdata->fetch_assoc();


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
            $mail->addAddress($getuserdata["user_email"]);
            $mail->isHTML(true);
            $mail->Subject = 'Wallet Transfer OTP';
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
                                                        Wallet Transfer
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div align="start" style="margin-top: 30px;">
                                        <p>Hello ' . $getuserdata["user_name"] . ',</p>
                                    </div>
                                    <div align="start">
                                        <p>Did you make a Wallet Transfer?. If so, please check your details and use OTP for Wallet Transfer</p>
                                    </div>
                                    <div align="start">
                                        <p><b>Wallet Transfer Details:</b><br>
                                        Wallet Type&nbsp;:&nbsp;Savings Travel Point<br>
                                        Transfer User ID&nbsp;&nbsp;:&nbsp;' . $userid . '<br>
                                        Transfer Points&nbsp;&nbsp;:&nbsp;' . $points . '<br>                                    
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
                                            Let us know if you have issues while applying Wallet Transfer or if you have any questions regarding it by emailing us at <a href="mailto:info@uccashtourism.com" style="text-decoration: none;color: black;"><b>info@uccashtourism.com</b></a>
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
    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>