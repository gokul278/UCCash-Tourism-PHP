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

            $rewardData = [];
            $pointsdata = $con->query("SELECT * FROM rewardbonus WHERE user_id = '{$values["userid"]}' ORDER BY rb_id DESC");

            if (mysqli_num_rows($pointsdata) >= 1) {
                foreach ($pointsdata as $row) {
                    $rewardData[] = [
                        "rb_start" => $row["rb_start"],
                        "rb_end" => $row["rb_end"],
                        "rb_usercount" => $row["rb_usercount"],
                        "rb_point" => $row["rb_point"] ?? "-"
                    ];
                }
            }

            $response["rewards"] = $rewardData;
            $response["status"] = "success";
            echo json_encode($response);
        }
    }
} else {
    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
