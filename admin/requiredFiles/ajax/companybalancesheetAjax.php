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

        $data = $con->query("
            SELECT
                id AS record_id,
                paid_date AS record_date,
                user_id,
                net_amount AS points,
                'debit' AS action,
                'Withdraw' AS remark,
                'withdrawhistory' AS source_table
            FROM withdrawhistory
            WHERE action = 'paid' AND payment_method != 'UCC'
            UNION ALL
            SELECT
                bt_id AS record_id,
                bt_createdat AS record_date,
                user_id,
                bt_points AS points,
                bt_action AS action,
                bt_remark AS remark,
                'bonustravelpoints' AS source_table
            FROM bonustravelpoints
            WHERE bt_action = 'debit'
            UNION ALL
            SELECT
                st_id AS record_id,
                st_createdat AS record_date,
                user_id,
                '50' AS points,
                st_action AS action,
                st_remark AS remark,
                'savingstravelpoints' AS source_table
            FROM savingstravelpoints
            WHERE st_remark != 'transfer'
            UNION ALL
            SELECT
                tc_id AS record_id,
                tc_createdat AS record_date,
                user_id,
                tc_points AS points,
                tc_action AS action,
                tc_remark AS remark,
                'travelcouponpoints' AS source_table
            FROM travelcouponpoints
            ORDER BY record_date;
        ");

        $tabledata = "";

        $credit = 0;
        $debit = 0;
        $balance = 0;

        $activationid = 1;

        foreach ($data as $index => $getdata) {

            $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $date = date('Y-m-d', strtotime($getdata["record_date"]));
            $time_part = date('H:i:s', strtotime($getdata["record_date"]));

            if ($getdata["action"] == "credit") {
                $credit += $getdata["points"];
            } else if ($getdata["action"] == "debit") {
                $debit += $getdata["points"];
            }

            $balance = $credit - $debit;

            if ($getdata["source_table"] == "travelcouponpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>ID Activation</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                    $activationid += 1;

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "bonustravelpoints") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "savingstravelpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Monthly Savings</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "withdrawhistory") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Withdraw</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            }

        }

        $response["totalcredit"] = '<b>' . number_format($credit, 2) . '</b>';
        $response["totaldebit"] = '<b> -' . number_format($debit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "userfilter") {
        $userid = $_POST["userid"];

        $data = $con->query("
            SELECT
                id AS record_id,
                paid_date AS record_date,
                user_id,
                net_amount AS points,
                'debit' AS action,
                'Withdraw' AS remark,
                'withdrawhistory' AS source_table
            FROM withdrawhistory
            WHERE action = 'paid' AND payment_method != 'UCC' AND user_id = '{$userid}'
            UNION ALL
            SELECT
                bt_id AS record_id,
                bt_createdat AS record_date,
                user_id,
                bt_points AS points,
                bt_action AS action,
                bt_remark AS remark,
                'bonustravelpoints' AS source_table
            FROM bonustravelpoints
            WHERE bt_action = 'debit' AND user_id = '{$userid}'
            UNION ALL
            SELECT
                st_id AS record_id,
                st_createdat AS record_date,
                user_id,
                '50' AS points,
                st_action AS action,
                st_remark AS remark,
                'savingstravelpoints' AS source_table
            FROM savingstravelpoints
            WHERE st_remark != 'transfer' AND user_id = '{$userid}'
            UNION ALL
            SELECT
                tc_id AS record_id,
                tc_createdat AS record_date,
                user_id,
                tc_points AS points,
                tc_action AS action,
                tc_remark AS remark,
                'travelcouponpoints' AS source_table
            FROM travelcouponpoints
            WHERE user_id = '{$userid}'
            ORDER BY record_date;
        ");


        $tabledata = "";

        $credit = 0;
        $debit = 0;
        $balance = 0;

        $activationid = 1;

        foreach ($data as $index => $getdata) {

            $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $date = date('Y-m-d', strtotime($getdata["record_date"]));
            $time_part = date('H:i:s', strtotime($getdata["record_date"]));

            if ($getdata["action"] == "credit") {
                $credit += $getdata["points"];
            } else if ($getdata["action"] == "debit") {
                $debit += $getdata["points"];
            }

            $balance = $credit - $debit;

            if ($getdata["source_table"] == "travelcouponpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>ID Activation</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                    $activationid += 1;

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "bonustravelpoints") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "savingstravelpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Monthly Savings</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "withdrawhistory") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Withdraw</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } 

        }

        $response["totalcredit"] = '<b>' . number_format($credit, 2) . '</b>';
        $response["totaldebit"] = '<b> -' . number_format($debit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "datefilter") {

        $fromdate = $_POST["fromdate"] . " 00:00:00";
        $todate = $_POST["todate"] . " 23:59:00";


        $data = $con->query("
            SELECT
                id AS record_id,
                paid_date AS record_date,
                user_id,
                net_amount AS points,
                'debit' AS action,
                'Withdraw' AS remark,
                'withdrawhistory' AS source_table
            FROM withdrawhistory
            WHERE action = 'paid' 
                AND payment_method != 'UCC'
                AND paid_date BETWEEN '{$fromdate}' AND '{$todate}'
            UNION ALL
            SELECT
                bt_id AS record_id,
                bt_createdat AS record_date,
                user_id,
                bt_points AS points,
                bt_action AS action,
                bt_remark AS remark,
                'bonustravelpoints' AS source_table
            FROM bonustravelpoints
            WHERE bt_action = 'debit'
                AND bt_createdat BETWEEN '{$fromdate}' AND '{$todate}'
            UNION ALL
            SELECT
                st_id AS record_id,
                st_createdat AS record_date,
                user_id,
                '50' AS points,
                st_action AS action,
                st_remark AS remark,
                'savingstravelpoints' AS source_table
            FROM savingstravelpoints
            WHERE st_remark != 'transfer'
                AND st_createdat BETWEEN '{$fromdate}' AND '{$todate}'
            UNION ALL
            SELECT
                tc_id AS record_id,
                tc_createdat AS record_date,
                user_id,
                tc_points AS points,
                tc_action AS action,
                tc_remark AS remark,
                'travelcouponpoints' AS source_table
            FROM travelcouponpoints
            WHERE tc_createdat BETWEEN '{$fromdate}' AND '{$todate}'
            ORDER BY record_date;
        ");

        $tabledata = "";

        $credit = 0;
        $debit = 0;
        $balance = 0;

        $activationid = 1;

        foreach ($data as $index => $getdata) {

            $name = $con->query("SELECT * FROM userdetails WHERE user_id = '{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $date = date('Y-m-d', strtotime($getdata["record_date"]));
            $time_part = date('H:i:s', strtotime($getdata["record_date"]));

            if ($getdata["action"] == "credit") {
                $credit += $getdata["points"];
            } else if ($getdata["action"] == "debit") {
                $debit += $getdata["points"];
            }

            $balance = $credit - $debit;

            if ($getdata["source_table"] == "travelcouponpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>ID Activation</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                    $activationid += 1;

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "bonustravelpoints") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "savingstravelpoints") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Monthly Savings</td>
                        <td>' . $date . '</td>
                        <td>' . $getdata["points"] . '</td>
                        <td></td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                } else if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "withdrawhistory") {

                if ($getdata["action"] == "debit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Withdraw</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            }

        }

        $response["totalcredit"] = '<b>' . number_format($credit, 2) . '</b>';
        $response["totaldebit"] = '<b>-' . number_format($debit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    }


} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>