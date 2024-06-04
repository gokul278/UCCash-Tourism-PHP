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
            $response["user_name"] = $datarow["user_name"];
            $response["user_profileimg"] = $datarow["user_profileimg"];

            $tourid = $_POST["bookingid"];

            $data = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
            $getdata = $data->fetch_assoc();

            $response["tour_amount"] = number_format($getdata["tour_amount"],2);

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

            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "checkamount") {
        $personvalue = number_format(($_POST["person"]), 2);
        $bookingid = $_POST["bookingid"];

        $data = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");
        $getdata = $data->fetch_assoc();

        $amount = number_format(($getdata["tour_amount"]), 2);

        $totalamount = number_format(($personvalue * $amount), 2);

        $response["tour_amount"] = $totalamount;

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>