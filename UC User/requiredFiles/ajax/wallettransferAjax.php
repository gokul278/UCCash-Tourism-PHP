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

            //Bonus Travel Points
            $bonustravel = $con->query("SELECT * FROM bonustravelpoints WHERE user_id='{$values["userid"]}'");
            $btcredit = 0;
            $btdebit = 0;

            if (mysqli_num_rows($bonustravel) >= 1) {

                foreach ($bonustravel as $getbonustravel) {
                    if (isset($getbonustravel["bt_action"]) && strlen($getbonustravel["bt_action"]) >= 1) {
                        if ($getbonustravel["bt_action"] == "credit") {
                            $btcredit += (float) $getbonustravel["bt_points"];
                        } else if ($getbonustravel["bt_action"] == "debit") {
                            $btdebit += (float) $getbonustravel["bt_points"];
                        }
                    }
                }
            }

            $response["bonustravelpoints"] = number_format(($btcredit - $btdebit), 2);

            $tabledata = "";

            $data = $con->query("
            SELECT
                stp.user_id,
                stp.st_points AS points,
                stp.st_createdat AS created_at,
                'Savings Travel Point' AS SOURCE,
                stp.st_bonusfrom AS remark,
                stp.st_action AS action
            FROM
                savingstravelpoints stp
            WHERE
                stp.user_id = '{$values["userid"]}' AND stp.st_remark = 'transfer'
            UNION ALL
            SELECT
                btp.user_id,
                btp.bt_points AS points,
                btp.bt_createdat AS created_at,
                'Bonus Travel Point' AS SOURCE,
                btp.bt_bonusfrom AS remark,
                btp.bt_action AS action
            FROM
                bonustravelpoints btp
            WHERE
                btp.user_id = '{$values["userid"]}'
                AND btp.bt_lvl = 'transfer'
            ORDER BY
                created_at ASC;
            ");

            foreach ($data as $index => $getData) {
                $tabledata .= '
                <tr>
                    <th scope="col">' . ($index + 1) . '</th>
                    <th>' . $getData["SOURCE"] . '</th>
                    <th>' . $getData["created_at"] . '</th>
                    <th>' . $getData["remark"] . '</th>
                ';

                if ($getData['action'] == 'credit') {
                    $tabledata .= '
                            <th>Recived</th>`
                            <th>' . $getData["points"] . '</th>
                            <th></th>
                        </tr>
                    ';
                } else if ($getData['action'] == 'debit') {
                    $tabledata .= '
                        <th>Transferred</th>
                        <th></th>
                        <th>' . $getData["points"] . '</th>
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
    } else if ($way == "bonustravelpoints") {

        //Savings Travel Points
        $savingtravel = $con->query("SELECT * FROM bonustravelpoints WHERE user_id='{$values["userid"]}'");
        $stcredit = 0;
        $stdebit = 0;

        if (mysqli_num_rows($savingtravel) >= 1) {

            foreach ($savingtravel as $getsavingtravel) {
                if (isset($getsavingtravel["bt_action"]) && strlen($getsavingtravel["bt_action"]) >= 1) {
                    if ($getsavingtravel["bt_action"] == "credit") {
                        $stcredit += (float) $getsavingtravel["bt_points"];
                    } else if ($getsavingtravel["bt_action"] == "debit") {
                        $stdebit += (float) $getsavingtravel["bt_points"];
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
        $towallettype = $_POST["towallettype"];
        $userid = $_POST["userid"]; // Receiver ID
        $transferpoints = $_POST["transferpoints"];
        $otp = $_POST["otp"];

        $checkotp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getcheckotp = $checkotp->fetch_assoc();

        if ($getcheckotp["otp"] != $otp) {
            echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
            return;
        }

        $activation = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}' AND user_referalStatus='activated'");
        if (!mysqli_num_rows($activation)) {
            $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
            echo json_encode(["status" => "error", "message" => "Activate Your ID"]);
            return;
        }

        function getWalletBalance($con, $userid, $walletTable, $creditCol, $actionCol)
        {
            $balance = 0;
            $result = $con->query("SELECT * FROM $walletTable WHERE user_id='$userid'");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    if ($row[$actionCol] == 'credit') {
                        $balance += (float) $row[$creditCol];
                    } elseif ($row[$actionCol] == 'debit') {
                        $balance -= (float) $row[$creditCol];
                    }
                }
            }
            return $balance;
        }

        $wallets = [
            "savingstravelpoints" => [
                "table" => "savingstravelpoints",
                "col" => "st_points",
                "action" => "st_action",
                "bonusfrom" => "st_bonusfrom",
                "remark" => "st_remark"
            ],
            "bonustravelpoints" => [
                "table" => "bonustravelpoints",
                "col" => "bt_points",
                "action" => "bt_action",
                "bonusfrom" => "bt_bonusfrom",
                "remark" => "bt_lvl"
            ]
        ];

        if (!isset($wallets[$wallettype]) || !isset($wallets[$towallettype])) {
            echo json_encode(["status" => "error", "message" => "Invalid wallet type"]);
            return;
        }

        $balance = getWalletBalance($con, $values["userid"], $wallets[$wallettype]["table"], $wallets[$wallettype]["col"], $wallets[$wallettype]["action"]);
        if ((float)$transferpoints > $balance) {
            $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
            echo json_encode(["status" => "error", "message" => "Insufficient balance"]);
            return;
        }

        // From Wallet
        $fromTable = $wallets[$wallettype]["table"];
        $fromCol = $wallets[$wallettype]["col"];
        $fromAction = $wallets[$wallettype]["action"];
        $fromBonusFrom = $wallets[$wallettype]["bonusfrom"];
        $fromRemark = $wallets[$wallettype]["remark"];

        // To Wallet
        $toTable = $wallets[$towallettype]["table"];
        $toCol = $wallets[$towallettype]["col"];
        $toAction = $wallets[$towallettype]["action"];
        $toBonusFrom = $wallets[$towallettype]["bonusfrom"];
        $toRemark = $wallets[$towallettype]["remark"];

        // Start DB Transaction
        $con->begin_transaction();
        try {
            $debit = $con->query("INSERT INTO $fromTable (user_id, $fromCol, $fromBonusFrom, $fromAction, $fromRemark) 
            VALUES ('{$values["userid"]}', '$transferpoints', 'Transferred for $userid', 'debit', 'transfer')");

            if (!$debit) {
                throw new Exception("Debit failed: " . $con->error);
            }

            $credit = $con->query("INSERT INTO $toTable (user_id, $toCol, $toBonusFrom, $toAction, $toRemark) 
            VALUES ('$userid', '$transferpoints', 'Transferred from {$values["userid"]}', 'credit', 'transfer')");

            if (!$credit) {
                throw new Exception("Credit failed: " . $con->error);
            }

            $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
            $con->commit();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            $con->rollback();
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    } else if ($way == "getotp") {

        $selectoption = $_POST["selectoption"];
        $toselectoption = $_POST["toselectoption"];

        // Human-readable wallet names
        $walletNames = [
            "savingstravelpoints" => "Savings Travel Point",
            "bonustravelpoints" => "Bonus Travel Point"
        ];

        // Example usage
        $fromWalletName = isset($walletNames[$selectoption]) ? $walletNames[$selectoption] : "Unknown Wallet";
        $toWalletName = isset($walletNames[$toselectoption]) ? $walletNames[$toselectoption] : "Unknown Wallet";

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
                                                            <img src="https://uccashtourism.com/img/logo2.png" width="90%"
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
                                        From Wallet Type&nbsp;:&nbsp;' . $fromWalletName . '<br>
                                        To Wallet Type&nbsp;:&nbsp;' . $toWalletName . '<br>
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
