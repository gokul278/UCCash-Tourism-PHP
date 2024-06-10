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

        $data = $con->query("SELECT * FROM savingstravelpoints");

        $tabledata = "";

        $stcredit = 0;
        $stdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["st_action"]) && strlen($getdata["st_action"]) >= 1) {
                if ($getdata["st_action"] == "credit") {
                    $stcredit += (float) $getdata["st_points"];
                } else if ($getdata["st_action"] == "debit") {
                    $stdebit += (float) $getdata["st_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $stcredit - $stdebit;

            if ($getdata["st_action"] == "credit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>From<span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . '</span> ID</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';

                }

               

            } else if ($getdata["st_action"] == "debit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';
                }


            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($stcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($stdebit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "userfilter") {

        $userid = $_POST["userid"];

        $data = $con->query("SELECT * FROM savingstravelpoints WHERE user_id='{$userid}'");

        $tabledata = "";

        $stcredit = 0;
        $stdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["st_action"]) && strlen($getdata["st_action"]) >= 1) {
                if ($getdata["st_action"] == "credit") {
                    $stcredit += (float) $getdata["st_points"];
                } else if ($getdata["st_action"] == "debit") {
                    $stdebit += (float) $getdata["st_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $stcredit - $stdebit;

            if ($getdata["st_action"] == "credit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>From<span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . '</span> ID</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["st_action"] == "debit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';
                }

            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($stcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($stdebit, 2) . '</b>';
        $response["totalbalance"] = '<b>' . number_format($balance, 2) . '</b>';

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "datefilter") {

        $fromdate = $_POST["fromdate"]." 00:00:00";
        $todate = $_POST["todate"]." 23:59:00";

        $data = $con->query("SELECT * FROM savingstravelpoints WHERE st_createdat BETWEEN '{$fromdate}' AND '{$todate}'");

        $tabledata = "";

        $stcredit = 0;
        $stdebit = 0;
        $balance = 0;

        foreach ($data as $index => $getdata) {

            if (isset($getdata["st_action"]) && strlen($getdata["st_action"]) >= 1) {
                if ($getdata["st_action"] == "credit") {
                    $stcredit += (float) $getdata["st_points"];
                } else if ($getdata["st_action"] == "debit") {
                    $stdebit += (float) $getdata["st_points"];
                }
            }

            $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getdata["user_id"]}'");
            $getname = $name->fetch_assoc();

            $balance = $stcredit - $stdebit;

            if ($getdata["st_action"] == "credit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>From<span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . '</span> ID</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td></td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';

                }

            } else if ($getdata["st_action"] == "debit") {

                if($getdata["st_remark"] == "transfer"){

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td><span style="color: #f7c128;"> ' . $getdata["st_bonusfrom"] . ' ID</span></td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                ';

                }else{

                    $tabledata .= '
                    <tr>
                        <th scope="row">' . ($index + 1) . '</th>
                        <td>' . $getdata["user_id"] . '</td>
                        <td>' . $getname["user_name"] . '</td>
                        <td>Tour Booking</td>
                        <td>' . $getdata["st_createdat"] . '</td>
                        <td></td>
                        <td>' . $getdata["st_points"] . '</td>
                        <td>' . $balance . '</td>
                    </tr>
                    ';
                }

            }

        }


        $response["tabledata"] = $tabledata;

        $response["totalcredit"] = '<b>' . number_format($stcredit, 2) . '</b>';
        $response["totaldebit"] = '<b>-&nbsp;' . number_format($stdebit, 2) . '</b>';
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