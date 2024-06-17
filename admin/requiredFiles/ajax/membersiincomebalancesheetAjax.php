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
                si_id AS record_id,
                si_createdat AS record_date,
                user_id,
                si_points AS points,
                si_action AS action,
                si_bonusfrom AS remark,
                'savingsincome' AS source_table
            FROM savingsincome
            UNION ALL
            SELECT
                niw_id AS record_id,
                niw_createdat AS record_date,
                user_id,
                niw_points AS points,
                niw_action AS action,
                niw_bonusfrom AS remark,
                'networkingincomewallet' AS source_table
            FROM networkingincomewallet
            UNION ALL
            SELECT
                liw_id AS record_id,
                liw_createdat AS record_date,
                user_id,
                liw_points AS points,
                liw_action AS action,
                liw_bonusfrom AS remark,
                'leadershipincomewallet' AS source_table
            FROM leadershipincomewallet
            UNION ALL
            SELECT
                chfw_id AS record_id,
                chfw_createdat AS record_date,
                user_id,
                chfw_points AS points,
                chfw_action AS action,
                chfw_bonusfrom AS remark,
                'carandhousefundwallet' AS source_table
            FROM carandhousefundwallet
            UNION ALL
            SELECT
                riw_id AS record_id,
                riw_createdat AS record_date,
                user_id,
                riw_points AS points,
                riw_action AS action,
                riw_bonusfrom AS remark,
                'royaltyincomewallet' AS source_table
            FROM royaltyincomewallet
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

            if ($getdata["source_table"] == "savingsincome") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Savings Income</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Savings Income</td>
                        <td>Transferred To Available Withdraw Balance</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "networkingincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Networking Income</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Networking Income</td>
                        <td>Transferred To Available Withdraw Balance</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Leadership Income</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Leadership Income</td>
                        <td>Transferred To Available Withdraw Balance</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Leadership Income</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Leadership Income</td>
                        <td>Transferred To Available Withdraw Balance</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "carandhousefundwallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Car & House Fund</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Car & House Fund</td>
                        <td>Transferred To Available Withdraw Balance</td>
                        <td>' . $date . '</td>
                        <td></td>
                        <td>' . $getdata["points"] . '</td>
                        <td>' . number_format($balance, 2) . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["source_table"] == "royaltyincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Royalty Income</td>
                        <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                        <td>Royalty Income</td>
                        <td>Transferred To Available Withdraw Balance</td>
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

        $response["admin_name"] = $values["admin_name"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];
        
        $userid = $_POST["userid"];

        $data = $con->query("
        SELECT
            si_id AS record_id,
            si_createdat AS record_date,
            user_id,
            si_points AS points,
            si_action AS action,
            si_bonusfrom AS remark,
            'savingsincome' AS source_table
        FROM savingsincome WHERE user_id='{$userid}'
        UNION ALL
        SELECT
            niw_id AS record_id,
            niw_createdat AS record_date,
            user_id,
            niw_points AS points,
            niw_action AS action,
            niw_bonusfrom AS remark,
            'networkingincomewallet' AS source_table
        FROM networkingincomewallet WHERE user_id='{$userid}'
        UNION ALL
        SELECT
            liw_id AS record_id,
            liw_createdat AS record_date,
            user_id,
            liw_points AS points,
            liw_action AS action,
            liw_bonusfrom AS remark,
            'leadershipincomewallet' AS source_table
        FROM leadershipincomewallet WHERE user_id='{$userid}'
        UNION ALL
        SELECT
            chfw_id AS record_id,
            chfw_createdat AS record_date,
            user_id,
            chfw_points AS points,
            chfw_action AS action,
            chfw_bonusfrom AS remark,
            'carandhousefundwallet' AS source_table
        FROM carandhousefundwallet WHERE user_id='{$userid}'
        UNION ALL
        SELECT
            riw_id AS record_id,
            riw_createdat AS record_date,
            user_id,
            riw_points AS points,
            riw_action AS action,
            riw_bonusfrom AS remark,
            'royaltyincomewallet' AS source_table
        FROM royaltyincomewallet WHERE user_id='{$userid}'
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

            if ($getdata["source_table"] == "savingsincome") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Savings Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Savings Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "networkingincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Networking Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Networking Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Leadership Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Leadership Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Leadership Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Leadership Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "carandhousefundwallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Car & House Fund</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Car & House Fund</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "royaltyincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Royalty Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Royalty Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
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
            si_id AS record_id,
            si_createdat AS record_date,
            user_id,
            si_points AS points,
            si_action AS action,
            si_bonusfrom AS remark,
            'savingsincome' AS source_table
        FROM savingsincome WHERE si_createdat BETWEEN '{$fromdate}' AND '{$todate}'
        UNION ALL
        SELECT
            niw_id AS record_id,
            niw_createdat AS record_date,
            user_id,
            niw_points AS points,
            niw_action AS action,
            niw_bonusfrom AS remark,
            'networkingincomewallet' AS source_table
        FROM networkingincomewallet WHERE niw_createdat BETWEEN '{$fromdate}' AND '{$todate}'
        UNION ALL
        SELECT
            liw_id AS record_id,
            liw_createdat AS record_date,
            user_id,
            liw_points AS points,
            liw_action AS action,
            liw_bonusfrom AS remark,
            'leadershipincomewallet' AS source_table
        FROM leadershipincomewallet WHERE liw_createdat BETWEEN '{$fromdate}' AND '{$todate}'
        UNION ALL
        SELECT
            chfw_id AS record_id,
            chfw_createdat AS record_date,
            user_id,
            chfw_points AS points,
            chfw_action AS action,
            chfw_bonusfrom AS remark,
            'carandhousefundwallet' AS source_table
        FROM carandhousefundwallet WHERE chfw_createdat BETWEEN '{$fromdate}' AND '{$todate}'
        UNION ALL
        SELECT
            riw_id AS record_id,
            riw_createdat AS record_date,
            user_id,
            riw_points AS points,
            riw_action AS action,
            riw_bonusfrom AS remark,
            'royaltyincomewallet' AS source_table
        FROM royaltyincomewallet WHERE riw_createdat BETWEEN '{$fromdate}' AND '{$todate}'
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

            if ($getdata["source_table"] == "savingsincome") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Savings Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Savings Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "networkingincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Networking Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Networking Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Leadership Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Leadership Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "leadershipincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Leadership Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Leadership Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "carandhousefundwallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Car & House Fund</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Car & House Fund</td>
                    <td>Transferred To Available Withdraw Balance</td>
                    <td>' . $date . '</td>
                    <td></td>
                    <td>' . $getdata["points"] . '</td>
                    <td>' . number_format($balance, 2) . '</td>
                </tr>
                ';

                }

            } else if ($getdata["source_table"] == "royaltyincomewallet") {

                if ($getdata["action"] == "credit") {

                    $tabledata .= '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . $getdata["user_id"] . '</td>
                    <td>' . $getname["user_name"] . '</td>
                    <td>Royalty Income</td>
                    <td>Bonus From <b>' . $getdata["remark"] . '</b></td>
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
                    <td>Royalty Income</td>
                    <td>Transferred To Available Withdraw Balance</td>
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
    }


} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>