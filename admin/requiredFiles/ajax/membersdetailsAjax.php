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

        $data = $con->query("SELECT * FROM userdetails");

        $tabledata = "";

        $btn = "";

        foreach ($data as $index => $getdata) {

            $btn = "";


            if ($getdata["user_referalStatus"] == "activated") {
                $idactivation = $con->prepare("SELECT * FROM idactivation WHERE user_id=?");
                $idactivation->bind_param("s", $getdata["user_id"]);
                $idactivation->execute();
                $getidactivation = $idactivation->get_result();

                if ($getidactivation->num_rows > 0) {
                    $row = $getidactivation->fetch_assoc();
                    $certificateid = $row["idactivation_id"];
                    $btn = '<button class="btn btn-info" onclick="downloadinvoice(\'' . $certificateid . '\')">Invoice</button>';
                }
            } else {
                $btn = "";
            }

            $bankdetails = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$getdata["user_id"]}'");
            $getbankdetails = $bankdetails->fetch_assoc();

            $bankdetails = $con->query("SELECT * FROM userbankdetails WHERE user_id='{$getdata["user_id"]}'");
            if ($bankdetails && $bankdetails->num_rows > 0) {
                if ($getbankdetails["trc20_address"] == null) {
                    $trc20 = "";
                    $bep20 = "";

                    $bank = "";
                } else {
                    $trc20 = $getbankdetails["trc20_address"];
                    $bep20 = $getbankdetails["bep20_address"];

                    $bank = $getbankdetails["ac_holdername"] . ',<br>' . $getbankdetails["ac_bankname"] . ',<br>' . $getbankdetails["ac_number"] . ',<br>' . $getbankdetails["ifsc_code"] . ',<br>' . $getbankdetails["branch"];
                }
            } else {
                $trc20 = "";
                $bep20 = "";

                $bank = "";
            }




            $memberstatus = "Member";
            $rank = "-";

            // Check if the sponsor's referral status is activated
            if ($getdata["user_referalStatus"] == "activated") {
                $memberstatus = "Distributor";
            }

            // Initialize arrays to hold level queries and thresholds
            $levels = ["lvl1" => 5, "lvl2" => 25, "lvl3" => 125, "lvl4" => 375, "lvl5" => 1500, "lvl6" => 5000, "lvl7" => 5000];
            $ranks = ["lvl1" => "Director", "lvl2" => "Senior Director", "lvl3" => "Bronze Director", "lvl4" => "Silver Director", "lvl5" => "Gold Director", "lvl6" => "Diamond Director", "lvl7" => "Crow Director"];

            // Loop through each level and determine the rank based on activated members
            foreach ($levels as $level => $threshold) {
                // Query to get activated members at the current level
                $levelQuery = $con->query("SELECT user_id FROM genealogy WHERE $level='{$getdata["user_id"]}'");

                // Count the number of activated members
                $activatedCount = 0;
                while ($row = $levelQuery->fetch_assoc()) {
                    $account = $con->query("SELECT user_referalStatus FROM userdetails WHERE user_id='{$row["user_id"]}'");
                    $getaccount = $account->fetch_assoc();
                    if ($getaccount["user_referalStatus"] == "activated") {
                        $activatedCount++;
                    }
                }

                // Check if the count meets or exceeds the threshold for this level
                if ($activatedCount >= $threshold) {
                    $rank = $ranks[$level];
                }
            }





            if ($getdata["user_id"] != "UCT99999") {
                $tabledata .= '
            <tr>
                <td>' . ($index) . '</td>
                <td>' . $getdata["user_id"] . '</td>
                <td>' . $getdata["user_name"] . '</td>
                <td>' . $getdata["user_email"] . '</td>
                <td>' . $getdata["user_phoneno"] . '</td>
                <td>' . $getdata["user_address"] . ',<br>' . $getdata["user_city"] . ',<br>' . $getdata["user_state"] . ',<br>' . $getdata["user_country"] . ',<br>Pincode-' . $getdata["user_zipcode"] . '</td>
                <td>' . $trc20 . '</td>
                <td>' . $bep20 . '</td>
                <td>' . $bank . '</td>
                <td>' . $getdata["user_panno"] . '</td>
                <td>' . $getdata["user_panno"] . '</td>
                <td>' . $memberstatus . '</td>
                <td>' . $rank . '</td>
                <td><a class="btn btn-success" href="members income balance sheet.php?userid=' . $getdata["user_id"] . '">Go</a></td>
                <td>' . $btn . '</td>
            </tr>
            ';
            }
        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
