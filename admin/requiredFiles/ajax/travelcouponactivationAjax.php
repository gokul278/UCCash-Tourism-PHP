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

        $activationvalue = $con->query("SELECT * FROM idactivationvalue WHERE id=1");
        $getactivationvalue = $activationvalue->fetch_assoc();

        $response["activationvalue"] = $getactivationvalue["value"];

        $address = $con->query("SELECT * FROM idactivationdeposite WHERE id=1");
        $getaddress = $address->fetch_assoc();

        $response["crypto_value"] = $getaddress["crypto_value"];

        $details = $con->query("SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'");

        $getdetails = $details->fetch_assoc();

        $response["profile_image"] = $getdetails["admin_profile"];

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "updateactivationvalue") {

        $activationvalue = $_POST["activationvalue"];

        $updatevalue = $con->query("UPDATE idactivationvalue SET value='{$activationvalue}' WHERE id=1");

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "getusername") {

        $user_id = $_POST["userid"];

        $user = $con->query("SELECT * FROM userdetails WHERE user_id='{$user_id}'");

        if (mysqli_num_rows($user) >= 1) {

            $getuser = $user->fetch_assoc();
            $response["message"] = $getuser["user_name"];
            $response["status"] = "success";
            echo json_encode($response);


        } else {

            $response["message"] = "noid";
            $response["status"] = "success";
            echo json_encode($response);

        }

    } else if ($way == "idactivation") {

        $password = $_POST["adminpass"];

        $checkidsql = "SELECT * FROM admindetails WHERE admin_id = '{$values["admin_id"]}'";
        $checkidres = $con->query($checkidsql);

        if (mysqli_num_rows($checkidres) == 1) {

            $row = $checkidres->fetch_assoc();

            if (md5($password) == $row["admin_password"]) {

                $userid = $_POST["userid"];

                $useractivation = $con->query("SELECT * FROM userdetails WHERE user_id='{$userid}' AND user_referalStatus='activated'");


                if (mysqli_num_rows($useractivation) >= 1) {

                    $response["message"] = "User Already Activated";
                    $response["status"] = "error";
                    echo json_encode($response);

                } else {

                    $crypto_value = $_POST["cryptovalue"];
                    $txnhashid = $_POST["txnid"];

                    $id = $con->query("SELECT MAX(id) AS max_id FROM idactivationhistory");

                    $idactivationid = "";

                    if (mysqli_num_rows($id) >= 1) {
                        $getid = $id->fetch_assoc();
                        $idval = (int) $getid["max_id"];
                        $idactivationid = "IAI-" . ($idval + 1);
                    } else {
                        $idactivationid = "IAI-1";
                    }


                    $insertactivationid = $con->query("INSERT INTO idactivation (idactivation_id,user_id,deposite_type,txnhashid,action) VALUES
                    ('{$idactivationid}','{$userid}','Crypto','{$txnhashid}','admin')");

                    $id = $con->query("SELECT MAX(id) AS max_id FROM idactivation WHERE user_id='{$userid}'");

                    $getid = $id->fetch_assoc();

                    $tcvalue = $con->query("SELECT * FROM idactivationvalue");
                    $gettcvalue = $tcvalue->fetch_assoc();


                    $insertactivationidhistory = $con->query("INSERT INTO idactivationhistory (idactivation_id,user_id,deposite_type,crypto_value,txnhash_id,travel_coupon,action,remark) VALUES
                    ('{$idactivationid}',  '{$userid}', 'Crypto', '{$crypto_value}', '{$txnhashid}', '{$gettcvalue["value"]}','admin', 'Waiting for Approval')");

                    $lvl1 = "";
                    $lvl2 = "";
                    $lvl3 = "";
                    $lvl4 = "";
                    $lvl5 = "";
                    $lvl6 = "";
                    $lvl7 = "";
                    $lvl8 = "";
                    $lvl9 = "";

                    $genealogy = $con->query("SELECT * FROM genealogy WHERE user_id='{$userid}'");

                    foreach ($genealogy as $getgenealogy) {
                        $lvl1 = isset($getgenealogy["lvl1"]) ? $getgenealogy["lvl1"] : "";
                        $lvl2 = isset($getgenealogy["lvl2"]) ? $getgenealogy["lvl2"] : "";
                        $lvl3 = isset($getgenealogy["lvl3"]) ? $getgenealogy["lvl3"] : "";
                        $lvl4 = isset($getgenealogy["lvl4"]) ? $getgenealogy["lvl4"] : "";
                        $lvl5 = isset($getgenealogy["lvl5"]) ? $getgenealogy["lvl5"] : "";
                        $lvl6 = isset($getgenealogy["lvl6"]) ? $getgenealogy["lvl6"] : "";
                        $lvl7 = isset($getgenealogy["lvl7"]) ? $getgenealogy["lvl7"] : "";
                        $lvl8 = isset($getgenealogy["lvl8"]) ? $getgenealogy["lvl8"] : "";
                        $lvl9 = isset($getgenealogy["lvl9"]) ? $getgenealogy["lvl9"] : "";
                    }

                    $idactivationhistory = $con->query("SELECT * FROM idactivationhistory WHERE user_id='{$userid}' AND action='admin'");
                    $getidactivationhistory = $idactivationhistory->fetch_assoc();
                    $tcvalue = (int) $getidactivationhistory["travel_coupon"];

                    //Travel Coupon Wallet
                    $travelcoupon = $con->query("INSERT INTO travelcouponpoints (user_id,tc_points,tc_action,tc_remark)
                    VALUES ('{$userid}','{$tcvalue}','credit','Travel Coupon')");

                    //Bonus Travel Point Wallet
                    for ($i = 1; $i <= 9; $i++) {

                        $value = $tcvalue * 0.0166; // 1.66 % * tcvalue

                        $lvl = ${"lvl" . $i};

                        if (strlen($lvl) >= 5) {
                            $btpoint = $con->query("INSERT INTO bonustravelpoints (user_id,bt_points,bt_bonusfrom,bt_lvl,bt_action,bt_remark)
                            VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Bonus Travel Points')");
                        }

                    }

                    //Networking Income Wallet
                    for ($i = 1; $i <= 9; $i++) {

                        $value = 0;

                        if ($i == 1) { //lvl 1
                            $value = $tcvalue * 0.1; // 10% * tcvalue
                        } else if ($i == 2) { //lvl 2
                            $value = $tcvalue * 0.05; // 5% * tcvalue
                        } else if ($i == 3) { //lvl 3
                            $value = $tcvalue * 0.03; // 3% * tcvalue
                        } else if ($i == 4) { //lvl4
                            $value = $tcvalue * 0.02; // 2% * tcvalue
                        } else if ($i >= 5 && $i <= 9) {
                            $value = $tcvalue * 0.01; // 1% * tcvalue
                        }

                        $lvl = ${"lvl" . $i};

                        if (strlen($lvl) >= 5) {
                            $btpoint = $con->query("INSERT INTO networkingincomewallet (user_id,niw_points,niw_bonusfrom,niw_lvl,niw_action,niw_remark)
                            VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Networking Income')");
                        }

                    }

                    //Leadership Income Wallet
                    for ($i = 1; $i <= 9; $i++) {

                        $value = $tcvalue * 0.0044; // 0.44 % * tcvalue

                        $lvl = ${"lvl" . $i};

                        if (strlen($lvl) >= 5) {
                            $btpoint = $con->query("INSERT INTO leadershipincomewallet (user_id,liw_points,liw_bonusfrom,liw_lvl,liw_action,liw_remark)
                            VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Leadership Income')");
                        }

                    }

                    //Car&House Fund Wallet
                    for ($i = 1; $i <= 9; $i++) {

                        $value = $tcvalue * 0.0055; // 0.55 % * tcvalue

                        $lvl = ${"lvl" . $i};

                        if (strlen($lvl) >= 5) {
                            $btpoint = $con->query("INSERT INTO carandhousefundwallet (user_id,chfw_points,chfw_bonusfrom,chfw_lvl,chfw_action,chfw_remark)
                            VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Car & House Fund')");
                        }

                    }

                    //Royalty Income Wallet
                    for ($i = 1; $i <= 9; $i++) {

                        $value = $tcvalue * 0.0066; // 0.66 % * tcvalue

                        $lvl = ${"lvl" . $i};

                        if (strlen($lvl) >= 5) {
                            $btpoint = $con->query("INSERT INTO royaltyincomewallet (user_id,riw_points,riw_bonusfrom,riw_lvl,riw_action,riw_remark)
                            VALUES ('{$lvl}','{$value}','{$userid}','{$i}','credit','Royalty Income')");
                        }

                    }


                    $approveactivation = $con->query("UPDATE idactivation SET action='paid', remark='' WHERE idactivation_id='{$idactivationid}'");

                    $approvehistory = $con->query("UPDATE idactivationhistory SET action='paid', remark='Activation Successful' WHERE idactivation_id='{$idactivationid}'");
            
                    $approveuserdeatils = $con->query("UPDATE userdetails SET user_referalStatus='activated' WHERE user_id='{$userid}'");
            
                    
                    $response["status"] = "success";
                    echo json_encode($response);
                    

                }

            } else {

                $response["message"] = "Incorrect Password";
                $response["status"] = "error";
                echo json_encode($response);

            }
        }


    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>