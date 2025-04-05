<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

require "./vendor/autoload.php";


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

    $datarow = $datares->fetch_assoc();
    $response["user_name"] = $datarow["user_name"];
    $response["user_profileimg"] = $datarow["user_profileimg"];

    $checkpay = $con->query("SELECT * FROM idactivation WHERE user_id='{$values["userid"]}' AND action='admin'");

    if (mysqli_num_rows($checkpay) == 1) {

      $response["action"] = "nopay";

      $response["status"] = "success";
      echo json_encode($response);
    } else {

      $checkpaypaid = $con->query("SELECT * FROM idactivation WHERE user_id='{$values["userid"]}' AND action='paid'");

      if (mysqli_num_rows($checkpaypaid) >= 1) {

        $response["action"] = "notpay";
      } else {

        $response["action"] = "pay";

        $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
        $getaddress = $address->fetch_assoc();

        $response["crypto_image"] = $getaddress["crypto_image"];
        $response["crypto_address"] = $getaddress["crypto_address"];
        $response["crypto_value"] = $getaddress["crypto_value"];
        $response["bankdeposit_image"] = $getaddress["bankdeposit_image"];
        $response["ac_holdername"] = $getaddress["ac_holdername"];
        $response["ac_number"] = $getaddress["ac_number"];
        $response["ifsc_code"] = $getaddress["ifsc_code"];
        $response["branch"] = $getaddress["branch"];
        $response["upi_id"] = $getaddress["upi_id"];
        $response["deposit_value"] = $getaddress["deposit_value"];
        $response["userid"] = $values["userid"];
      }


      $response["status"] = "success";
      echo json_encode($response);
    }
  } else if ($way == "cryptoaddress") {

    $user_id = $_POST["user_id"];
    $crypto_value = $_POST["cryptovalue"];
    $txnhashid = $_POST["txnhashid"];

    $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory");

    $idactivationid = "";

    if (mysqli_num_rows($id) >= 1) {
      $getid = $id->fetch_assoc();
      $idval = (int) $getid["max_id"];
      $idactivationid = "IAI-" . ($idval + 1);
    } else {
      $idactivationid = "IAI-1";
    }




    $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,txnhashid,action) VALUES
        ('{$idactivationid}','{$user_id}','Crypto','{$txnhashid}','admin')");

    $id = $con->query("SELECT MAX(id) AS max_id FROM idactivation WHERE user_id='{$user_id}'");

    $getid = $id->fetch_assoc();

    $tcvalue = $con->query("SELECT * FROM idactivationvalue");
    $gettcvalue = $tcvalue->fetch_assoc();

    $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,crypto_value,txnhash_id,travel_coupon,action,remark) VALUES
        ('{$idactivationid}',  '{$user_id}', 'Crypto', '{$crypto_value}', '{$txnhashid}', '{$gettcvalue["value"]}','admin', 'Waiting for Approval')");

    if ($insertactivationidhistory) {


      //send Mail to Admin

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
        $mail->addAddress('uccashtourism@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'New Monthly Saving\'s Deposite';
        $mail->Body = '
               <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
  </head>

  <body>
    <table
      width="100%"
      cellpadding="0"
      cellspacing="0"
      border="0"
      style="color: black"
    >
      <tr>
        <td align="center" bgcolor="#ffffff">
          <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="center" bgcolor="#000000">
                <div
                  style="
                    width: 100%;
                    max-width: 600px;
                    height: 100px;
                    background-color: black;
                    display: table;
                  "
                >
                  <table
                    width="100%"
                    cellpad
                    ding="0"
                    cellspacing="0"
                    border="0"
                  >
                    <tr>
                      <td align="start" style="width: 60%; height: 100%">
                        <img
                          src="https://uccashtourism.com/img/logo2.png"
                          width="90%"
                          style="display: block; margin: 0 auto"
                          alt="Logo"
                        />
                      </td>
                      <td align="end" style="width: 40%; height: 100%">
                        <p
                          style="
                            color: white;
                            text-align: center;
                            font-size: 120%;
                          "
                        >
                          <b>Let\'s go</b>
                        </p>
                        <p
                          style="
                            color: white;
                            text-align: center;
                            font-size: 120%;
                          "
                        >
                          <b>around the world</b>
                        </p>
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
          <div
            style="
              width: 100%;
              max-width: 600px;
              background-color: white;
              display: table;
            "
          >
            <div style="margin-top: 20px; margin-bottom: 20px">
              <table>
                <tr align="center">
                  <td
                    style="
                      width: 50%;
                      height: 50px;
                      background-color: #f7c128;
                      border-radius: 50px;
                    "
                    align="center"
                  >
                    <a style="text-decoration: none; color: black">
                      ID Activation Deposite
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <div align="start" style="margin-top: 30px">
              <p>Hello Dr. P. Balakrishnnan,</p>
            </div>
            <div align="start">
              <p>You Receive a Mail for New  ID Activation Deposite</p>
            </div>
            <div align="start">
              <p>
                User ID&nbsp;:&nbsp;' . $values["userid"] . '<br />
                Payment Type&nbsp;:&nbsp;Crypto
              </p>
            </div>
            <div align="start" style="margin-top: 40px; margin-bottom: 40px">
              <table>
                <tr align="center">
                  <td
                    style="
                      width: 50%;
                      height: 50px;
                      background-color: #f7c128;
                      border-radius: 50px;
                    "
                  >
                    <a
                      href="https://uccashtourism.com/admin/travel%20coupon%20approval.php"
                      style="text-decoration: none; color: black"
                    >
                      Check Now
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- <div align="start">
              <p>
                Let us know if you have issues while paying this applying
                withdraw or if you have any questions regarding it by emailing
                us at
                <a
                  href="mailto:info@uccashtourism.com"
                  style="text-decoration: none; color: black"
                  ><b>info@uccashtourism.com</b></a
                >
              </p>
            </div> -->
            <div align="start">
              <p>Sincerely,<br />UCCASH Tourism ®</p>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ffffff">
          <div
            style="
              width: 100%;
              max-width: 600px;
              height: 100px;
              background-color: #f7c128;
              display: table;
              padding-bottom: 20px;
            "
          >
            <div>
              <p style="color: white; font-size: 150%"><b>JOIN OUR TEAM</b></p>
            </div>
            <div>
              <p style="color: white; font-size: 100%">
                Check our UCCASH Tourism Blog for new publications
              </p>
            </div>
            <div>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr align="center">
                  <td>
                    <a href="https://www.facebook.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/fb.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://www.instagram.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/instagram.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://www.linkedin.com/in/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/linkedin.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://t.me/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/telegram.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a
                      href="https://whatsapp.com/channel/0029VaNZVU117En3yKTBiu2b"
                      ><img
                        src="https://uccashtourism.com/MailImg/whatsapp.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://x.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/twitterx.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://youtube.com/@UCCASHTOURISM"
                      ><img
                        src="https://uccashtourism.com/MailImg/youtube.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                </tr>
              </table>
            </div>
            <div>
              <p style="color: white; font-size: 100%">
                Click here to share your UCCASH Tourism story, photos, and
                videos with the world!
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 160%">
                <b>UCCASH TOURISM PRIVATE LIMITED</b>
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 105%">
                <b>No-1, 1st Floor, Selvam Complex, Tharamangalam,</b>
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 105%">
                <b>Omalur TK, Salem DT, Tamilnadu, India - 636502</b>
              </p>
            </div>
            <div>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr style="font-size: 100%" align="center">
                  <td style="width: 50%; padding: 0" align="start">
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      style="width: 100%"
                    >
                      <tr>
                        <td align="right" style="padding-right: 5px">
                          <img
                            src="https://uccashtourism.com/MailImg/website.png"
                            width="16"
                            height="16"
                            alt="Logo"
                          />
                        </td>
                        <td align="left">
                          <a
                            style="text-decoration: none; color: black"
                            href="https://uccashtourism.com"
                            >https://uccashtourism.com</a
                          >
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td style="width: 50%; padding: 0" align="start">
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      style="width: 100%"
                    >
                      <tr>
                        <td align="right">
                          <img
                            src="https://uccashtourism.com/MailImg/mail.png"
                            width="16"
                            height="16"
                            alt="Logo"
                          />
                        </td>
                        <td align="right" style="width: 20px">
                          &nbsp;&nbsp;<a
                            style="
                              padding-right: 5px;
                              text-decoration: none;
                              color: black;
                            "
                            href="mailto:info@uccashtourism.com"
                            >info@uccashtourism.com</a
                          >
                        </td>
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
          $response["mailStatus"] = "success";
        }
      } catch (Exception $e) {
        $response["status"] = "error";
        echo json_encode($response);
      }



      $response["status"] = "success";
      echo json_encode($response);
    } else {
      echo "error";
    }
  } else if ($way == "activationbank") {

    $user_id = $_POST["user_id"];
    $depositevalue = $_POST["depositevalue"];
    $transaction_id = $_POST["transaction_id"];

    $proofimage = $_FILES["proofimage"]["name"];
    $timestamp = date("YmdHis");
    $newImageName = $timestamp . '_' . $proofimage;

    if (move_uploaded_file($_FILES["proofimage"]["tmp_name"], "../../img/proofimage/" . $newImageName)) {

      $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory");

      $idactivationid = "";

      if (mysqli_num_rows($id) >= 1) {
        $getid = $id->fetch_assoc();
        $idval = (int) $getid["max_id"];
        $idactivationid = "IAI-" . $idval + 1;
      } else {
        $idactivationid = "IAI-1";
      }


      $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,transaction_id,proof_image,action) VALUES
        ('{$idactivationid}','{$user_id}','Bank','{$transaction_id}','{$newImageName}','admin')");


      $tcvalue = $con->query("SELECT * FROM idactivationvalue");
      $gettcvalue = $tcvalue->fetch_assoc();

      $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,transaction_id,proof_image,bank_value,travel_coupon,action,remark) VALUES
        ('{$idactivationid}',  '{$user_id}', 'Bank', '{$transaction_id}', '{$newImageName}','{$depositevalue}', '{$gettcvalue["value"]}','admin', 'Waiting for Approval')");

      if ($insertactivationidhistory) {


        //send Mail to Admin

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
          $mail->addAddress('uccashtourism@gmail.com');
          $mail->isHTML(true);
          $mail->Subject = 'New Monthly Saving\'s Deposite';
          $mail->Body = '
               <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
  </head>

  <body>
    <table
      width="100%"
      cellpadding="0"
      cellspacing="0"
      border="0"
      style="color: black"
    >
      <tr>
        <td align="center" bgcolor="#ffffff">
          <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="center" bgcolor="#000000">
                <div
                  style="
                    width: 100%;
                    max-width: 600px;
                    height: 100px;
                    background-color: black;
                    display: table;
                  "
                >
                  <table
                    width="100%"
                    cellpad
                    ding="0"
                    cellspacing="0"
                    border="0"
                  >
                    <tr>
                      <td align="start" style="width: 60%; height: 100%">
                        <img
                          src="https://uccashtourism.com/img/logo2.png"
                          width="90%"
                          style="display: block; margin: 0 auto"
                          alt="Logo"
                        />
                      </td>
                      <td align="end" style="width: 40%; height: 100%">
                        <p
                          style="
                            color: white;
                            text-align: center;
                            font-size: 120%;
                          "
                        >
                          <b>Let\'s go</b>
                        </p>
                        <p
                          style="
                            color: white;
                            text-align: center;
                            font-size: 120%;
                          "
                        >
                          <b>around the world</b>
                        </p>
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
          <div
            style="
              width: 100%;
              max-width: 600px;
              background-color: white;
              display: table;
            "
          >
            <div style="margin-top: 20px; margin-bottom: 20px">
              <table>
                <tr align="center">
                  <td
                    style="
                      width: 50%;
                      height: 50px;
                      background-color: #f7c128;
                      border-radius: 50px;
                    "
                    align="center"
                  >
                    <a style="text-decoration: none; color: black">
                      ID Activation Deposite
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <div align="start" style="margin-top: 30px">
              <p>Hello Dr. P. Balakrishnnan,</p>
            </div>
            <div align="start">
              <p>You Receive a Mail for New  ID Activation Deposite</p>
            </div>
            <div align="start">
              <p>
                User ID&nbsp;:&nbsp;' . $values["userid"] . '<br />
                Payment Type&nbsp;:&nbsp;Bank
              </p>
            </div>
            <div align="start" style="margin-top: 40px; margin-bottom: 40px">
              <table>
                <tr align="center">
                  <td
                    style="
                      width: 50%;
                      height: 50px;
                      background-color: #f7c128;
                      border-radius: 50px;
                    "
                  >
                    <a
                      href="https://uccashtourism.com/admin/travel%20coupon%20approval.php"
                      style="text-decoration: none; color: black"
                    >
                      Check Now
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- <div align="start">
              <p>
                Let us know if you have issues while paying this applying
                withdraw or if you have any questions regarding it by emailing
                us at
                <a
                  href="mailto:info@uccashtourism.com"
                  style="text-decoration: none; color: black"
                  ><b>info@uccashtourism.com</b></a
                >
              </p>
            </div> -->
            <div align="start">
              <p>Sincerely,<br />UCCASH Tourism ®</p>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ffffff">
          <div
            style="
              width: 100%;
              max-width: 600px;
              height: 100px;
              background-color: #f7c128;
              display: table;
              padding-bottom: 20px;
            "
          >
            <div>
              <p style="color: white; font-size: 150%"><b>JOIN OUR TEAM</b></p>
            </div>
            <div>
              <p style="color: white; font-size: 100%">
                Check our UCCASH Tourism Blog for new publications
              </p>
            </div>
            <div>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr align="center">
                  <td>
                    <a href="https://www.facebook.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/fb.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://www.instagram.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/instagram.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://www.linkedin.com/in/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/linkedin.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://t.me/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/telegram.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a
                      href="https://whatsapp.com/channel/0029VaNZVU117En3yKTBiu2b"
                      ><img
                        src="https://uccashtourism.com/MailImg/whatsapp.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://x.com/uccashtourism"
                      ><img
                        src="https://uccashtourism.com/MailImg/twitterx.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                  <td>
                    <a href="https://youtube.com/@UCCASHTOURISM"
                      ><img
                        src="https://uccashtourism.com/MailImg/youtube.png"
                        width="50%"
                        style="display: block; margin: 0 auto"
                        alt="Logo"
                    /></a>
                  </td>
                </tr>
              </table>
            </div>
            <div>
              <p style="color: white; font-size: 100%">
                Click here to share your UCCASH Tourism story, photos, and
                videos with the world!
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 160%">
                <b>UCCASH TOURISM PRIVATE LIMITED</b>
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 105%">
                <b>No-1, 1st Floor, Selvam Complex, Tharamangalam,</b>
              </p>
            </div>
            <div>
              <p style="color: white; font-size: 105%">
                <b>Omalur TK, Salem DT, Tamilnadu, India - 636502</b>
              </p>
            </div>
            <div>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr style="font-size: 100%" align="center">
                  <td style="width: 50%; padding: 0" align="start">
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      style="width: 100%"
                    >
                      <tr>
                        <td align="right" style="padding-right: 5px">
                          <img
                            src="https://uccashtourism.com/MailImg/website.png"
                            width="16"
                            height="16"
                            alt="Logo"
                          />
                        </td>
                        <td align="left">
                          <a
                            style="text-decoration: none; color: black"
                            href="https://uccashtourism.com"
                            >https://uccashtourism.com</a
                          >
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td style="width: 50%; padding: 0" align="start">
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      style="width: 100%"
                    >
                      <tr>
                        <td align="right">
                          <img
                            src="https://uccashtourism.com/MailImg/mail.png"
                            width="16"
                            height="16"
                            alt="Logo"
                          />
                        </td>
                        <td align="right" style="width: 20px">
                          &nbsp;&nbsp;<a
                            style="
                              padding-right: 5px;
                              text-decoration: none;
                              color: black;
                            "
                            href="mailto:info@uccashtourism.com"
                            >info@uccashtourism.com</a
                          >
                        </td>
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
            $response["mailStatus"] = "success";
          }
        } catch (Exception $e) {
          $response["status"] = "error";
          echo json_encode($response);
        }


        $response["status"] = "success";
        echo json_encode($response);
      } else {
        echo "error";
      }
    } else {

      echo "error";
    }
  }
} else if ($values["status"] == "auth_failed") {

  $response["status"] = $values["status"];
  $response["message"] = $values["message"];
  echo json_encode($response);
}
