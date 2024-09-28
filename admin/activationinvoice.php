<?php

require ".././requiredFiles/ajax/DBConnection.php";

if (isset($_POST["certificateid"]) && strlen($_POST["certificateid"]) > 1) {

    require '.././UC User/requiredFiles/ajax/TCPDF-main/tcpdf.php';

    $details = $con->query("SELECT * FROM idactivationhistory WHERE idactivation_id = '{$_POST["certificateid"]}'");
    $getdetails = $details->fetch_assoc();

    $dateString = $getdetails["paid_date"];
    $datevalue = new DateTime($dateString);
    $date = $datevalue->format('d/m/Y');

    $user = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdetails["user_id"]}'");
    $getuser = $user->fetch_assoc();

    $userid = $getuser["user_id"];
    $username = $getuser["user_name"];
    $email = $getuser["user_email"];
    $phoneno = $getuser["user_phoneno"];


    $invoiceid = $_POST["certificateid"];
    $invoicedate = date("d-m-Y", strtotime($getdetails["paid_date"]));

    if ($getdetails["deposite_type"] == 'Crypto') {

        $netAmount = 0;
        $gstAmount = 0;
        $gst = 0;

        if ($getdetails["crypto_value"] == '$ 59') {
            $netAmount = '50 USDT';
            $gstAmount = '9 USDT';
            $totalAmount = '59 USDT';
            $gst = '18%';
        } else if ($getdetails["crypto_value"] == '$ 52.5') {
            $netAmount = '50 USDT';
            $gstAmount = '2.5 USDT';
            $totalAmount = '52.5 USDT';
            $gst = '5%';
        }



        $content = ' <tr>
            <td style="width:100%;font-size:14px;">
                <table style="width:99%">
                        <tr align="center">
                            <td style="background-color:#011B3B;color:white">Invoice No</td>
                            <td style="background-color:#011B3B;color:white">Activation Date</td>
                            <td style="background-color:#011B3B;color:white">Travel Coupoon</td>
                            <td style="background-color:#011B3B;color:white">Activation Amount</td>
                        </tr>
                        <tr align="center">
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoiceid . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoicedate . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>50 TC</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $netAmount . '</b></td>
                        </tr>
                        <tr align="center">
                            <td style="width:75%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;">
                                <table style="margin: 0; padding: 0;">
                                    <tr>
                                        <td style="width:65%"></td>
                                        <td style="color:#6F6F6F;font-size:15px;"><b>GST ' . $gst . ':</b></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:25%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;"><b>' . $gstAmount . '</b></td>
                        </tr>
                        <tr align="center">
                            <td style="width:75%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;">
                                <table style="margin: 0; padding: 0;">
                                    <tr>
                                        <td style="width:65%"></td>
                                        <td style="color:#6F6F6F;font-size:15px;"><b>Total:</b></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:25%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;"><b>' . $totalAmount . '</b></td>
                        </tr>
                </table>
            </td>
        </tr>';
    } else if ($getdetails["deposite_type"] == 'Bank') {

        $netAmount = 0;
        $gstAmount = 0;
        $gst = 0;

        if ($getdetails["bank_value"] == 'Rs 5310') {
            $netAmount = ' Rs 4500';
            $gstAmount = 'Rs 810';
            $totalAmount = 'Rs 5310';
            $gst = '18%';
        } else if ($getdetails["bank_value"] == 'Rs 4999') {
            $netAmount = ' Rs 4760.95';
            $gstAmount = 'Rs 238.05';
            $totalAmount = 'Rs 4999';
            $gst = '5%';
        }

        $content = ' <tr>
        <td style="width:100%;font-size:14px;">
            <table style="width:99%">
                    <tr align="center">
                        <td style="background-color:#011B3B;color:white">Invoice No</td>
                        <td style="background-color:#011B3B;color:white">Activation Date</td>
                        <td style="background-color:#011B3B;color:white">Travel Coupoon</td>
                        <td style="background-color:#011B3B;color:white">Activation Amount</td>
                    </tr>
                    <tr align="center">
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoiceid . '</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoicedate . '</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>50 TC</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $netAmount . '</b></td>
                    </tr>
                    <tr align="center">
                        <td style="width:75%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;">
                            <table style="margin: 0; padding: 0;">
                                <tr>
                                    <td style="width:65%"></td>
                                    <td style="color:#6F6F6F;font-size:15px;"><b>GST ' . $gst . ':</b></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:25%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;"><b>' . $gstAmount . '</b></td>
                    </tr>
                    <tr align="center">
                        <td style="width:75%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;">
                            <table style="margin: 0; padding: 0;">
                                <tr>
                                    <td style="width:65%"></td>
                                    <td style="color:#6F6F6F;font-size:15px;"><b>Total:</b></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:25%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;"><b>' . $totalAmount . '</b></td>
                    </tr>
            </table>
        </td>
    </tr>';
    } else if ($getdetails["deposite_type"] == 'Wallet') {
        $content = ' <tr>
        <td style="width:100%;font-size:14px;">
            <table style="width:99%">
                    <tr align="center">
                        <td style="background-color:#011B3B;color:white">Invoice No</td>
                        <td style="background-color:#011B3B;color:white">Activation Date</td>
                        <td style="background-color:#011B3B;color:white">Travel Coupoon</td>
                        <td style="background-color:#011B3B;color:white">Activation Amount</td>
                    </tr>
                    <tr align="center">
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoiceid . '</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoicedate . '</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>50 TC</b></td>
                        <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>50 points</b></td>
                    </tr>
                    <tr align="center">
                        <td style="width:75%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;">
                            <table style="margin: 0; padding: 0;">
                                <tr>
                                    <td style="width:65%"></td>
                                    <td style="color:#6F6F6F;font-size:15px;"><b>Total:</b></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:25%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:15px;"><b>50 Points</b></td>
                    </tr>
                    <tr><td></td></tr>
            </table>
        </td>
    </tr>';
    }

    $pdf = new TCPDF();

    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false); // Disable auto page breaks

    $pdf->SetTitle('UCCASH TOURIST ACTIVATION INVOICE');

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    $pdf->AddPage();

    $html = '    
    <table align="center" style="margin: 0; padding: 0;"> 
        <tr>
            <td><img src="../UC User/requiredFiles/ajax/img/ActivationInvoice-Top.jpg"/></td>
        </tr>
        <tr>
            <td style="width:3%"></td>
            <td style="width:67%">
            <div style="font-size:13px;color:#6F6F6F;border: 2px solid #F5BF26;width:100%; padding: 0; margin: 0;">
            <table align="center" style="width:100%; margin: 0;"> 
                <tr><td></td></tr>
                <tr>
                    <td style="width:2%"></td>
                    <td style="width:30%" align="start"><b>User ID</b></td>
                    <td style="width:68%" align="start"><b>:</b> ' . $userid . '</td>
                </tr>
                <tr>
                    <td style="width:2%"></td>
                    <td style="width:30%" align="start"><b>User Name</b></td>
                    <td style="width:68%" align="start"><b>:</b> ' . $username . '</td>
                </tr>
                <tr>
                    <td style="width:2%"></td>
                    <td style="width:30%" align="start"><b>Email ID</b></td>
                    <td style="width:68%" align="start"><b>:</b> ' . $email . '</td>
                </tr>
                <tr>
                    <td style="width:2%"></td>
                    <td style="width:30%" align="start"><b>Contact No</b></td>
                    <td style="width:68%" align="start"><b>:</b> ' . $phoneno . '</td>
                </tr>
            </table>
        </div>
            </td>
            <td style="width:30%">
                <div style="font-size:13px;color:#6F6F6F;"><b>Date: ' . date('d/m/Y') . '</b></div>
            </td>
        </tr>
        <tr><td></td></tr>
        ' . $content . '   
        <br/>
        <tr>
            <td><img src="../UC User/requiredFiles/ajax/img/ActivationInvoice-bottom.jpg"/></td>
        </tr>
        <tr style="background-color:#F5BF26;font-size:13px" align="start">
            <td><div><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Copyright © UCCASH Tourism - ' . date('Y') . '. All Rights Reserved.<br></b></div></td>
        </tr>        
    </table>
    
    ';

    $pdf->writeHTML($html);

    $pdf->Output('Invoice NO_' . $_POST["certificateid"] . '.pdf');
    exit;
}
