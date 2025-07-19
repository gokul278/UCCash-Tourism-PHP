<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

require "../../../requiredFiles/ajax/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

$values = token::verify();

$fintype = "";
$finsavingstravelpoints = 0;
$finbonustravelpoints = 0;
$fintravelcoupon = 0;

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

            $tourid = $_POST["bookingid"];

            $data = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
            $getdata = $data->fetch_assoc();

            $gst = $getdata["tour_amount"] * 0.18;

            $response["gstamount"] = round($gst, 2);
            $response["tour_amount"] = round(($getdata["tour_amount"] - $gst), 2);
            $response["netamount"] = round(($getdata["tour_amount"]), 2);

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

            $response["savingtravel"] = number_format(($stcredit - $stdebit), 2);

            //Bonus Travel Points
            $bonustravel = $con->query("SELECT * FROM bonustravelpoints WHERE user_id='{$datarow["user_id"]}'");
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

            $response["bonustravel"] = number_format(($btcredit - $btdebit), 2);

            //Travel Coupon's
            $travelcoupon = $con->query("SELECT * FROM travelcouponpoints WHERE user_id='{$datarow["user_id"]}'");
            $tccredit = 0;
            $tcdebit = 0;

            if (mysqli_num_rows($travelcoupon) >= 1) {

                foreach ($travelcoupon as $gettravelcoupon) {
                    if (isset($gettravelcoupon["tc_action"]) && strlen($gettravelcoupon["tc_action"]) >= 1) {
                        if ($gettravelcoupon["tc_action"] == "credit") {
                            $tccredit += (float) $gettravelcoupon["tc_points"];
                        } else if ($gettravelcoupon["tc_action"] == "debit") {
                            $tcdebit += (float) $gettravelcoupon["tc_points"];
                        }
                    }
                }
            }

            $response["travelcoupon"] = number_format(($tccredit - $tcdebit), 2);


            //Topup Wallet
            $topupwallet = $con->query("SELECT * FROM topup_wallet WHERE user_id='{$datarow["user_id"]}'");
            $topupcreadit = 0;
            $topupwdebit = 0;

            if (mysqli_num_rows($topupwallet) >= 1) {

                foreach ($topupwallet as $gettopupwallet) {
                    if (isset($gettopupwallet["tu_action"]) && strlen($gettopupwallet["tu_action"]) >= 1) {
                        if ($gettopupwallet["tu_action"] == "credit") {
                            $topupcreadit += (float) $gettopupwallet["tu_points"];
                        } else if ($gettopupwallet["tu_action"] == "debit") {
                            $topupwdebit += (float) $gettopupwallet["tu_points"];
                        }
                    }
                }
            }

            $response["tu_points"] = number_format(($topupcreadit - $topupwdebit), 2);

            $response["status"] = "success";
            echo json_encode($response);
        }
    } else if ($way == "checkamount") {
        $personvalue = round(($_POST["person"]), 2);
        $bookingid = $_POST["bookingid"];
        $selectType = $_POST["selectType"];

        $data = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");
        $getdata = $data->fetch_assoc();

        if ($selectType === "topupwallet") {

            $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
            $datares = $con->query($datasql);
            $datarow = $datares->fetch_assoc();

            $activationStatus = $datarow["user_referalStatus"];

            if ($activationStatus == "activated") {
                $amount = round(($getdata["tour_amount"]), 2);

                $totalamount = $personvalue * $amount;
                $discount = 0.05 * $totalamount;
                $netamount = $totalamount - $discount;

                $gst = $netamount * 0.18;

                $response["gstamount"] = round($gst, 2);
                $response["tour_amount"] = round(($netamount - $gst), 2);
                $response["netamount"] = round($netamount, 2);
                $response["discountamount"] = round($discount, 2);
            } else {
                $amount = round(($getdata["tour_amount"]), 2);

                $totalamount = $personvalue * $amount;

                $gst = $totalamount * 0.18;

                $response["gstamount"] = round($gst, 2);
                $response["tour_amount"] = round(($totalamount - $gst), 2);
                $response["netamount"] = round($totalamount, 2);
                $amount = round(($getdata["tour_amount"]), 2);

                $totalamount = $personvalue * $amount;

                $gst = $totalamount * 0.18;

                $response["gstamount"] = round($gst, 2);
                $response["tour_amount"] = round(($totalamount - $gst), 2);
                $response["netamount"] = round($totalamount, 2);
                $response["discountamount"] = 0;
            }
        } else {
            $amount = round(($getdata["tour_amount"]), 2);

            $totalamount = $personvalue * $amount;

            $gst = $totalamount * 0.18;

            $response["gstamount"] = round($gst, 2);
            $response["tour_amount"] = round(($totalamount - $gst), 2);
            $response["netamount"] = round($totalamount, 2);
            $response["discountamount"] = 0;
        }



        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "getotp") {
        $content = "";
        $type = $_POST["type"];
        $bookingid = $_POST["bookingid"];
        $personinput = $_POST["personinput"];

        $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");
        $gettourdetails = $tourdetails->fetch_assoc();

        if ($type == "savingstravelpoints") {
            $finsavingstravelpoints = $_POST["savingstravelpoints"];
            $fintype = $type;

            $amount = $personinput * $gettourdetails["tour_amount"];
            $gst = round(($amount * 0.18), 2);
            $amount = round(($amount - $gst), 2);

            $content .= '
            Type&nbsp;:&nbsp;Savings Travel point<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Booking Point&nbsp;:&nbsp;' . $amount . '<br>
            GST(18%)&nbsp;:&nbsp;' . $gst . '<br>
            Net Point:&nbsp;' . $finsavingstravelpoints . '<br>
            Booking Type&nbsp;:&nbsp;International Tour<br>';
        } else if ($type == "bonustravelpoints") {
            $finbonustravelpoints = $_POST["bonustravelpoints"];
            $fintype = $type;

            $amount = $personinput * $gettourdetails["tour_amount"];
            $gst = round(($amount * 0.18), 2);
            $amount = round(($amount - $gst), 2);


            $content .= '
            Type&nbsp;:&nbsp;Bonus Travel point<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Booking Point&nbsp;:&nbsp;' . $amount . '<br>
            GST(18%)&nbsp;:&nbsp;' . $gst . '<br>
            Net Point:&nbsp;' . $finbonustravelpoints . '<br>
            Booking Type&nbsp;:&nbsp;International Tour<br>';
        } else if ($type == "travelcoupon") {
            $fintravelcoupon = $_POST["travelcoupon"];
            $fintype = $type;

            $amount = $personinput * $gettourdetails["tour_amount"];
            $gst = round(($amount * 0.18), 2);
            $amount = round(($amount - $gst), 2);


            $content .= '
            Type&nbsp;:&nbsp;Travel Coupon<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Booking Point&nbsp;:&nbsp;' . $amount . '<br>
            GST(18%)&nbsp;:&nbsp;' . $gst . '<br>
            Net Point:&nbsp;' . $fintravelcoupon . '<br>
            Booking Type&nbsp;:&nbsp;International Tour<br>';
        } else if ($type == "topupwalletpoint") {
            $fintravelcoupon = $_POST["topupwalletpoint"];
            $fintype = $type;

            $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
            $datares = $con->query($datasql);
            $datarow = $datares->fetch_assoc();

            $activationStatus = $datarow["user_referalStatus"];

            if ($activationStatus == "activated") {
                $amount = $personinput * $gettourdetails["tour_amount"];
                $discount = 0.05 * $amount;
                $amount = $amount - $discount;
                $gst = round(($amount * 0.18), 2);
                $amount = round(($amount - $gst), 2);
                $discout = round(($discount), 2);
            } else {
                $amount = $personinput * $gettourdetails["tour_amount"];
                $gst = round(($amount * 0.18), 2);
                $amount = round(($amount - $gst), 2);
                $discout = "Not Applicable";
            }

            $content .= '
            Type&nbsp;:&nbsp;Top-up Wallet<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Booking Point&nbsp;:&nbsp;' . $amount . '<br>
            GST(18%)&nbsp;:&nbsp;' . $gst . '<br>
            Net Point:&nbsp;' . $fintravelcoupon . '<br>
            Discount:&nbsp;' . $discount . '<br>
            Booking Type&nbsp;:&nbsp;International Tour<br>';
        } else if ($type == "allpoints") {
            $finsavingstravelpoints = isset($_POST["savingstravelpoints"]) ? (float) $_POST["savingstravelpoints"] : 0;
            $finbonustravelpoints = isset($_POST["bonustravelpoints"]) ? (float) $_POST["bonustravelpoints"] : 0;
            $fintravelcoupon = isset($_POST["travelcoupon"]) ? (float) $_POST["travelcoupon"] : 0;
            $total = $finsavingstravelpoints + $finbonustravelpoints + $fintravelcoupon;

            $amount = $personinput * $gettourdetails["tour_amount"];
            $gst = round(($amount * 0.18), 2);
            $amount = round(($amount - $gst), 2);

            $content .= '
            Type&nbsp;:&nbsp;All Points<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Savings Travel point&nbsp;:&nbsp;' . htmlspecialchars($finsavingstravelpoints) . '<br>
            Bonus Travel point&nbsp;:&nbsp;' . htmlspecialchars($finbonustravelpoints) . '<br>
            Travel Coupon&nbsp;:&nbsp;' . htmlspecialchars($fintravelcoupon) . '<br>
            Booking Point&nbsp;:&nbsp;' . $amount . '<br>
            GST(18%)&nbsp;:&nbsp;' . $gst . '<br>
            Net Point:&nbsp;' . $total . '<br>
            Booking Type&nbsp;:&nbsp;International Tour<br>';
        }


        $details = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
        $getdetails = $details->fetch_assoc();
        $email = $getdetails["user_email"];
        $name = $getdetails["user_name"];

        $tour = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");

        $gettour = $tour->fetch_assoc();


        $otp = rand(100000, 999999);

        $otp = $con->real_escape_string($otp);
        $userid = $con->real_escape_string($values["userid"]);

        // First, try to update
        $con->query("UPDATE userbankdetails SET otp='$otp' WHERE user_id='$userid'");

        // Now check if the row exists
        $result = $con->query("SELECT * FROM userbankdetails WHERE user_id='$userid'");
        $getUpdateOTP = $result->fetch_assoc();

        // If no row exists, insert a new one
        if (!$getUpdateOTP) {
            $con->query("INSERT INTO userbankdetails (user_id, otp) VALUES ('$userid', '$otp')");
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
            $mail->Subject = 'Tour Booking OTP';
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
                                                        Tour Booking
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div align="start" style="margin-top: 30px;">
                                        <p>Hello ' . $name . ',</p>
                                    </div>
                                    <div align="start">
                                        <p>Did you make a Tour Booking?. If so, please check your details and use OTP for Tour Booking</p>
                                    </div>
                                    <div align="start">
                                        <p><b>Tour Booking Details:</b><br>
                                        Destination&nbsp;&nbsp;:&nbsp;' . $gettour["tour_name"] . '<br>
                                        Booking ID&nbsp;&nbsp;:&nbsp;' . $gettour["tour_bookingcode"] . '<br>
                                           ' . $content . '
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
                                            Let us know if you have issues while paying this applying tour booking or if you have any questions regarding it by emailing us at <a href="mailto:info@uccashtourism.com" style="text-decoration: none;color: black;"><b>info@uccashtourism.com</b></a>
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
    } else if ($way == "tourbooksavingstravelpoints") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

            $teamMemberCount = 0;
            $directTeamIds = [];

            // Loop through levels 1 to 9 to count total team members
            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";
                $result = $con->query("SELECT user_id FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                while ($row = $result->fetch_assoc()) {
                    $teamMemberCount++;

                    // If it's level 1, collect direct team member IDs
                    if ($lvls === 1) {
                        $directTeamIds[] = $row["user_id"];
                    }
                }
            }

            if ($teamMemberCount >= 625 && $directTeamIds >= 5) {

                $personinput = $_POST["personinput"];
                $tourid = $_POST["bookingid"];

                $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
                $gettourdetails = $tourdetails->fetch_assoc();

                $gstamount = ($personinput * $gettourdetails["tour_amount"]) * 0.18;
                $netamount = $personinput * $gettourdetails["tour_amount"];
                $netamount = $netamount - $gstamount;

                $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);


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

                $balance = round(($stcredit - $stdebit), 2);

                if ($balance >= $totalprice) {


                    $date = date('Y-m-d H:i:s');

                    $debit = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_action,st_bonusfrom,st_remark)
                VALUES ('{$values["userid"]}','{$totalprice}','debit','Tour Booking at {$date}','Tour Booking')");

                    $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,gst_amount,net_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Savings Travel Point','{$gstamount}','{$totalprice}','booked')");

                    if ($debit && $history) {

                        $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                        $getuserdetails = $userdetails->fetch_assoc();

                        $name = $getuserdetails["user_name"];
                        $email = $getuserdetails["user_email"];

                        $content = '
                    <p><b>Tour Booking Details:</b><br>
                    Destination&nbsp;:&nbsp;' . $gettourdetails["tour_name"] . '<br>
                    From Date&nbsp;:&nbsp;' . $gettourdetails["tour_fromdate"] . '<br>
                    To Date&nbsp;:&nbsp;' . $gettourdetails["tour_todate"] . '<br>
                    No of Participate&nbsp;:&nbsp;' . $personinput . '<br>
                    Wallet Type&nbsp;:&nbsp;Savings Travel Point<br>
                    Booked Point&nbsp;:&nbsp;' . round(($totalprice - $gstamount), 2) . '<br>
                    GST(18%)&nbsp;:&nbsp;' . round($gstamount, 2) . '<br>
                    Net Point&nbsp;:&nbsp;' . $totalprice . '<br>
                    Booking Type&nbsp;:&nbsp;International Tour<br>
                    </p>';

                        successmail($name, $email, $content);
                    } else {
                        echo $con->error;
                    }
                } else {

                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Insufficient Balance";
                    echo json_encode($response);
                }
            } else {
                // $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "A minimum of 5 direct sponsors and 625 total team members is required.";
                echo json_encode($response);
            }
        } else {

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    } else if ($way == "tourbookbonustravelpoints") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

            $teamMemberCount = 0;
            $directTeamIds = [];

            // Loop through levels 1 to 9 to count total team members
            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";
                $result = $con->query("SELECT user_id FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                while ($row = $result->fetch_assoc()) {
                    $teamMemberCount++;

                    // If it's level 1, collect direct team member IDs
                    if ($lvls === 1) {
                        $directTeamIds[] = $row["user_id"];
                    }
                }
            }

            if ($teamMemberCount >= 625 && $directTeamIds >= 5) {

                $personinput = $_POST["personinput"];
                $tourid = $_POST["bookingid"];

                $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
                $gettourdetails = $tourdetails->fetch_assoc();

                $gstamount = ($personinput * $gettourdetails["tour_amount"]) * 0.18;
                $netamount = $personinput * $gettourdetails["tour_amount"];
                $netamount = $netamount - $gstamount;

                $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);


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

                $balance = round(($btcredit - $btdebit), 2);

                if ($balance >= $totalprice) {


                    $date = date('Y-m-d H:i:s');

                    $debit = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_action,bt_bonusfrom,bt_lvl,bt_remark)
                VALUES ('{$values["userid"]}','{$totalprice}','debit','Tour Booking at {$date}','','Tour Booking')");

                    $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,gst_amount,net_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Bonus Travel Point','{$gstamount}','{$totalprice}','booked')");

                    if ($debit && $history) {

                        $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                        $getuserdetails = $userdetails->fetch_assoc();

                        $name = $getuserdetails["user_name"];
                        $email = $getuserdetails["user_email"];

                        $content = '
                    <p><b>Tour Booking Details:</b><br>
                    Destination&nbsp;:&nbsp;' . $gettourdetails["tour_name"] . '<br>
                    From Date&nbsp;:&nbsp;' . $gettourdetails["tour_fromdate"] . '<br>
                    To Date&nbsp;:&nbsp;' . $gettourdetails["tour_todate"] . '<br>
                    No of Participate&nbsp;:&nbsp;' . $personinput . '<br>
                    Wallet Type&nbsp;:&nbsp;Bonus Travel Point<br>
                    Booked Point&nbsp;:&nbsp;' . round(($totalprice - $gstamount), 2) . '<br>
                    GST(18%)&nbsp;:&nbsp;' . round($gstamount, 2) . '<br>
                    Net Point&nbsp;:&nbsp;' . $totalprice . '<br>
                    Booking Type&nbsp;:&nbsp;International Tour<br>
                    </p>';

                        successmail($name, $email, $content);
                    } else {
                        echo "queryerror";
                    }
                } else {

                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Insufficient Balance";
                    echo json_encode($response);
                }
            } else {
                // $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "A minimum of 5 direct sponsors and 625 total team members is required.";
                echo json_encode($response);
            }
        } else {

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    } else if ($way == "tourbooktravelcoupon") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

            $teamMemberCount = 0;
            $directTeamIds = [];

            // Loop through levels 1 to 9 to count total team members
            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";
                $result = $con->query("SELECT user_id FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                while ($row = $result->fetch_assoc()) {
                    $teamMemberCount++;

                    // If it's level 1, collect direct team member IDs
                    if ($lvls === 1) {
                        $directTeamIds[] = $row["user_id"];
                    }
                }
            }

            if ($teamMemberCount >= 625 && $directTeamIds >= 5) {

                $personinput = $_POST["personinput"];
                $tourid = $_POST["bookingid"];

                $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
                $gettourdetails = $tourdetails->fetch_assoc();

                $gstamount = ($personinput * $gettourdetails["tour_amount"]) * 0.18;
                $netamount = $personinput * $gettourdetails["tour_amount"];
                $netamount = $netamount - $gstamount;

                $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);

                //Travel Coupon's
                $travelcoupon = $con->query("SELECT * FROM travelcouponpoints WHERE user_id='{$values["userid"]}'");
                $tccredit = 0;
                $tcdebit = 0;

                if (mysqli_num_rows($travelcoupon) >= 1) {

                    foreach ($travelcoupon as $gettravelcoupon) {
                        if (isset($gettravelcoupon["tc_action"]) && strlen($gettravelcoupon["tc_action"]) >= 1) {
                            if ($gettravelcoupon["tc_action"] == "credit") {
                                $tccredit += (float) $gettravelcoupon["tc_points"];
                            } else if ($gettravelcoupon["tc_action"] == "debit") {
                                $tcdebit += (float) $gettravelcoupon["tc_points"];
                            }
                        }
                    }
                }

                $balance = round(($tccredit - $tcdebit), 2);

                if ($balance >= $totalprice) {


                    $date = date('Y-m-d H:i:s');

                    $debit = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
                VALUES ('{$values["userid"]}','{$totalprice}','debit','Tour Booking at {$date}')");

                    $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,gst_amount,net_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Travel Coupon','{$gstamount}','$totalprice','booked')");

                    if ($debit && $history) {

                        $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                        $getuserdetails = $userdetails->fetch_assoc();

                        $name = $getuserdetails["user_name"];
                        $email = $getuserdetails["user_email"];

                        $content = '
                    <p><b>Tour Booking Details:</b><br>
                    Destination&nbsp;:&nbsp;' . $gettourdetails["tour_name"] . '<br>
                    From Date&nbsp;:&nbsp;' . $gettourdetails["tour_fromdate"] . '<br>
                    To Date&nbsp;:&nbsp;' . $gettourdetails["tour_todate"] . '<br>
                    No of Participate&nbsp;:&nbsp;' . $personinput . '<br>
                    Wallet Type&nbsp;:&nbsp;Travel Coupon<br>
                    Booked Point&nbsp;:&nbsp;' . round(($totalprice - $gstamount), 2) . '<br>
                    GST(18%)&nbsp;:&nbsp;' . round($gstamount, 2) . '<br>
                    Net Point&nbsp;:&nbsp;' . $totalprice . '<br>
                    Booking Type&nbsp;:&nbsp;International Tour<br>
                    </p>';

                        successmail($name, $email, $content);
                    } else {
                        echo "queryerror";
                    }
                } else {

                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Insufficient Balance";
                    echo json_encode($response);
                }
            } else {
                // $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "A minimum of 5 direct sponsors and 625 total team members is required.";
                echo json_encode($response);
            }
        } else {

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    } else if ($way == "tourbooktopupwallet") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

            $teamMemberCount = 0;
            $directTeamIds = [];

            // Loop through levels 1 to 9 to count total team members
            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";
                $result = $con->query("SELECT user_id FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                while ($row = $result->fetch_assoc()) {
                    $teamMemberCount++;

                    // If it's level 1, collect direct team member IDs
                    if ($lvls === 1) {
                        $directTeamIds[] = $row["user_id"];
                    }
                }
            }

            if ($teamMemberCount >= 625 && $directTeamIds >= 5) {

                $personinput = $_POST["personinput"];
                $tourid = $_POST["bookingid"];

                $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
                $gettourdetails = $tourdetails->fetch_assoc();

                $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
                $datares = $con->query($datasql);
                $datarow = $datares->fetch_assoc();

                $activationStatus = $datarow["user_referalStatus"];

                if ($activationStatus == "activated") {
                    $netamount = $personinput * $gettourdetails["tour_amount"];
                    $discount = 0.05 * $netamount;
                    $netamount = $netamount - $discount;
                    $gstamount = round(($netamount * 0.18), 2);
                    $discout = round(($discount), 2);

                    // $netamount = $personinput * $gettourdetails["tour_amount"];
                    // $gstamount = ($netamount) * 0.18;
                    // $netamount = $netamount - $gstamount;

                    $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);
                } else {
                    $netamount = $personinput * $gettourdetails["tour_amount"];
                    $gstamount = round(($netamount * 0.18), 2);
                    $discout = "Not Applicable";
                    $refAmount = round((0.05 * $netamount), 2);

                    $level1 = $con->query("SELECT * FROM 'genealogy' WHERE user_id='{$datarow["user_id"]}'");
                    $getLevel1 = $level1->fetch_assoc();

                    $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);

                    $insertAvailableBalance = $con->query("INSERT INTO availablewithdrwabalance (user_id,awb_from,awb_to,awb_points,awb_action)
                        VALUES ('{$getLevel1["lvl1"]}','Tour Booking From {$datarow["user_id"]}','Available Withdraw Balance','{$refAmount}','credit')");
                }


                //Topup Wallet
                $travelcoupon = $con->query("SELECT * FROM topup_wallet WHERE user_id='{$datarow["user_id"]}'");
                $tccredit = 0;
                $tcdebit = 0;

                if (mysqli_num_rows($travelcoupon) >= 1) {

                    foreach ($travelcoupon as $gettravelcoupon) {
                        if (isset($gettravelcoupon["tu_action"]) && strlen($gettravelcoupon["tu_action"]) >= 1) {
                            if ($gettravelcoupon["tu_action"] == "credit") {
                                $tccredit += (float) $gettravelcoupon["tu_points"];
                            } else if ($gettravelcoupon["tu_action"] == "debit") {
                                $tcdebit += (float) $gettravelcoupon["tu_points"];
                            }
                        }
                    }
                }

                $balance = round(($tccredit - $tcdebit), 2);

                if ($balance >= $netamount) {


                    $date = date('Y-m-d H:i:s');

                    $debit = $con->query("INSERT INTO topup_wallet (user_id,tu_points,tu_action,tu_bonusfrom,tu_remark)
                VALUES ('{$values["userid"]}','{$netamount}','debit','Tour Booking at {$date}','Successfully Debited')");

                    $debitwallet = $con->query("INSERT INTO topupwallethistory (user_id, deposite_type, crypto_value, txnhash_id, topupwallet_value, action, remark)
                VALUES ('{$values["userid"]}', 'Crypto', '-{$netamount}', '-', '-{$netamount}','paid','Successfully Debited for Tour Booking')");

                    $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,gst_amount,net_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$netamount}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Top-Up Wallet','{$gstamount}','{$netamount}','booked')");

                    if ($debit && $history) {

                        $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                        $getuserdetails = $userdetails->fetch_assoc();

                        $name = $getuserdetails["user_name"];
                        $email = $getuserdetails["user_email"];

                        $content = '
                    <p><b>Tour Booking Details:</b><br>
                    Destination&nbsp;:&nbsp;' . $gettourdetails["tour_name"] . '<br>
                    From Date&nbsp;:&nbsp;' . $gettourdetails["tour_fromdate"] . '<br>
                    To Date&nbsp;:&nbsp;' . $gettourdetails["tour_todate"] . '<br>
                    No of Participate&nbsp;:&nbsp;' . $personinput . '<br>
                    Wallet Type&nbsp;:&nbsp;Topup Wallet<br>
                    Booked Point&nbsp;:&nbsp;' . round(($netamount), 2) . '<br>
                    GST(18%)&nbsp;:&nbsp;' . round($gstamount, 2) . '<br>
                    Net Point&nbsp;:&nbsp;' . $netamount . '<br>
                    Discount&nbsp;:&nbsp;' . $discount . '<br>
                    Booking Type&nbsp;:&nbsp;International Tour<br>
                    </p>';

                        successmail($name, $email, $content);
                    } else {
                        echo "queryerror";
                    }
                } else {

                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Insufficient Balance";
                    echo json_encode($response);
                }
            } else {
                // $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "A minimum of 5 direct sponsors and 625 total team members is required.";
                echo json_encode($response);
            }
        } else {

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    } else if ($way == "tourallpoints") {
        $userotp = $_POST["otp"];

        $otpResult = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otpResult->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

            $teamMemberCount = 0;
            $directTeamIds = [];

            // Loop through levels 1 to 9 to count total team members
            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";
                $result = $con->query("SELECT user_id FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                while ($row = $result->fetch_assoc()) {
                    $teamMemberCount++;

                    // If it's level 1, collect direct team member IDs
                    if ($lvls === 1) {
                        $directTeamIds[] = $row["user_id"];
                    }
                }
            }

            if ($teamMemberCount >= 625 && $directTeamIds >= 5) {

                $personinput = $_POST["personinput"];
                $tourid = $_POST["bookingid"];

                $savingstravelpoints = isset($_POST["savingstravelpoints"]) ? (float) round((float) ($_POST["savingstravelpoints"] ?: 0), 2) : 0;
                $bonustravelpoints = isset($_POST["bonustravelpoints"]) ? (float) round((float) ($_POST["bonustravelpoints"] ?: 0), 2) : 0;
                $travelcouponpoints = isset($_POST["travelcoupon"]) ? (float) round((float) ($_POST["travelcoupon"] ?: 0), 2) : 0;

                // Savings Travel Points
                $savingtravel = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$values["userid"]}'");
                $stcredit = 0;
                $stdebit = 0;

                if ($savingtravel->num_rows >= 1) {
                    while ($getsavingtravel = $savingtravel->fetch_assoc()) {
                        if (isset($getsavingtravel["st_action"])) {
                            if ($getsavingtravel["st_action"] == "credit") {
                                $stcredit += (float) $getsavingtravel["st_points"];
                            } else if ($getsavingtravel["st_action"] == "debit") {
                                $stdebit += (float) $getsavingtravel["st_points"];
                            }
                        }
                    }
                }

                $savingstpbalance = round(($stcredit - $stdebit), 2);

                if ($savingstpbalance >= $savingstravelpoints) {

                    // Bonus Travel Points
                    $bonustravel = $con->query("SELECT * FROM bonustravelpoints WHERE user_id='{$values["userid"]}'");
                    $btcredit = 0;
                    $btdebit = 0;

                    if ($bonustravel->num_rows >= 1) {
                        while ($getbonustravel = $bonustravel->fetch_assoc()) {
                            if (isset($getbonustravel["bt_action"])) {
                                if ($getbonustravel["bt_action"] == "credit") {
                                    $btcredit += (float) $getbonustravel["bt_points"];
                                } else if ($getbonustravel["bt_action"] == "debit") {
                                    $btdebit += (float) $getbonustravel["bt_points"];
                                }
                            }
                        }
                    }

                    $bonustpbalance = round(($btcredit - $btdebit), 2);

                    if ($bonustpbalance >= $bonustravelpoints) {

                        // Travel Coupon Points
                        $travelcoupon = $con->query("SELECT * FROM travelcouponpoints WHERE user_id='{$values["userid"]}'");
                        $tccredit = 0;
                        $tcdebit = 0;

                        if ($travelcoupon->num_rows >= 1) {
                            while ($gettravelcoupon = $travelcoupon->fetch_assoc()) {
                                if (isset($gettravelcoupon["tc_action"])) {
                                    if ($gettravelcoupon["tc_action"] == "credit") {
                                        $tccredit += (float) $gettravelcoupon["tc_points"];
                                    } else if ($gettravelcoupon["tc_action"] == "debit") {
                                        $tcdebit += (float) $gettravelcoupon["tc_points"];
                                    }
                                }
                            }
                        }

                        $travelcouponbalance = round(($tccredit - $tcdebit), 2);

                        if ($travelcouponbalance >= $travelcouponpoints) {

                            $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
                            $gettourdetails = $tourdetails->fetch_assoc();

                            $totalpriceuser = round(($savingstravelpoints + $bonustravelpoints + $travelcouponpoints), 2);

                            $gstamount = ($personinput * $gettourdetails["tour_amount"]) * 0.18;
                            $netamount = $personinput * $gettourdetails["tour_amount"];

                            $totalprice = round(($personinput * $gettourdetails["tour_amount"]), 2);

                            if ($totalprice == $totalpriceuser) {

                                $st = 0;
                                $bt = 0;
                                $tc = 0;

                                $date = date('Y-m-d H:i:s');

                                if ($savingstravelpoints != 0) {
                                    $stdebit = $con->query("INSERT INTO savingstravelpoints (user_id,st_points,st_action,st_bonusfrom,st_remark)
                                VALUES ('{$values["userid"]}','{$savingstravelpoints}','debit','Tour Booking at {$date}','Tour Booking')");
                                    $st = $savingstravelpoints;
                                }

                                if ($bonustravelpoints != 0) {
                                    $btdebit = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_action,bt_bonusfrom,bt_lvl,bt_remark)
                                VALUES ('{$values["userid"]}','{$bonustravelpoints}','debit','Tour Booking at {$date}','','Tour Booking')");
                                    $bt = $bonustravelpoints;
                                }

                                if ($travelcouponpoints != 0) {
                                    $tcdebit = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
                                VALUES ('{$values["userid"]}','{$travelcouponpoints}','debit','Tour Booking at {$date}')");
                                    $tc = $travelcouponpoints;
                                }

                                // Ensure that $st, $bt, and $tc are defined
                                $st = $savingstravelpoints;
                                $bt = $bonustravelpoints;
                                $tc = $travelcouponpoints;

                                // Escape the values to prevent SQL injection
                                $user_id = $con->real_escape_string($values["userid"]);
                                $tour_id = $con->real_escape_string($gettourdetails["id"]);
                                $tour_name = $con->real_escape_string($gettourdetails["tour_name"]);
                                $tour_bookingcode = $con->real_escape_string($gettourdetails["tour_bookingcode"]);
                                $personinput_escaped = $con->real_escape_string($personinput);
                                $tour_amount = $con->real_escape_string($gettourdetails["tour_amount"]);
                                $tour_fromdate = $con->real_escape_string($gettourdetails["tour_fromdate"]);
                                $tour_todate = $con->real_escape_string($gettourdetails["tour_todate"]);
                                $st_escaped = $con->real_escape_string($st);
                                $bt_escaped = $con->real_escape_string($bt);
                                $tc_escaped = $con->real_escape_string($tc);
                                $gstamount_escaped = $con->real_escape_string($gstamount);
                                $totalprice_escaped = $con->real_escape_string($totalprice);

                                // Construct the query
                                $query = "INSERT INTO tourbookinghistory (
                                user_id,
                                booking_id,
                                booking_destination,
                                booking_code,
                                booking_person,
                                booking_amount,
                                booking_fromdate,
                                booking_todate,
                                paymentmethod_description,
                                gst_amount,
                                net_amount,
                                status
                            ) VALUES (
                                '$user_id',
                                '$tour_id',
                                '$tour_name',
                                '$tour_bookingcode',
                                '$personinput_escaped',
                                '$tour_amount',
                                '$tour_fromdate',
                                '$tour_todate',
                                'Savings Travel Point, Bonus Travel Point, Travel Coupon <br> ($st_escaped + $bt_escaped + $tc_escaped)',
                                '$gstamount_escaped',
                                '$totalprice_escaped',
                                'booked'
                            )";

                                // Execute the query
                                $history = $con->query($query);

                                if ($stdebit && $btdebit && $tcdebit && $history) {

                                    $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
                                    $getuserdetails = $userdetails->fetch_assoc();

                                    $name = $getuserdetails["user_name"];
                                    $email = $getuserdetails["user_email"];

                                    $content = '
                                <p><b>Tour Booking Details:</b><br>
                                Destination&nbsp;:&nbsp;' . $gettourdetails["tour_name"] . '<br>
                                From Date&nbsp;:&nbsp;' . $gettourdetails["tour_fromdate"] . '<br>
                                To Date&nbsp;:&nbsp;' . $gettourdetails["tour_todate"] . '<br>
                                No of Participate&nbsp;:&nbsp;' . $personinput . '<br>
                                Wallet Type&nbsp;:&nbsp;All Points<br>
                                Savings Travel Point&nbsp;:&nbsp;' . $st_escaped . '<br>
                                Bonus Travel Point&nbsp;:&nbsp;' . $bt_escaped . '<br>
                                Travel Coupon&nbsp;:&nbsp;' . $tc_escaped . '<br>
                                Booked Point&nbsp;:&nbsp;' . round(($totalprice - $gstamount), 2) . '<br>
                                GST(18%)&nbsp;:&nbsp;' . round($gstamount, 2) . '<br>
                                Net Point&nbsp;:&nbsp;' . $totalprice . '<br>
                                Booking Type&nbsp;:&nbsp;International Tour<br>
                                </p>';

                                    successmail($name, $email, $content);
                                }
                            } else {
                                $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                                $response["status"] = "error";
                                $response["message"] = $totalprice . " " . $totalpriceuser;
                                echo json_encode($response);
                            }
                        } else {
                            $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                            $response["status"] = "error";
                            $response["message"] = "Insufficient Balance at Travel Coupon";
                            echo json_encode($response);
                        }
                    } else {
                        $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                        $response["status"] = "error";
                        $response["message"] = "Insufficient Balance at Bonus Travel point";
                        echo json_encode($response);
                    }
                } else {
                    $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                    $response["status"] = "error";
                    $response["message"] = "Insufficient Balance at Savings Travel point";
                    echo json_encode($response);
                }
            } else {
                // $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                $response["status"] = "error";
                $response["message"] = "A minimum of 5 direct sponsors and 625 total team members is required.";
                echo json_encode($response);
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}


function successmail($name, $email, $content)
{


    $mail = new PHPMailer(true);

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
        $mail->Subject = 'Congratulations Your Booking is Confirmed';
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
                            <div align="center">
                                <img src="https://uccashtourism.com/img/congratulation.png" width="25%"
                                    style="display: block; margin: 0 auto;" alt="Logo">
                            </div>
                            <div align="start">
                                <p>Hi ' . $name . ',</p>
                            </div>
                            <div align="start">
                                <p>Thank you for booking your tour with UCCASH TOURISM. We are excited to reach you.</p>
                            </div>
                            <div align="start">
                                ' . $content . '
                            </div>
                            <div align="start">
                                <p>If you have any question or need to know more details about your booking. Please don\'t hesitate to contact us at <b><a href="tel:+918124779993" style="text-decoration: none;">+91 81247 79993</a></b> or email us at <a href="mailto:support@uccashtourism.com" style="text-decoration: none;">support@uccashtourism.com</a></p>
                            </div>
                            <div align="start">
                                <p>We look forward to welcoming you on the Tour Booked Date!. Have a fantastic experience exploring with us.</p>
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
