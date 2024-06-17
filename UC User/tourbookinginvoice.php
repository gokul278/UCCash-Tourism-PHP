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
    $bookinggst = $getbookingdetails["gst_amount"];
    $bookingperson = $getbookingdetails["booking_person"];
    $bookingfromdate = $getbookingdetails["booking_fromdate"];
    $bookingtodate = $getbookingdetails["booking_todate"];
    $bookingnetamount = $getbookingdetails["net_amount"];
    $bookingamount = $getbookingdetails["booking_amount"];

    $savingstp = "****";
    $bonustp = "****";
    $travelcoupontp = "****";


    if (strlen($bookingmethod) > 30) {
        // Use a regular expression to find the values inside the brackets
        if (preg_match('/\((\d+)\s*\+\s*(\d+)\s*\+\s*(\d+)\)/', $bookingmethod, $matches)) {
            // Extract the values
            $savingstp = $matches[1];
            $bonustp = $matches[2];
            $travelcoupontp = $matches[3];
        }else{
            if (preg_match('/\((\d+(\.\d+)?)\s*\+\s*(\d+(\.\d+)?)\s*\+\s*(\d+(\.\d+)?)\)/', $bookingmethod, $matches)) {
                // Extract the values
                $savingstp = $matches[1];
                $bonustp = $matches[3];
                $travelcoupontp = $matches[5];
            } else {
                $savingstp = "error";
                $bonustp = "error";
                $travelcoupontp = "error";
            }
        }
        
    } else {
        if ($bookingmethod == "Savings Travel Point") {
            $savingstp = $bookingnetamount;
        } else if ($bookingmethod == "Bonus Travel Point") {
            $bonustp = $bookingnetamount;
        } else if ($bookingmethod == "Travel Coupon") {
            $travelcoupontp = $bookingnetamount;
        }
    }

    $pdf = new TCPDF();

    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false); // Disable auto page breaks

    $pdf->SetTitle('UCCASH TOURIST TOUR BOOKING');

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    $pdf->AddPage();

    $html = '    
    <table align="center"> 
       <tr>
            <td><img src="./requiredFiles/ajax/img/ReciptInvoiceTop.jpg"></td>
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
        <tr style="font-size:13px;width:100%" align="left">
            <td style="width:1.5%"></td>
            <td style="width:96%">
                <div style="width:100%">
                    <table border="1" cellpadding="6.1" style="width:100%">
                        <tr style="width:100%;background-color:#191919;color:#fff;font-size:14px">
                            <td style="width:45%">
                                Invoice No: <b>UCTBI' . sprintf("%03d", $getbookingdetails["id"]) . '</b>
                            </td>
                            <td style="width:55%">
                                Booking Reservation Details
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                <b>Reservation Status</b>
                            </td>
                            <td style="width:27.5%">
                                <b>Payments</b>
                            </td>
                            <td style="width:27.5%">
                                <b>Detials</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Tour Booking Reservation Number
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingcode.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Tour Booking Reservation Country
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingdestination.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Depart Date 
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingfromdate.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Return Date
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingtodate.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Tour Booking Price 
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingamount.' TP</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                No of Traveller
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingperson.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Total Booking Price
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.($getbookingdetails["booking_amount"]*$bookingperson)-$bookinggst.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Tax Amount 18% (9%+9%)
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookinggst.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Net Total Amount
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingnetamount.'</b>
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Savings Travel Point
                            </td>
                            <td style="width:27.5%">
                                <b>'.$savingstp.'</b>
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                               Bonus Travel point 
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bonustp.'</b>
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Travel coupon
                            </td>
                            <td style="width:27.5%">
                                <b>'.$travelcoupontp.'</b>
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                        </tr>
                        <tr style="width:100%;color:#000;font-size:13px">
                            <td style="width:45%">
                                Total Travel Point Used
                            </td>
                            <td style="width:27.5%">
                                <b>'.$bookingnetamount.'</b>
                            </td>
                            <td style="width:27.5%">
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="width:100%">
            <td style="width:100%">
                <div style="width:100%">
                    <table style="width:100%">
                        <tr style="width:100%">
                            <td style="width:2%"></td>
                            <td style="width:96%;color:#000" align="start">
                                <b>IMPORTANT NOTICE:</b> All Travel Booking now require online web check-in for confirmation. Failure to complete in advance can result in denied booking. Please submit your all required documents below your booking receipt data. You must submit all required personal information no later than 48-72 hours prior from booking. Web check-in opens 45-60 days prior depending on the Tour Booking. kindly send mail to billings@uccashtourism.com to all required details.
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="background-color:#F5BF26;font-size:13px;width:100%" align="left">
            <td style="width:100%"><div style="width:100%"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Copyright © UCCASH Tourism - ' . date('Y') . '. All Rights Reserved.<br></b></div></td>
    </tr>
    </table>
    
    ';

    $pdf->writeHTML($html);

    $pdf->AddPage();

    $html = '    
    <table align="center"> 
        <tr>
            <td><img src="./requiredFiles/ajax/img/ReciptInvoiceTop.jpg"></td>
        </tr>
        <tr>
            <td>
                <div style="width:100%">
                    <table style="width:100%">
                        <tr style="width:100%">
                            <td style="width:98%">
                                <div>
                                    <table border="1" cellpadding="8">
                                        <tr>
                                            <td style="width:45%;background-color:#191919;color:#fff;font-size:14px">Passengers</td>
                                            <td style="width:55%;background-color:#191919;color:#fff;font-size:14px">Country of residence</td>
                                        </tr>
                                        <tr>
                                            <td style="width:45%;color:#000;font-size:13px"><b>'.$bookingperson.'</b></td>
                                            <td style="width:55%;color:#000;font-size:13px"><b>'.$getuserdetails["user_country"].'</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
            <td><img src="./requiredFiles/ajax/img/TourReciptBillForm.jpg"></td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
            <td style="width:100%">
                <div style="width:100%">
                    <table style="width:100%">
                        <tr style="width:100%">
                            <td style="width:2%"></td>
                            <td style="width:96%;color:#000" align="start">
                                <p><b>IMPORTANT NOTICE:</b> All Travel Booking now require online web check-in for confirmation. Failure to complete in advance can result in denied booking. Please submit your all required documents below your booking receipt data. You must submit all required personal information no later than 48-72 hours prior from booking. Web check-in opens 45-60 days prior depending on the Tour Booking. kindly send mail to billings@uccashtourism.com to all required details.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="background-color:#F5BF26;font-size:13px;" align="left">
            <td style="width:100%"><div style="width:100%"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Copyright © UCCASH Tourism - ' . date('Y') . '. All Rights Reserved.<br></b></div></td>
    </tr>
    </table>
    
    ';

    $pdf->writeHTML($html);


    $pdf->Output('Tour_Booking_' . $bookingcode . '.pdf');
    exit;
}
?>