<?php

require "../../../requiredFiles/ajax/DBConnection.php";

$way = "invoiceprint";

if ($way == "invoiceprint") {

    require './TCPDF-main/tcpdf.php';

    $userid = $_GET["userid"];
    $username = $_GET["username"];
    $email = $_GET["emailid"];
    $phoneno = $_GET["phoneno"];
    $invoiceid = $_GET["invoiceid"];
    $invoicedate = $_GET["invoicedate"];
    $paiddate = $_GET["paiddate"];

    $pdf = new TCPDF();

    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false); // Disable auto page breaks

    $pdf->SetTitle('UCCASH TOURIST SAVINGS INVOICE');

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    $pdf->AddPage();

    $html = '    
    <table align="center" style="margin: 0; padding: 0;"> 
        <tr>
            <td><img src="./img/InvoiceTop.jpg"/></td>
        </tr>
        <tr>
            <td style="width:40%"></td>
            <td style="font-size:25px;color:#6F6F6F;width:60%;" align="start"><b>Bill To:</b></td>
        </tr>
        <tr>
            <td style="width:36%"></td>
            <td style="width:60%;" align="start">
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
                            <td style="width:68%" align="start"><b>:</b> +' . $phoneno . '</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width:2%"></td>
            <td style="width:98%;color:#6F6F6F;font-size:16px" align="start">Date: '. date("d-m-Y").'</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width:100%;font-size:14px;">
                <table style="width:99%">
                        <tr align="center">
                            <td style="background-color:#011B3B;color:white">Invoice No</td>
                            <td style="background-color:#011B3B;color:white">Invoice Date</td>
                            <td style="background-color:#011B3B;color:white">Paid Date</td>
                            <td style="background-color:#011B3B;color:white">Status</td>
                            <td style="background-color:#011B3B;color:white">Savings TP</td>
                            <td style="background-color:#011B3B;color:white">Savings Amount</td>
                        </tr>
                        <tr align="center">
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoiceid . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $invoicedate . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>' . $paiddate . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>Paid</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b>55 TP</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;font-size:19px;"><b>50 $</b></td>
                        </tr>
                        <tr align="center">
                            <td style="width:83.35%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:20px;">
                                <table style="margin: 0; padding: 0;">
                                    <tr>
                                        <td style="width:65%"></td>
                                        <td style="color:#6F6F6F;font-size:20px;"><b>Total:</b></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:16.65%;color:#6F6F6F;border: 1px solid #6F6F6F;font-size:20px;"><b>50 $</b></td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><img src="./img/InvoiceBottom.jpg"></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr style="background-color:#F5BF26;font-size:13px" align="start">
            <td><div><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Copyright © UCCASH Tourism - '.date('Y').'. All Rights Reserved.<br></b></div></td>
        </tr>
    </table>
    
    ';

    $pdf->writeHTML($html);

    $pdf->Output('Invoice NO_' . $invoiceid .'.pdf');
    exit;
}
?>