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

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_id"] = $datarow["user_id"];
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];
            $response["user_sponserid"] = $datarow["user_sponserid"];
            $response["user_referalStatus"] = $datarow["user_referalStatus"];
            $response["created_at"] = $datarow["created_at"];
            $response["status"] = "success";

            $getlatestnews = $con->query("SELECT * FROM latestnews WHERE 1");
            $resnews = $getlatestnews->fetch_assoc();
            $response["news"] = $resnews["news"];

            $getimage = $con->query("SELECT * FROM galleryimages");

            $images = array();
            foreach ($getimage as $rowimage) {
                $images[] = $rowimage["imagename"];
            }

            $response["galleryimages"] = $images;

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

            if (mysqli_num_rows($savingtravel) >= 1) {

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
                        } else if ($getbonustravel["tc_action"] == "debit") {
                            $tcdebit += (float) $gettravelcoupon["tc_points"];
                        }
                    }
                }

            }

            $response["travelcoupon"] = number_format(($tccredit - $tcdebit), 2);

            // Networking Income
            $networkingincome = $con->query("SELECT * FROM networkingincomewallet WHERE user_id='{$datarow["user_id"]}'");
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

            $response["networkingincome"] = number_format(($niwcredit - $niwdebit), 2);

            // Leadership Income
            $leadershipincome = $con->query("SELECT * FROM leadershipincomewallet WHERE user_id='{$datarow["user_id"]}'");
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

            $response["leadershipincome"] = number_format(($liwcredit - $liwdebit), 2);


            //Car & House Fund
            $carandhousefund = $con->query("SELECT * FROM carandhousefundwallet WHERE user_id='{$datarow["user_id"]}'");
            $chfwcredit = 0;
            $chfwdebit = 0;

            if (mysqli_num_rows($carandhousefund) >= 1) {

                foreach ($carandhousefund as $getcarandhousefund) {
                    if (isset($getcarandhousefund["chfw_action"]) && strlen($getcarandhousefund["chfw_action"]) >= 1) {
                        if ($getcarandhousefund["chfw_action"] == "credit") {
                            $chfwcredit += (float) $getcarandhousefund["chfw_points"];
                        } else if ($getbonustravel["chfw_action"] == "debit") {
                            $chfwdebit += (float) $getcarandhousefund["chfw_points"];
                        }
                    }
                }

            }

            $response["carandhousefund"] = number_format(($chfwcredit - $chfwdebit), 2);

            //Royalty Income
            $royaltyincome = $con->query("SELECT * FROM royaltyincomewallet WHERE user_id='{$datarow["user_id"]}'");
            $riwcredit = 0;
            $riwdebit = 0;

            if (mysqli_num_rows($royaltyincome) >= 1) {

                foreach ($royaltyincome as $getroyaltyincome) {
                    if (isset($getroyaltyincome["riw_action"]) && strlen($getroyaltyincome["riw_action"]) >= 1) {
                        if ($getroyaltyincome["riw_action"] == "credit") {
                            $riwcredit += (float) $getroyaltyincome["riw_points"];
                        } else if ($getbonustravel["riw_action"] == "debit") {
                            $riwdebit += (float) $getroyaltyincome["riw_points"];
                        }
                    }
                }

            }

            $response["royaltyincome"] = number_format(($riwcredit - $riwdebit), 2);





            $response["status"] = "success";
            echo json_encode($response);

        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>