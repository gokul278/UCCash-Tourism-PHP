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

if ($way == "checksponser") {

    // Checking the Sponser ID - start

    $sponser_id = $_POST["sponserid"];

    $sql = "SELECT * FROM userdetails WHERE user_id = '{$sponser_id}'";

    $res = $con->query($sql);

    if (mysqli_num_rows($res) == 1) {

        //Checking the Sponser ID

        $row = $res->fetch_assoc();
        $response["status"] = "success";
        $response["message"] = $row["user_name"];

    } else {

        $response["status"] = "failed";
        $response["message"] = "Invalid Sponser ID";

    }

    echo json_encode($response);

    // Checking the Sponser ID - start
} else if ($way == "mailidcheck") {

    $email = $_POST["email"];

    $emailquery = $con->query("SELECT * FROM userdetails WHERE user_email='{$email}'");

    if(mysqli_num_rows($emailquery)>=1){

        $response["status"] = "failed";
        $response["message"] = "Email Already Registered";
        
    }else{
        
        $response["status"] = "success";
        $response["message"] = "Email Available";

    }

    echo json_encode($response);

}else if ($way == "otpsend") {

    // Mail for Registeration OTP

    $postemail = $_POST['email'];
    $generatedOTP = rand(100000, 999999);

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
        $mail->Subject = 'E-Mail Verification Code for Registeration';
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
                                                    <img src="https://i.ibb.co/TwMTf3t/logo2.png" width="90%" style="display: block; margin: 0 auto;" alt="Logo">
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
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:90px"> 
                                <tr>
                                    <td align="center" style="width: 60%; height: 100%;">
                                        <p style="color: black; text-align: center;font-size:160%"><b>Welcome to</b></p>
                                        <p style="color: black; text-align: center;font-size:160%"><b>UCCASH TOURISM</b></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="width: 60%; height: 100%;">
                                        <p style="color: black; text-align: center;font-size:120%">Verification code for Registeration</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="width: 60%; height: 100%;">
                                        <div style="color: black; text-align: center;font-size:120%">Your Verfication Code : <span style="background-color:yellow;color: black;padding:5px;border-radius:5px">' . $generatedOTP . '</span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="width: 60%; height: 100%;">
                                    <p style="color: black; text-align: center;font-size:120%">Please don\'t share with anyone</p>
                                    </td>
                                </tr>
                            </table>
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
            //Success Message
            $response["status"] = "success";
            file_put_contents('email.txt', $postemail);
            file_put_contents('otp.txt', $generatedOTP);
            echo json_encode($response);
        }

    } catch (Exception $e) {
        //Error Message
        $response["status"] = "error";
        echo json_encode($response);
    }


} else if ($way == "newsignup") {

    //New Account SignUp

    $userEnteredOTP = $_POST["otp"];
    $savedOTP = file_get_contents('otp.txt'); //getting Already Registered OTP
    $userEnteredEmail = $_POST["email"];
    $savedEmail = file_get_contents('email.txt'); //getting Already Registered Mail


    if ($savedEmail == $userEnteredEmail) { // Email Verification - Success

        if ($userEnteredOTP == $savedOTP) { // OTP Verification - Success

            //Checking the Already Exitsing Email

            $checkemailsql = "SELECT * FROM userdetails WHERE user_email = '{$savedEmail}' ";
            $checkemailres = $con->query($checkemailsql);

            if (mysqli_num_rows($checkemailres) >= 1) {

                $response["status"] = "failed";
                $response["message"] = "Email Already Exits";
                echo json_encode($response);

            } else {

                //Checking the Already Exitsing Phone Number

                $phoneno = $_POST["phoneno"];

                $checkphonenosql = "SELECT * FROM userdetails WHERE user_phoneno = '{$phoneno}'";
                $checkphonenores = $con->query($checkphonenosql);

                if (mysqli_num_rows($checkphonenores) >= 1) {

                    $response["status"] = "failed";
                    $response["message"] = "Phone Number Already Exits";
                    echo json_encode($response);

                } else {

                    //Checking the Sponser ID it should be in Activation status

                    $sponserid = $_POST["sponserid"];

                    $checksponseridsql = "SELECT * FROM userdetails WHERE user_id = '{$sponserid}'";
                    $checksponseridres = $con->query($checksponseridsql);

                    if (mysqli_num_rows($checksponseridres) == 1) {

                        $name = $_POST["name"];
                        $address = $_POST["address"];
                        $city = $_POST["city"];
                        $zipcode = $_POST["zipcode"];
                        $country = $_POST["country"];
                        $state = $_POST["state"];
                        $password = md5($_POST["password"]);


                        $maxid = $con->query("SELECT MAX(id) as max_id FROM userdetails");
                        $getmaxid = $maxid->fetch_assoc();

                        $newmax_id = (int) $getmaxid['max_id']; // Accessing the max_id from the associative array and casting it to integer
                        $id = 1000 + $newmax_id;

                        $user_id = "UCT" . $id;

                        //Creating the User ID

                        $signupsql = "INSERT INTO userdetails (user_id,user_password, user_name, user_email, user_phoneno, user_address, user_city, user_zipcode, user_state, user_country, user_sponserid, user_referalStatus) VALUES
                        ('{$user_id}','{$password}','{$name}','{$savedEmail}','{$phoneno}','{$address}','{$city}','{$zipcode}','{$state}','{$country}','{$sponserid}','notactivated')";

                        $signupres = $con->query($signupsql);

                        if ($signupres) {

                            //Sending the Congratulation Mail

                            $getuseridsql = "SELECT * FROM userdetails WHERE user_email = '{$savedEmail}'";
                            $getuserres = $con->query($getuseridsql);

                            $getuserrow = $getuserres->fetch_assoc();

                            $invoiceid = $con->query("SELECT MAX(id) as id FROM monthlysavingpendinginvoice");

                            if (mysqli_num_rows($invoiceid) >= 1) {

                                $getinvoiceid = $invoiceid->fetch_assoc();
                                $id = (int) $getinvoiceid["id"] + 1;
                                $invoiceid = "MSI-" . $id;

                            } else {
                                $invoiceid = "MSI-1";
                            }

                            $insertpendinginvoicesql = "INSERT INTO  monthlysavingpendinginvoice (invoice_id, user_id, saving_value, bonustp_value, totaltp_value, action,remark)
                            VALUES ('$invoiceid','{$getuserrow["user_id"]}','50$','5','55','pending','')";
                            $insertpendinginvoiceres = $con->query($insertpendinginvoicesql);

                            $checkinvoice = "SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$getuserrow["user_id"]}'";
                            $checkinvoiceres = $con->query($checkinvoice);
                            $getinvoice = $checkinvoiceres->fetch_assoc();


                            $lvl1 = $sponserid;
                            $lvl2 = "";
                            $lvl3 = "";
                            $lvl4 = "";
                            $lvl5 = "";
                            $lvl6 = "";
                            $lvl7 = "";
                            $lvl8 = "";
                            $lvl9 = "";

                            $genealogy = $con->query("SELECT * FROM genealogy WHERE user_id='{$lvl1}'");

                            if (mysqli_num_rows($genealogy) >= 1) {

                                $getgenealogy = $genealogy->fetch_assoc();
                                $lvl2 = isset($getgenealogy["lvl1"]) ? $getgenealogy["lvl1"] : "";
                                $lvl3 = isset($getgenealogy["lvl2"]) ? $getgenealogy["lvl2"] : "";
                                $lvl4 = isset($getgenealogy["lvl3"]) ? $getgenealogy["lvl3"] : "";
                                $lvl5 = isset($getgenealogy["lvl4"]) ? $getgenealogy["lvl4"] : "";
                                $lvl6 = isset($getgenealogy["lvl5"]) ? $getgenealogy["lvl5"] : "";
                                $lvl7 = isset($getgenealogy["lvl6"]) ? $getgenealogy["lvl6"] : "";
                                $lvl8 = isset($getgenealogy["lvl7"]) ? $getgenealogy["lvl7"] : "";
                                $lvl9 = isset($getgenealogy["lvl8"]) ? $getgenealogy["lvl8"] : "";

                                $insertgenealogy = $con->query("INSERT INTO genealogy (user_id,lvl1,lvl2,lvl3,lvl4,lvl5,lvl6,lvl7,lvl8,lvl9)
                                VALUES ('{$user_id}','{$lvl1}','{$lvl2}','{$lvl3}','{$lvl4}','{$lvl5}','{$lvl6}','{$lvl7}','{$lvl8}','{$lvl9}')");

                            } else {
                                $insertgenealogy = $con->query("INSERT INTO genealogy (user_id,lvl1) VALUES ('{$user_id}','{$lvl1}')");
                            }



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
                                $mail->addAddress($savedEmail);
                                $mail->isHTML(true);
                                $mail->Subject = 'Welcome to UCCASH TOURISM';
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
                                                        <p>I would like to personally welcome you to UCCASH Tourism.</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>Member Id : ' . $getuserrow["user_id"] . '<br>Password : ' . $_POST["password"] . '</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>Wish you all the best for your bright future</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>We hope to be able to welcome you onboard soon as a UCCASH Tourism Active Distributor.</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>A UCCASH Tourism Distributorship to make unlimited earning opportunity in order to Distributorship earn by referring others and building their Active Team.</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>So make the decision now to become a Active Distributor, if you haven\'t already, by clicking the upgrade button below:</p>
                                                    </div>
                                                    <div style="margin-top: 40px;margin-bottom: 40px;">
                                                        <table>
                                                            <tr align="center">
                                                                <td style="width: 40%;height: 50px;background-color: #F7C128;border-radius: 50px;">
                                                                    <a href="http://localhost/UC-Tour/UC%20User/id%20activation.html" style="text-decoration: none;color: black;">
                                                                        Join as Active Distributor
                                                                    </a>
                                                                </td>
                                                                <td style="width: 10%;">  </td>
                                                                <td style="width: 40%;height: 50px;background-color: #F7C128;border-radius: 50px;">
                                                                    <a href="http://localhost/UC-Tour/UC%20User/monthly%20savings%20pending%20invoice.html" style="text-decoration: none;color: black;">
                                                                        Pay Your Monthly Savings    
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div align="start">
                                                        <p>If you have any questions please contact our Support Team at <a href="mailto:support@uccashtourism.com" style="text-decoration: none;">support@uccashtourism.com</a></p>
                                                    </div>
                                                    <div align="start">
                                                        <p>With gratitude,</p>
                                                    </div>
                                                    <div align="start">
                                                        <p>Dr.P.Balakrishnan<br>CEO, Founder of UCCASH</p>
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
                                        $mail->addAddress($savedEmail);
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
                                                                <p>Hello, ' . $getuserrow["user_name"] . ',</p>
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
                                                                    Invoice Number&nbsp;:&nbsp;' . $getinvoice["invoice_id"] . '<br>
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

                            } catch (Exception $e) {
                                $response["status"] = "failed";
                                echo json_encode($response);
                            }

                        } else {

                            $response["status"] = "failed";
                            $response["message"] = $con->error;
                            echo json_encode($response);

                        }

                    } else {

                        $response["status"] = "failed";
                        $response["message"] = "Enter Valid Sponser ID";
                        echo json_encode($response);

                    }

                }

            }


        } else {  // OTP Verification - failed
            $response["status"] = "failed";
            $response["message"] = "Invalid OTP";
            echo json_encode($response);
        }
    } else { // Email Verification - failed
        $response["status"] = "failed";
        $response["message"] = "Generate New OTP";
        echo json_encode($response);
    }



} else {
    $response["message"] = "failed";
    echo json_encode($response);
}

return 0;
?>