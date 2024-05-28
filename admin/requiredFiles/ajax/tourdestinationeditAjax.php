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

        $tourdestinations = $con->query("SELECT * FROM tourdestination");

        $tabledata = "";

        foreach($tourdestinations as $index => $gettourdestinations){
            
            $tabledata .= '
            <tr">
                <th scope="row">'.($index+1).'</th>
                <td>
                    <figure>
                        <img src=".././UC User/img/tourdestination/'.$gettourdestinations["tour_image"].'" alt="image"
                            style="width: 100px; height: 100px;">
                        <figcaption>'.$gettourdestinations["tour_name"].'</figcaption>
                    </figure>
                </td>
                <td>'.$gettourdestinations["tour_bookingcode"].'</td>
                <td>'.$gettourdestinations["tour_days"].'</td>
                <td>'.$gettourdestinations["tour_fromdate"].'</td>
                <td>'.$gettourdestinations["tour_todate"].'</td>
                <td>'.$gettourdestinations["tour_time"].'</td>
                <td>'.$gettourdestinations["tour_amount"].'</td>
                <td>
                    <div>
                        <button type="button" style="width:80%" class="btn btn-warning"
                            <b>Edit</b>
                        </button><br>
                        <br>
                        <button type="button" style="width:80%" class="btn btn-danger"
                            <b>Delete</b>
                        </button>
                    </div>
                </td>
            </tr>
            ';

        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "newtour") {

        $tourimage = $_FILES["tourimage"]["name"];
        $tourname = $_POST["tourname"];
        $bokingcode = $_POST["bokingcode"];
        $days = $_POST["days"];
        $fromdate = $_POST["fromdate"];
        $todate = $_POST["todate"];
        $time = $_POST["time"];
        $amount = $_POST["amount"];
        
        $timestamp = date("YmdHis");

        $newImageName = $timestamp . '_' . $tourimage;


        if (move_uploaded_file($_FILES["tourimage"]["tmp_name"], "../../.././UC User/img/tourdestination/" . $newImageName)) {

            $addtour = $con->query("INSERT INTO tourdestination (tour_image,tour_name,tour_bookingcode,tour_days,tour_fromdate,tour_todate,tour_time,tour_amount)
            VALUES ('{$newImageName}','{$tourname}','{$bokingcode}','{$days}','{$fromdate}','{$todate}','{$time}','{$amount}')");

            if ($addtour) {
                $response["status"] = "success";
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