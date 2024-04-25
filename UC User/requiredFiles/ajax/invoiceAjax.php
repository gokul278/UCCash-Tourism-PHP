<?php

require "../../../requiredFiles/ajax/DBConnection.php";

$way = "invoiceprint";

if ($way == "invoiceprint") {

    require './TCPDF-main/tcpdf.php';

    $id = '';
    $name = '';
    $address = '';
    $panno = '';
    $date='';
    $cost = '';

    $pdf = new TCPDF();

    $pdf->SetTitle('UCCASH TOURIST SAVINGS INVOICE');

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 16);

    // Set cell border to 0
    $pdf->SetCellPadding(0);
    $pdf->SetLineWidth(0);

    $html = '
    <div style="width:100%">
    <img src="./img/InvoiceTop.jpg">
    </div>
    <table align="center" cellpadding="5"> 
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div style="width:100%">
    <img src="./img/InvoiceBottom.jpg">
    </div>
    ';

    $pdf->writeHTML($html);

    $pdf->Output('UCCASH TOURIST SAVINGS INVOICE - ' . $name . '.pdf');
    exit;
}
?>
