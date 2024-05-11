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
            $tabledata = ''; // Initialize an empty string to store the table data
            $index = 0; // Initialize an index counter

            for ($lvls = 1; $lvls <= 9; $lvls++) {
                $levelColumn = "lvl{$lvls}";

                // Fetch data from the database for the current level
                $result = $con->query("SELECT * FROM genealogy WHERE {$levelColumn}='{$values["userid"]}'");

                foreach ($result as $row) {
                    $userdetails = $con->query("SELECT * FROM userdetails WHERE user_id='{$row["user_id"]}'");

                    foreach ($userdetails as $getuserdetails) {
                        $index++;
                        $tabledata .= "
                        <tr>
                            <th scope='row'>{$index}</th>
                            <td>{$getuserdetails["user_id"]}</td>
                            <td>{$getuserdetails["user_name"]}</td>
                        ";
                        if ($getuserdetails["user_referalStatus"] == "activated") {
                            $tabledata .= "
                                <td style='color:green'>Distributor</td>
                            ";
                        } else if ($getuserdetails["user_referalStatus"] == "notactivated") {
                            $tabledata .= "
                                <td style='color:red'>Member</td>
                            ";
                        }

                        $tabledata .= "
                            <td>{$lvls}</td>
                            <td></td>
                        </tr>";
                    }
                }
            }


            $response["tabledata"] = $tabledata;

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