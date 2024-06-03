<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "login") {

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "getData") {

        $response["admin_name"] = $values["admin_name"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $totalmember = $con->query("SELECT * FROM userdetails");
        
        $response["totalmembers"] = mysqli_num_rows($totalmember);

        $totaldistributor = $con->query("SELECT * FROM userdetails WHERE user_referalStatus = 'activated'");
        
        $response["totaldistributor"] = mysqli_num_rows($totaldistributor);

        $totalmonthly = $con->query("SELECT * FROM userdetails WHERE user_referalStatus = 'notactivated'");

        $response["totalmonthly"] = mysqli_num_rows($totalmonthly);

        //Savings Travel Points
        $savingtravel = $con->query("SELECT * FROM savingstravelpoints");
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

        $response["totalsavingtravel"] = number_format(($stcredit), 2);
        $response["usedsavingtravel"] = number_format(($stdebit), 2);
        $response["balancesavingtravel"] = number_format(($stcredit - $stdebit), 2);

         //Travel Coupon's
         $travelcoupon = $con->query("SELECT * FROM travelcouponpoints");
         $tccredit = 50;
         $tcdebit = 0;

         if (mysqli_num_rows($travelcoupon) >= 1) {

             foreach ($travelcoupon as $gettravelcoupon) {
                 if (isset($gettravelcoupon["tc_action"]) && strlen($gettravelcoupon["tc_action"]) >= 1) {
                     if ($gettravelcoupon["tc_action"] == "credit") {
                         $tccredit += (float) $gettravelcoupon["tc_points"];
                     } else if ($getbonustravel["tc_action"] == "debit") {
                         $tcdebit += (float) $gettravelcoupon["tc_points"];
                     }
                 }
             }

         }

         $response["totaltravelcoupon"] = number_format(($tccredit), 2);
         $response["usedtravelcoupon"] = number_format(($tcdebit), 2);
         $response["balancetravelcoupon"] = number_format(($tccredit - $tcdebit), 2);


        //Bonus Travel Points
        $bonustravel = $con->query("SELECT * FROM bonustravelpoints");
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

        $response["totalbonustravel"] = number_format(($btcredit), 2);
        $response["usedbonustravel"] = number_format(($btdebit), 2);
        $response["balancebonustravel"] = number_format(($btcredit - $btdebit), 2);


        //Networking Income
        $networkingincome = $con->query("SELECT * FROM networkingincomewallet");
        $niwcredit = 0;
        $niwdebit = 0;

        if (mysqli_num_rows($networkingincome) >= 1) {

            foreach ($networkingincome as $getnetworkingincome) {
                if (isset($getnetworkingincome["niw_action"]) && strlen($getnetworkingincome["niw_action"]) >= 1) {
                    if ($getnetworkingincome["niw_action"] == "credit") {
                        $niwcredit += (float) $getnetworkingincome["niw_points"];
                    } else if ($getnetworkingincome["niw_action"] == "debit") {
                        $niwdebit += (float) $getnetworkingincome["niw_points"];
                    }
                }
            }

        }

        $response["totalnetworkingincome"] = number_format(($niwcredit), 2);
        $response["usednetworkingincome"] = number_format(($niwdebit), 2);
        $response["balancenetworkingincome"] = number_format(($niwcredit - $niwdebit), 2);

        // Leadership Income
        $leadershipincome = $con->query("SELECT * FROM leadershipincomewallet");
        $liwcredit = 0;
        $liwdebit = 0;

        if (mysqli_num_rows($leadershipincome) >= 1) {
            foreach ($leadershipincome as $getleadershipincome) {
                if (isset($getleadershipincome["liw_action"]) && strlen($getleadershipincome["liw_action"]) >= 1) {
                    if ($getleadershipincome["liw_action"] == "credit") {
                        $liwcredit += (float) $getleadershipincome["liw_points"];
                    } else if ($getleadershipincome["liw_action"] == "debit") {
                        $liwdebit += (float) $getleadershipincome["liw_points"];
                    }
                }
            }
        }

        $response["totalleadershipincome"] = number_format(($liwcredit), 2);
        $response["usedleadershipincome"] = number_format(($liwdebit), 2);
        $response["balanceleadershipincome"] = number_format(($liwcredit - $liwdebit), 2);

        //Car & House Fund
        $carandhousefund = $con->query("SELECT * FROM carandhousefundwallet");
        $chfwcredit = 0;
        $chfwdebit = 0;

        if (mysqli_num_rows($carandhousefund) >= 1) {

            foreach ($carandhousefund as $getcarandhousefund) {
                if (isset($getcarandhousefund["chfw_action"]) && strlen($getcarandhousefund["chfw_action"]) >= 1) {
                    if ($getcarandhousefund["chfw_action"] == "credit") {
                        $chfwcredit += (float) $getcarandhousefund["chfw_points"];
                    } else if ($getcarandhousefund["chfw_action"] == "debit") {
                        $chfwdebit += (float) $getcarandhousefund["chfw_points"];
                    }
                }
            }

        }

        $response["totalcarandhousefund"] = number_format(($chfwcredit), 2);
        $response["usedcarandhousefund"] = number_format(($chfwdebit), 2);
        $response["balancecarandhousefund"] = number_format(($chfwcredit - $chfwdebit), 2);


        //Royalty Income
        $royaltyincome = $con->query("SELECT * FROM royaltyincomewallet");
        $riwcredit = 0;
        $riwdebit = 0;

        if (mysqli_num_rows($royaltyincome) >= 1) {

            foreach ($royaltyincome as $getroyaltyincome) {
                if (isset($getroyaltyincome["riw_action"]) && strlen($getroyaltyincome["riw_action"]) >= 1) {
                    if ($getroyaltyincome["riw_action"] == "credit") {
                        $riwcredit += (float) $getroyaltyincome["riw_points"];
                    } else if ($getroyaltyincome["riw_action"] == "debit") {
                        $riwdebit += (float) $getroyaltyincome["riw_points"];
                    }
                }
            }

        }

        $response["totalroyaltyincome"] = number_format(($riwcredit), 2);
        $response["usedroyaltyincome"] = number_format(($riwdebit), 2);
        $response["balanceroyaltyincome"] = number_format(($riwcredit - $riwdebit), 2);

        //Savings Income
        $savingsincome = $con->query("SELECT * FROM savingsincome");
        $sicredit = 0;
        $sidebit = 0;

        if (mysqli_num_rows($savingsincome) >= 1) {

            foreach ($savingsincome as $getsavingsincome) {
                if (isset($getsavingsincome["si_action"]) && strlen($getsavingsincome["si_action"]) >= 1) {
                    if ($getsavingsincome["si_action"] == "credit") {
                        $sicredit += (float) $getsavingsincome["si_points"];
                    } else if ($getsavingsincome["si_action"] == "debit") {
                        $sidebit += (float) $getsavingsincome["si_points"];
                    }
                }
            }

        }

        $response["totalsavingsincome"] = number_format(($sicredit), 2);
        $response["usedsavingsincome"] = number_format(($sidebit), 2);
        $response["balancesavingsincome"] = number_format(($sicredit - $sidebit), 2);


        //Available Withdraw Balance
        $availablewithdrwabalance = $con->query("SELECT * FROM availablewithdrwabalance");
        $awbcredit = 0;
        $awbdebit = 0;

        if (mysqli_num_rows($availablewithdrwabalance) >= 1) {

            foreach ($availablewithdrwabalance as $getavailablewithdrwabalance) {
                if (isset($getavailablewithdrwabalance["awb_action"]) && strlen($getavailablewithdrwabalance["awb_action"]) >= 1) {
                    if ($getavailablewithdrwabalance["awb_action"] == "credit") {
                        $awbcredit += (float) $getavailablewithdrwabalance["awb_points"];
                    } else if ($getavailablewithdrwabalance["awb_action"] == "debit") {
                        $awbdebit += (float) $getavailablewithdrwabalance["awb_points"];
                    }
                }
            }

        }

        $response["totalavailablewithdrwabalance"] = number_format(($awbcredit), 2);
        $response["usedavailablewithdrwabalance"] = number_format(($awbdebit), 2);
        $response["balanceavailablewithdrwabalance"] = number_format(($awbcredit - $awbdebit), 2);
        
        //ID Reactivation Wallet
        $reactivationwallet = $con->query("SELECT * FROM reactivationwallet");
        $rawcredit = 0;
        $rawdebit = 0;

        if (mysqli_num_rows($reactivationwallet) >= 1) {

            foreach ($reactivationwallet as $getreactivationwallet) {
                if (isset($getreactivationwallet["raw_action"]) && strlen($getreactivationwallet["raw_action"]) >= 1) {
                    if ($getreactivationwallet["raw_action"] == "credit") {
                        $rawcredit += (float) $getreactivationwallet["raw_points"];
                    } else if ($getreactivationwallet["raw_action"] == "debit") {
                        $rawdebit += (float) $getreactivationwallet["raw_points"];
                    }
                }
            }

        }

        $response["totalreactivationwallet"] = number_format(($rawcredit), 2);
        $response["usedreactivationwallet"] = number_format(($rawdebit), 2);
        $response["balancereactivationwallet"] = number_format(($rawcredit - $rawdebit), 2);

        //UCC Wallet
        $uccwallet = $con->query("SELECT * FROM uccwalletpoints");
        $uccwcredit = 0;
        $uccwdebit = 0;

        if (mysqli_num_rows($uccwallet) >= 1) {

            foreach ($uccwallet as $getuccwallet) {
                if (isset($getuccwallet["uccw_action"]) && strlen($getuccwallet["uccw_action"]) >= 1) {
                    if ($getuccwallet["uccw_action"] == "credit") {
                        $uccwcredit += (float) $getuccwallet["uccw_points"];
                    } else if ($getuccwallet["uccw_action"] == "debit") {
                        $uccwdebit += (float) $getuccwallet["uccw_points"];
                    }
                }
            }

        }

        $response["totaluccwallet"] = number_format(($uccwcredit), 2);
        $response["useduccwallet"] = number_format(($uccwdebit), 2);
        $response["balanceuccwallet"] = number_format(($uccwcredit - $uccwdebit), 2);

        //Admin Wallet
        $adminnwallet = $con->query("SELECT * FROM admin_wallet");
        $awcredit = 0;
        $awdebit = 0;

        if (mysqli_num_rows($adminnwallet) >= 1) {

            foreach ($adminnwallet as $getadminnwallet) {
                if (isset($getadminnwallet["aw_action"]) && strlen($getadminnwallet["aw_action"]) >= 1) {
                    if ($getadminnwallet["aw_action"] == "credit") {
                        $awcredit += (float) $getadminnwallet["aw_points"];
                    } else if ($getadminnwallet["aw_action"] == "debit") {
                        $awdebit += (float) $getadminnwallet["aw_points"];
                    }
                }
            }

        }

        $response["totaladminnwallet"] = number_format(($awcredit), 2);
        $response["usedadminnwallet"] = number_format(($awdebit), 2);
        $response["balanceadminnwallet"] = number_format(($awcredit - $awdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>