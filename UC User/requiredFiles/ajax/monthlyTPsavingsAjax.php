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


    $invoice_id = $_POST["invoice_id"];

    $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
    $datares = $con->query($datasql);

    if (mysqli_num_rows($datares) > 0) {

      $datarow = $datares->fetch_assoc();

      $response["user_name"] = $datarow["user_name"];
      $response["user_profileimg"] = $datarow["user_profileimg"];


      $checkinvoice_id = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoice_id}' AND user_id='{$values["userid"]}'");

      if (mysqli_num_rows($checkinvoice_id) == 1) {

        $getinvoicedata = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE user_id='{$values["userid"]}' ORDER BY id DESC LIMIT 3");

        foreach ($getinvoicedata as $row) {
          if ($row["invoice_id"] == $invoice_id) {

            if ($row["action"] == "pending") {
              $date = $row["created_at"];
              $dateTime = new DateTime($date);
              $formattedDate = $dateTime->format('Y-m-d');

              $getMonthlyInvoice = $con->query("SELECT * FROM monthlysavings");
              $resMonthlyInvoice = $getMonthlyInvoice->fetch_assoc();

              $response["crypto_image"] = $resMonthlyInvoice["crypto_image"];
              $response["crypto_address"] = $resMonthlyInvoice["crypto_address"];

              // Convert string to float before performing calculations
              $totaltp_value = floatval($row["totaltp_value"]);
              $bonustp_value = floatval($row["bonustp_value"]);
              $ucc_value = floatval($resMonthlyInvoice["ucc_value"]);
              $deposite_value = floatval($resMonthlyInvoice["deposit_value"]);

              $response["ucc_value"] = round(($totaltp_value - $bonustp_value) / $ucc_value, 2);
              $response["bankdeposit_image"] = $resMonthlyInvoice["bankdeposit_image"];
              $response["ac_holdername"] = $resMonthlyInvoice["ac_holdername"];
              $response["ac_number"] = intval($resMonthlyInvoice["ac_number"]); // Convert account number to integer
              $response["ifsc_code"] = $resMonthlyInvoice["ifsc_code"];
              $response["branch"] = $resMonthlyInvoice["branch"];
              $response["upi_id"] = $resMonthlyInvoice["upi_id"];

              $response["deposit_value"] = round(($totaltp_value - $bonustp_value) * $deposite_value, 2);


              // $getuccvalue = $con->query("SELECT * FROM uccvalue WHERE id=1");
              // $resgetuccvalue = $getuccvalue->fetch_assoc();

              $response["invoice_id"] = $invoice_id;
              $response["created_at"] = $formattedDate;
              // $response["deposite_value"] = round(($row["totaltp_value"] - $row["bonustp_value"]) / $resgetuccvalue["value"],2);
              $response["status"] = "success";
            } else if ($row["action"] == "admin") {
              $response["status"] = "error";
              $response["message"] = "Waiting For Approval";
            } else if ($row["action"] == "paid") {
              $response["status"] = "error";
              $response["message"] = "You Already Paid the Invoice";
            }

            break;
          } else {
            $response["status"] = "error";
            $response["message"] = "Expired Invoice ID";
          }
        }
      } else {
        $response["status"] = "error";
        $response["message"] = "Invalid Invoice ID";
      }


      echo json_encode($response);
    } else {
      $response["status"] = "error";
      $response["message"] = "Invalid Invoice ID";
      echo json_encode($response);
    }
  } else if ($way == "cryptosubmithashid") {

    $uccvalue = $_POST["uccvalue"];
    $txnhashid = $_POST["txnhashid"];
    $invoiceidval = $_POST["invoiceidval"];

    $checkinvoice_id = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}' AND user_id='{$values["userid"]}'");

    if (mysqli_num_rows($checkinvoice_id) == 1) {

      $updatestatussql = "UPDATE monthlysavingpendinginvoice SET action = 'admin' WHERE invoice_id='{$invoiceidval}' ";
      $updatestatusres = $con->query($updatestatussql);

      $getselectsql = "SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}'";
      $getselectres = $con->query($getselectsql);

      $getselectrow = $getselectres->fetch_assoc();

      $insertinvoicehistorysql = "INSERT INTO monthlytpsavinghistory (user_id, invoice_id,invoice_date, txn_hashid, payment_type, amount, tp_value, bonus_tp, credit_tp, balance_tp, action)
        VALUES ('{$values["userid"]}', '{$getselectrow["invoice_id"]}', '{$getselectrow["created_at"]}', '{$txnhashid}', 'To Crypto', '{$uccvalue}', '{$getselectrow["saving_value"]}', '{$getselectrow["bonustp_value"]}', '{$getselectrow["totaltp_value"]}', '', 'admin')";
      $insertinvoicehistoryres = $con->query($insertinvoicehistorysql);


      //Send Mail
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
                      Monthly Saving\'s Deposite
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <div align="start" style="margin-top: 30px">
              <p>Hello Dr. P. Balakrishnnan,</p>
            </div>
            <div align="start">
              <p>You Receive a Mail for New Monthly Saving\'s Deposite</p>
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
                      href="https://uccashtourism.com/admin/monthly%20tp%20savings.php"
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


      if ($insertinvoicehistoryres) {

        $response["status"] = "success";
        echo json_encode($response);
      } else {

        $response["status"] = $con->error;
        echo json_encode($response);
      }
    }
  } else if ($way == "activationbank") {

    $uccvalue = $_POST["uccvalue"];
    $txnhashid = $_POST["txnhashid"];
    $invoiceidval = $_POST["invoiceidval"];

    $checkinvoice_id = $con->query("SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}' AND user_id='{$values["userid"]}'");

    if (mysqli_num_rows($checkinvoice_id) == 1) {

      $updatestatussql = "UPDATE monthlysavingpendinginvoice SET action = 'admin' WHERE invoice_id='{$invoiceidval}' ";
      $updatestatusres = $con->query($updatestatussql);

      $getselectsql = "SELECT * FROM monthlysavingpendinginvoice WHERE invoice_id='{$invoiceidval}'";
      $getselectres = $con->query($getselectsql);

      $getselectrow = $getselectres->fetch_assoc();

      $proofimage = $_FILES["proofimage"]["name"];
      $timestamp = date("YmdHis");
      $newImageName = $timestamp . '_' . $proofimage;

      if (move_uploaded_file($_FILES["proofimage"]["tmp_name"], "../../img/proofimage/" . $newImageName)) {

        $insertinvoicehistorysql = "INSERT INTO monthlytpsavinghistory (user_id, invoice_id,invoice_date, txn_hashid, payment_type, amount, tp_value, bonus_tp, credit_tp, balance_tp, action, proof_image)
                VALUES ('{$values["userid"]}', '{$getselectrow["invoice_id"]}', '{$getselectrow["created_at"]}', '{$txnhashid}', 'To Bank', '{$uccvalue}', '{$getselectrow["saving_value"]}', '{$getselectrow["bonustp_value"]}', '{$getselectrow["totaltp_value"]}', '', 'admin', '{$newImageName}')";
        $insertinvoicehistoryres = $con->query($insertinvoicehistorysql);

        //Send Mail
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
                      Monthly Saving\'s Deposite
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <div align="start" style="margin-top: 30px">
              <p>Hello Dr. P. Balakrishnnan,</p>
            </div>
            <div align="start">
              <p>You Receive a Mail for New Monthly Saving\'s Deposite</p>
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
                      href="https://uccashtourism.com/admin/monthly%20tp%20savings.php"
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



        if ($insertinvoicehistoryres) {

          $response["status"] = "success";
          echo json_encode($response);
        } else {

          $response["status"] = $con->error;
          echo json_encode($response);
        }
      } else {

        $response["status"] = $con->error;
        echo json_encode($response);
      }
    }
  }
} else if ($values["status"] == "auth_failed") {

  $response["status"] = $values["status"];
  $response["message"] = $values["message"];
  echo json_encode($response);
}
