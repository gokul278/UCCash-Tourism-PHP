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

            $response["tour_amount"] = round($getdata["tour_amount"], 2);

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

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "checkamount") {
        $personvalue = round(($_POST["person"]), 2);
        $bookingid = $_POST["bookingid"];

        $data = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");
        $getdata = $data->fetch_assoc();

        $amount = round(($getdata["tour_amount"]), 2);

        $totalamount = $personvalue * $amount;

        $response["tour_amount"] = $totalamount;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "getotp") {
        $content = "";
        $type = $_POST["type"];
        $bookingid = $_POST["bookingid"];
        $personinput = $_POST["personinput"];

        if ($type == "savingstravelpoints") {
            $finsavingstravelpoints = $_POST["savingstravelpoints"];
            $fintype = $type;

            $content .= '
            Type&nbsp;:&nbsp;Savings Travel point<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Withdrawal Point&nbsp;:&nbsp;' . $finsavingstravelpoints . '';
        } else if ($type == "bonustravelpoints") {
            $finbonustravelpoints = $_POST["bonustravelpoints"];
            $fintype = $type;

            $content .= '
            Type&nbsp;:&nbsp;Bonus Travel point<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Withdrawal Point&nbsp;:&nbsp;' . $finbonustravelpoints . '';
        } else if ($type == "travelcoupon") {
            $fintravelcoupon = $_POST["travelcoupon"];
            $fintype = $type;

            $content .= '
            Type&nbsp;:&nbsp;Travel Coupon<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Withdrawal Point&nbsp;:&nbsp;' . $fintravelcoupon . '';
        } else if ($type == "allpoints") {
            $finsavingstravelpoints = isset($_POST["savingstravelpoints"]) ? (float) $_POST["savingstravelpoints"] : 0;
            $finbonustravelpoints = isset($_POST["bonustravelpoints"]) ? (float) $_POST["bonustravelpoints"] : 0;
            $fintravelcoupon = isset($_POST["travelcoupon"]) ? (float) $_POST["travelcoupon"] : 0;
            $total = $finsavingstravelpoints + $finbonustravelpoints + $fintravelcoupon;

            $content .= '
            Type&nbsp;:&nbsp;All Points<br>
            Person&nbsp;:&nbsp;' . $personinput . '<br>
            Savings Travel point&nbsp;:&nbsp;' . htmlspecialchars($finsavingstravelpoints) . '<br>
            Bonus Travel point&nbsp;:&nbsp;' . htmlspecialchars($finbonustravelpoints) . '<br>
            Travel Coupon&nbsp;:&nbsp;' . htmlspecialchars($fintravelcoupon) . '<br>
            Total Point&nbsp;:&nbsp;' . round($total, 2) . '';
        }


        $details = $con->query("SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'");
        $getdetails = $details->fetch_assoc();
        $email = $getdetails["user_email"];
        $name = $getdetails["user_name"];

        $tour = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");

        $gettour = $tour->fetch_assoc();


        $otp = rand(100000, 999999);

        $updateotp = $con->query("UPDATE userbankdetails SET otp='{$otp}' WHERE user_id='{$values["userid"]}'");

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
            $mail->setFrom('redana.food@gmail.com', 'UCCASH TOURISM TEAM');
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
                                            Let us know if you have issues while paying this applying tour booking or if you have any questions regarding it by emailing us at <a href="mailto:billing@uccashtourism.com" style="text-decoration: none;color: black;"><b>billing@uccashtourism.com</b></a>
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

    } else if ($way == "tourbooksavingstravelpoints") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {
            $personinput = $_POST["personinput"];
            $tourid = $_POST["bookingid"];

            $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
            $gettourdetails = $tourdetails->fetch_assoc();

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

                $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,payment_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Savings Travel Point','$totalprice','booked')");

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
                    Used Point&nbsp;:&nbsp;' . $totalprice . '
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

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);

        }


    } else if ($way == "tourbookbonustravelpoints") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {
            $personinput = $_POST["personinput"];
            $tourid = $_POST["bookingid"];

            $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
            $gettourdetails = $tourdetails->fetch_assoc();

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

                $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,payment_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Bonus Travel Point','$totalprice','booked')");

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
                    Used Point&nbsp;:&nbsp;' . $totalprice . '
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

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);

        }

    } else if ($way == "tourbooktravelcoupon") {

        $userotp = $_POST["otp"];

        $otp = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otp->fetch_assoc();

        if ($userotp == $getotp["otp"]) {
            $personinput = $_POST["personinput"];
            $tourid = $_POST["bookingid"];

            $tourdetails = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
            $gettourdetails = $tourdetails->fetch_assoc();

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

                $history = $con->query("INSERT INTO tourbookinghistory (user_id,booking_id,booking_destination,booking_code,booking_person,booking_amount,booking_fromdate,booking_todate,paymentmethod_description,payment_amount,status)
                VALUES ('{$values["userid"]}','{$gettourdetails["id"]}','{$gettourdetails["tour_name"]}','{$gettourdetails["tour_bookingcode"]}','{$personinput}','{$gettourdetails["tour_amount"]}','{$gettourdetails["tour_fromdate"]}','{$gettourdetails["tour_todate"]}','Travel Coupon','$totalprice','booked')");

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
                    Used Point&nbsp;:&nbsp;' . $totalprice . '
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

            $response["status"] = "error";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);

        }

    } else if ($way == "tourallpoints") {
        $userotp = $_POST["otp"];

        $otpResult = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$values["userid"]}'");
        $getotp = $otpResult->fetch_assoc();

        if ($userotp == $getotp["otp"]) {

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

                        $totalpriceuser = round($personinput * ($savingstravelpoints + $bonustravelpoints + $travelcouponpoints), 2);
                        $totalprice = round($personinput * $gettourdetails["tour_amount"], 2);

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
                                payment_amount,
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
                                </p>';

                                successmail($name, $email, $content);

                            }

                        } else {
                            $updateotp = $con->query("UPDATE userbankdetails SET otp='' WHERE user_id='{$values["userid"]}'");
                            $response["status"] = "error";
                            $response["message"] = "Invalid TP";
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
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'redana.food@gmail.com';
        $mail->Password = 'zibwucwdyhhzmdan';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('redana.food@gmail.com', 'UCCASH TOURISM TEAM');
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
                            <div align="center">
                                <img src="https://i.ibb.co/VgZx2YC/Congratulations.jpg" width="25%"
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



?>