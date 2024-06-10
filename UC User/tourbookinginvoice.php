<?php

require ".././requiredFiles/ajax/DBConnection.php";

$way = "invoiceprint";

if ($way == "invoiceprint") {

    require './requiredFiles/ajax/TCPDF-main/tcpdf.php';

    $userid = $_POST["userid"];
    $bookingid = $_POST["bookingid"];

    $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$userid}'");
    $getuserdetails = $userdetails->fetch_assoc();
    
    $username = $getuserdetails["user_name"];
    $email = $getuserdetails["user_email"];
    $phoneno = $getuserdetails["user_phoneno"];
   
    $bookingdetails = $con->query("SELECT * FROM tourbookinghistory WHERE id='{$bookingid}'");
    $getbookingdetails = $bookingdetails->fetch_assoc();
    
    $bookingcode = $getbookingdetails["booking_code"];
    $bookingdestination = $getbookingdetails["booking_destination"];
    $bookingdate = new DateTime($getbookingdetails["booking_date"]);
    $bookingdate = $bookingdate->format('Y-m-d');
    $bookingmethod = $getbookingdetails["paymentmethod_description"];
    if (strlen($bookingmethod) > 30) {
        // Use a regular expression to find the values inside the brackets
        if (preg_match('/\((\d+)\s*\+\s*(\d+)\s*\+\s*(\d+)\)/', $bookingmethod, $matches)) {
            // Extract the values
            $val1 = $matches[1];
            $val2 = $matches[2];
            $val3 = $matches[3];
    
            // Create the new string
            $newValue = "SavingsTP, Bonus Tp, Travel Coupon ($val1+$val2+$val3)";
            
            // Update the bookingmethod variable
            $bookingmethod = $newValue;
        }
    }else{
        $bookingmethod = "<br>".$bookingmethod."<br>";
    }
    $bookignperson = $getbookingdetails["booking_person"];
    $bookingpayment = $getbookingdetails["payment_amount"];

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
            <td><img src="./requiredFiles/ajax/img/InvoiceTop.jpg"/></td>
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
                            <td style="width:68%" align="start"><b>:</b> ' . $phoneno . '</td>
                        </tr>
                    </table>
                </div>
            </td>
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
                            <td style="background-color:#011B3B;color:white">Bookign Code</td>
                            <td style="background-color:#011B3B;color:white">Booking Date</td>
                            <td style="background-color:#011B3B;color:white">Bookign Destination</td>
                            <td style="background-color:#011B3B;color:white">No of Participants</td>
                            <td style="background-color:#011B3B;color:white">Booking Payment</td>
                            <td style="background-color:#011B3B;color:white">Booking Amount</td>
                        </tr>
                        <tr align="center">
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b><br>' . $bookingcode . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b><br>' . $bookingdate . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b><br>' . $bookingdestination . '</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;"><b><br>'.$bookignperson.'</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;font-size:12px;"><b>'.$bookingmethod.'</b></td>
                            <td style="color:#6F6F6F;border: 1px solid #6F6F6F;font-size:19px;"><b><br>'.$bookingpayment.' TP</b></td>
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
            <td><img src="./requiredFiles/ajax/img/InvoiceBottom.jpg"></td>
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

    $pdf->Output('Tour_Booking_' . $bookingcode .'.pdf');
    exit;
}
?>