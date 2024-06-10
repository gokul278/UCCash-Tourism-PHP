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

        $data = $con->query("SELECT * FROM bonustravelpoints");

        $tabledata = "";

        $btcredit = 0;
        $btdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["bt_action"]) && strlen($getdata["bt_action"]) >= 1) {
                if ($getdata["bt_action"] == "credit") {
                    $btcredit += (float) $getdata["bt_points"];
                } else if ($getdata["bt_action"] == "debit") {
                    $btdebit += (float) $getdata["bt_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $btcredit - $btdebit;

            if ($getdata["bt_action"] == "credit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>From<span style="color: #f7c128;"> ' . $getdata["bt_bonusfrom"] . '</span> ID</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td></td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            } else if ($getdata["bt_action"] == "debit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Tour Booking</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td></td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($btcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($btdebit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "userfilter") {

        $userid = $_POST["userid"];

        $data = $con->query("SELECT * FROM bonustravelpoints WHERE user_id='{$userid}'");

        $tabledata = "";

        $btcredit = 0;
        $btdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["bt_action"]) && strlen($getdata["bt_action"]) >= 1) {
                if ($getdata["bt_action"] == "credit") {
                    $btcredit += (float) $getdata["bt_points"];
                } else if ($getdata["bt_action"] == "debit") {
                    $btdebit += (float) $getdata["bt_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $btcredit - $btdebit;

            if ($getdata["bt_action"] == "credit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>From<span style="color: #f7c128;"> ' . $getdata["bt_bonusfrom"] . '</span> ID</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td></td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            } else if ($getdata["bt_action"] == "debit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Tour Booking</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td></td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($btcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($btdebit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "datefilter") {

        $fromdate = $_POST["fromdate"]." 00:00:00";
        $todate = $_POST["todate"]." 23:59:00";

        $data = $con->query("SELECT * FROM bonustravelpoints WHERE bt_createdat BETWEEN '{$fromdate}' AND '{$todate}'");

        $tabledata = "";

        $btcredit = 0;
        $btdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["bt_action"]) && strlen($getdata["bt_action"]) >= 1) {
                if ($getdata["bt_action"] == "credit") {
                    $btcredit += (float) $getdata["bt_points"];
                } else if ($getdata["bt_action"] == "debit") {
                    $btdebit += (float) $getdata["bt_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $btcredit - $btdebit;

            if ($getdata["bt_action"] == "credit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>From<span style="color: #f7c128;"> ' . $getdata["bt_bonusfrom"] . '</span> ID</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td></td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            } else if ($getdata["bt_action"] == "debit") {

                $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Tour Booking</td>
                    <td>' . $getdata["bt_createdat"] . '</td>
                    <td></td>
                    <td>' . $getdata["bt_points"] . '</td>
                    <td>' . $balance . '</td>
                </tr>
                ';

            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($btcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($btdebit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["status"] = "success";
        echo json_encode($response);

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>