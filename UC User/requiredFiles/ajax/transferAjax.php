<?php

require "../../../requiredFiles/ajax/DBConnection.php";

require "./verify.php";

$values = token::verify();

if ($values["status"] == "success") {

    $way = $_POST["way"];

    if ($way == "login") {

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "getflashbanner") {

        $getflashbanner = $con->query("SELECT * FROM flashbanner WHERE id=1");

        $flashbanner = $getflashbanner->fetch_assoc();

        $response["status"] = "success";
        $response["flashbanner"] = $flashbanner["bannerimage"];
        echo json_encode($response);

    } else if ($way == "getData") {

        $datasql = "SELECT * FROM userdetails WHERE user_id='{$values["userid"]}'";
        $datares = $con->query($datasql);

        if (mysqli_num_rows($datares) == 1) {

            $datarow = $datares->fetch_assoc();
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            //Savings Income
            $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
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

            $response["savingsincome"] = number_format(($sicredit - $sidebit), 2);

            // Networking Income
            $networkingincome = $con->query("SELECT * FROM networkingincomewallet WHERE user_id='{$values["userid"]}'");
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
            $leadershipincome = $con->query("SELECT * FROM leadershipincomewallet WHERE user_id='{$values["userid"]}'");
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
            $carandhousefund = $con->query("SELECT * FROM carandhousefundwallet WHERE user_id='{$values["userid"]}'");
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

            $response["carandhousefund"] = number_format(($chfwcredit - $chfwdebit), 2);

            //Royalty Income
            $royaltyincome = $con->query("SELECT * FROM royaltyincomewallet WHERE user_id='{$values["userid"]}'");
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

            $response["royaltyincome"] = number_format(($riwcredit - $riwdebit), 2);





            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "savingsincome") {

        //Savings Income
        $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
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

        $response["balanacevalue"] = number_format(($sicredit - $sidebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "networkingincome") {

        //Networking Income
        $networkingincome = $con->query("SELECT * FROM networkingincomewallet WHERE user_id='{$values["userid"]}'");
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

        $response["balanacevalue"] = number_format(($niwcredit - $niwdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "leadershipincome") {

        // Leadership Income
        $leadershipincome = $con->query("SELECT * FROM leadershipincomewallet WHERE user_id='{$values["userid"]}'");
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

        $response["balanacevalue"] = number_format(($liwcredit - $liwdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "carandhousefundincome") {

        //Car & House Fund
        $carandhousefund = $con->query("SELECT * FROM carandhousefundwallet WHERE user_id='{$values["userid"]}'");
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

        $response["balanacevalue"] = number_format(($chfwcredit - $chfwdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "royaltyincome") {

        //Royalty Income
        $royaltyincome = $con->query("SELECT * FROM royaltyincomewallet WHERE user_id='{$values["userid"]}'");
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

        $response["balanacevalue"] = number_format(($riwcredit - $riwdebit), 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "transfer") {

        $wallettype = $_POST["wallettype"];
        $transfervalue = number_format($_POST["transfervalue"], 2);

        $valid = false;

        if ($wallettype == "savingsincome") {

            //Savings Income
            $savingsincome = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");
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

            $walletvalue = number_format(($sicredit - $sidebit), 2);
            $valid = $walletvalue >= $transfervalue;

        } else if ($wallettype == "networkingincome") {

            //Networking Income
            $networkingincome = $con->query("SELECT * FROM networkingincomewallet WHERE user_id='{$values["userid"]}'");
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

            $walletvalue = number_format(($niwcredit - $niwdebit), 2);
            $valid = $walletvalue >= $transfervalue;

        } else if ($wallettype == "leadershipincome") {

            // Leadership Income
            $leadershipincome = $con->query("SELECT * FROM leadershipincomewallet WHERE user_id='{$values["userid"]}'");
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

            $walletvalue = number_format(($liwcredit - $liwdebit), 2);
            $valid = $walletvalue >= $transfervalue;

        } else if ($wallettype == "carandhousefundincome") {

            //Car & House Fund
            $carandhousefund = $con->query("SELECT * FROM carandhousefundwallet WHERE user_id='{$values["userid"]}'");
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

            $walletvalue = number_format(($chfwcredit - $chfwdebit), 2);
            $valid = $walletvalue >= $transfervalue;

        } else if ($wallettype == "royaltyincome") {

            //Royalty Income
            $royaltyincome = $con->query("SELECT * FROM royaltyincomewallet WHERE user_id='{$values["userid"]}'");
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

            $walletvalue = number_format(($riwcredit - $riwdebit), 2);
            $valid = $walletvalue >= $transfervalue;

        }


        if ($valid) {

            if ($wallettype == "savingsincome") {

                $debitwallet = $con->query("INSERT INTO savingsincome (user_id, si_points, si_bonusfrom, si_action, si_remark)
                VALUES ('{$values["userid"]}', '{$transfervalue}', '', 'debit', 'Available Withdraw Balance')");
                $creditwallet = $con->query("INSERT INTO availablewithdrwabalance (user_id, awb_from, awb_to, awb_points, awb_action)
                VALUES ('{$values["userid"]}', 'Savings Income', 'Available Withdraw Balance', '{$transfervalue}', 'credit')");
                $response["status"] = "success";
                echo json_encode($response);

            } else if ($wallettype == "networkingincome") {

                $debitwallet = $con->query("INSERT INTO networkingincomewallet (user_id, niw_points, niw_bonusfrom, niw_lvl, niw_action, niw_remark)
                VALUES ('{$values["userid"]}', '{$transfervalue}', '', '', 'debit', 'Available Withdraw Balance')");
                $creditwallet = $con->query("INSERT INTO availablewithdrwabalance (user_id, awb_from, awb_to, awb_points, awb_action)
                VALUES ('{$values["userid"]}', 'Networking Income', 'Available Withdraw Balance', '{$transfervalue}', 'credit')");
                $response["status"] = "success";
                echo json_encode($response);

            } else if ($wallettype == "leadershipincome") {

                $debitwallet = $con->query("INSERT INTO leadershipincomewallet (user_id, liw_points, liw_bonusfrom, liw_lvl, liw_action, liw_remark)
                VALUES ('{$values["userid"]}', '{$transfervalue}', '', '', 'debit', 'Available Withdraw Balance')");
                $creditwallet = $con->query("INSERT INTO availablewithdrwabalance (user_id, awb_from, awb_to, awb_points, awb_action)
                VALUES ('{$values["userid"]}', 'Leadership Income', 'Available Withdraw Balance', '{$transfervalue}', 'credit')");
                $response["status"] = "success";
                echo json_encode($response);

            } else if ($wallettype == "carandhousefundincome") {

                $checkrank = $con->query("SELECT * FROM genealogy WHERE lvl3='{$values["userid"]}'");

                $number = $checkrank->num_rows;

                if ($number >= 125) {

                    $debitwallet = $con->query("INSERT INTO carandhousefundwallet (user_id, chfw_points, chfw_bonusfrom, chfw_lvl, chfw_action, chfw_remark)
                    VALUES ('{$values["userid"]}', '{$transfervalue}', '', '', 'debit', 'Available Withdraw Balance')");
                    $creditwallet = $con->query("INSERT INTO availablewithdrwabalance (user_id, awb_from, awb_to, awb_points, awb_action)
                    VALUES ('{$values["userid"]}', 'Car & House Fund', 'Available Withdraw Balance', '{$transfervalue}', 'credit')");
                    $response["status"] = "success";
                    echo json_encode($response);

                } else {

                    $response["status"] = "error";
                    $response["message"] = "To Unlock the Bronze Director Rank";
                    echo json_encode($response);

                }

            } else if ($wallettype == "royaltyincome") {

                $checkrank = $con->query("SELECT * FROM genealogy WHERE lvl4='{$values["userid"]}'");

                $number = $checkrank->num_rows;

                if ($number >= 375) {

                    $debitwallet = $con->query("INSERT INTO royaltyincomewallet (user_id, riw_points, riw_bonusfrom, riw_lvl, riw_action, riw_remark)
                    VALUES ('{$values["userid"]}', '{$transfervalue}', '', '', 'debit', 'Available Withdraw Balance')");
                    $creditwallet = $con->query("INSERT INTO availablewithdrwabalance (user_id, awb_from, awb_to, awb_points, awb_action)
                    VALUES ('{$values["userid"]}', 'Royalty Income', 'Available Withdraw Balance', '{$transfervalue}', 'credit')");
                    $response["status"] = "success";
                    echo json_encode($response);

                }else{

                    $response["status"] = "error";
                    $response["message"] = "To Unlock the Silver Director Rank";
                    echo json_encode($response);

                }

            }


        } else {

            $response["status"] = "error";
            $response["message"] = "Insufficient Balance";
            echo json_encode($response);

        }


    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>