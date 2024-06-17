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

        $tabledata = "";

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

        $genealogy = $con->query("
        SELECT *
        FROM genealogy AS g
        JOIN userdetails AS u ON g.user_id = u.user_id
        WHERE u.user_referalStatus = 'activated';
        ");

        $activation = $con->query("SELECT * FROM userdetails WHERE user_referalStatus = 'activated'");

        $totalperson = mysqli_num_rows($activation) - 1;

        $awcredit += ($totalperson * 50) * 0.4521;


        foreach ($genealogy as $getgenealogy) {

            if ($getgenealogy["lvl1"] == null || strlen($getgenealogy["lvl1"]) <= 2) {
                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl2"] == null || strlen($getgenealogy["lvl2"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 2.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl3"] == null || strlen($getgenealogy["lvl3"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 1.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl4"] == null || strlen($getgenealogy["lvl4"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 1;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl5"] == null || strlen($getgenealogy["lvl5"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl6"] == null || strlen($getgenealogy["lvl6"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl7"] == null || strlen($getgenealogy["lvl7"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl8"] == null || strlen($getgenealogy["lvl8"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl9"] == null || strlen($getgenealogy["lvl9"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }


        }

        $data = $con->query("
        SELECT
            aw_id as record_id,
            aw_createdat as record_date,
            aw_points as points,
            aw_action as action,
            aw_remark as decription,
            'adminwallet' as source_table
        from admin_wallet WHERE aw_action='debit'
        UNION ALL
        SELECT 
            agst_id as record_id,
            agst_createdat as record_date,
            agst_points as points,
            agst_action as action,
            agst_remark as decription,
            'admingstwallet' as source_table
        from admingst_wallet WHERE agst_action='debit'
        ORDER BY record_date;
        ");

        foreach ($data as $index => $getdata) {

            if ($getdata["source_table"] == "adminwallet") {
                $tabledata .= '
                <tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $getdata["record_date"] . '</td>
                    <td>Admin Wallet Balance</td>
                    <td>' . $getdata["decription"] . '</td>
                    <td>' . $getdata["points"] . '</td>
                    <td> <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#wallet' . $index . '">
                            Edit
                        </button>
                        <div class="modal fade" id="wallet' . $index . '" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #191C24;">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Description</h1>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3" align="start">
                                                <div class="col-12">
                                                    <label for="referralid" class="col-form-label">Description</label>
                                                    <input type="text" class="form-control disabled-input" value="' . $getdata["decription"] . '"
                                                        id="description' . $getdata["record_id"] . '" style="height: 50px;" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="submitwalletdescription(this)" id="' . $getdata["record_id"] . '" data-bs-dismiss="modal">Update</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </td>
                </tr>
                ';
            } else if ($getdata["source_table"] == "admingstwallet") {
                $tabledata .= '
                <tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $getdata["record_date"] . '</td>
                    <td>Admin GST Balance</td>
                    <td>' . $getdata["decription"] . '</td>
                    <td>' . $getdata["points"] . '</td>
                    <td> <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#gst' . $index . '">
                            Edit
                        </button>
                        <div class="modal fade" id="gst' . $index . '" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #191C24;">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Description</h1>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3" align="start">
                                                <div class="col-12">
                                                    <label for="referralid" class="col-form-label">Description</label>
                                                    <input type="text" class="form-control disabled-input" value="' . $getdata["decription"] . '"
                                                        id="description' . $getdata["record_id"] . '" style="height: 50px;" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="submitgstdescription(this)" id="' . $getdata["record_id"] . '" data-bs-dismiss="modal">Update</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </td>
                </tr>
                ';
            }

        }

        $response["tabledata"] = $tabledata;

        //GST Wallet
        $admingstwallet = $con->query("SELECT * FROM admingst_wallet");
        $agstcredit = ($totalperson * 9);
        $agstdebit = 0;

        if (mysqli_num_rows($admingstwallet) >= 1) {

            foreach ($admingstwallet as $getadmingstwallet) {
                if (isset($getadmingstwallet["agst_action"]) && strlen($getadmingstwallet["agst_action"]) >= 1) {
                    if ($getadmingstwallet["agst_action"] == "credit") {
                        $agstcredit += (float) $getadmingstwallet["agst_points"];
                    } else if ($getadmingstwallet["agst_action"] == "debit") {
                        $agstdebit += (float) $getadmingstwallet["agst_points"];
                    }
                }
            }

        }

        $response["balanceadmingst"] = number_format($agstcredit - $agstdebit, 2);

        $response["balanceadminnwallet"] = number_format($awcredit - $awdebit, 2);

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "withdrawamount") {

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

        $genealogy = $con->query("
        SELECT *
        FROM genealogy AS g
        JOIN userdetails AS u ON g.user_id = u.user_id
        WHERE u.user_referalStatus = 'activated';
        ");

        $activation = $con->query("SELECT * FROM userdetails WHERE user_referalStatus = 'activated'");

        $totalperson = mysqli_num_rows($activation) - 1;

        $awcredit += ($totalperson * 50) * 0.4521;


        foreach ($genealogy as $getgenealogy) {

            if ($getgenealogy["lvl1"] == null || strlen($getgenealogy["lvl1"]) <= 2) {
                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl2"] == null || strlen($getgenealogy["lvl2"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 2.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl3"] == null || strlen($getgenealogy["lvl3"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 1.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl4"] == null || strlen($getgenealogy["lvl4"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 1;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl5"] == null || strlen($getgenealogy["lvl5"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl6"] == null || strlen($getgenealogy["lvl6"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl7"] == null || strlen($getgenealogy["lvl7"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl8"] == null || strlen($getgenealogy["lvl8"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }

            if ($getgenealogy["lvl9"] == null || strlen($getgenealogy["lvl9"]) <= 2) {

                //Bonus Travel Point Wallet
                $awcredit += 0.83;

                //Networking Income Wallet
                $awcredit += 0.5;

                //Leadership Income Wallet
                $awcredit += 0.22;

                //Car&House Fund Wallet
                $awcredit += 0.275;

                //Royalty Income Wallet
                $awcredit += 0.33;

            }


        }

        $adminwalletbalance = round(($awcredit - $awdebit), 2);

        //GST Wallet
        $admingstwallet = $con->query("SELECT * FROM admingst_wallet");
        $agstcredit = ($totalperson * 9);
        $agstdebit = 0;

        if (mysqli_num_rows($admingstwallet) >= 1) {

            foreach ($admingstwallet as $getadmingstwallet) {
                if (isset($getadmingstwallet["agst_action"]) && strlen($getadmingstwallet["agst_action"]) >= 1) {
                    if ($getadmingstwallet["agst_action"] == "credit") {
                        $agstcredit += (float) $getadmingstwallet["agst_points"];
                    } else if ($getadmingstwallet["agst_action"] == "debit") {
                        $agstdebit += (float) $getadmingstwallet["agst_points"];
                    }
                }
            }

        }

        $admingstbalance = number_format($agstcredit - $agstdebit, 2);

        $withdrawamount = $_POST["withdrawamount"];
        $password = $_POST["password"];
        $description = $_POST["description"];
        $wallettype = $_POST["wallettype"];

        $checkidsql = "SELECT * FROM admindetails WHERE admin_id='{$values["admin_id"]}'";
        $checkidres = $con->query($checkidsql);

        if (mysqli_num_rows($checkidres) == 1) {

            $row = $checkidres->fetch_assoc();

            if (md5($password) == $row["admin_password"]) {

                if ($wallettype == "adminwalletbalance") {

                    if ($adminwalletbalance >= $withdrawamount) {

                        $debit = $con->query("INSERT INTO admin_wallet (aw_points, aw_action, aw_remark) VALUES ('{$withdrawamount}','debit','{$description}')");

                        if ($debit) {

                            $response["status"] = "success";

                        } else {

                            $response["status"] = "error";
                            $response["message"] = "error";

                        }

                    } else {
                        $response["status"] = "error";
                        $response["message"] = "Insufficient Balance";
                    }

                } else if ($wallettype == "admingstbalance") {

                    if ($admingstbalance >= $withdrawamount) {

                        $debit = $con->query("INSERT INTO admingst_wallet (agst_points, agst_action, agst_remark) VALUES ('{$withdrawamount}','debit','{$description}')");

                        if ($debit) {

                            $response["status"] = "success";

                        } else {

                            $response["status"] = "error";
                            $response["message"] = "error";

                        }

                    } else {
                        $response["status"] = "error";
                        $response["message"] = "Insufficient Balance";
                    }

                }


            } else {
                $response["status"] = "error";
                $response["message"] = "Invalid Password";
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Not Found";
        }

        echo json_encode($response);

    } else if ($way == "updatewalletdescription") {
        $id = $_POST["id"];
        $description = $_POST["description"];

        $update = $con->query("UPDATE admin_wallet SET aw_remark='{$description}' WHERE aw_id='{$id}'");

        if ($update) {
            $response["status"] = "success";
            echo json_encode($response);
        }
    }else if ($way == "updategstdescription") {
        $id = $_POST["id"];
        $description = $_POST["description"];

        $update = $con->query("UPDATE admingst_wallet SET agst_remark='{$description}' WHERE agst_id='{$id}'");

        if ($update) {
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