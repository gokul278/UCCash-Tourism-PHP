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
            
            $pointstable = "";
            $index = 0;

            $credit = 0;
            $debit = 0;

            $pointsdata = $con->query("SELECT * FROM royaltyincomewallet WHERE user_id='{$values["userid"]}'");


           if(mysqli_num_rows($pointsdata) >= 1){
            foreach($pointsdata as $getpointsdata){

                $dateString = $getpointsdata["riw_createdat"];

                $parts = explode(" ", $dateString);

                $date = $parts[0];
                $time = $parts[1];

                if($getpointsdata["riw_action"] == "credit"){
                    $credit += (float) $getpointsdata["riw_points"];
                }else if($getpointsdata["riw_action"] == "debit"){
                    $debit += (float) $getpointsdata["riw_points"];
                }

                $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getpointsdata["riw_bonusfrom"]}'");
                $getname = $name->fetch_assoc();

                $index++;

                $pointstable .= '
                <tr>
                    <th scope="row">'.$index.'</th>
                    <td>'.$date.'<p class="time">'.$time.'</p></td>
                    
                ';

                if($getpointsdata["riw_action"] == "credit"){

                    $pointstable .= '
                    <td>'.$getpointsdata["riw_bonusfrom"].'</td>
                    <td>'.$getname["user_name"].'</td>
                    <td>'.$getpointsdata["riw_lvl"].'</td>
                    <td>'.$getpointsdata["riw_remark"].'</td>
                    <td>'.number_format($getpointsdata["riw_points"], 2).'</td><td></td>';

                }else if($getpointsdata["riw_action"] == "debit"){

                    $pointstable .= '
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>'.$getpointsdata["riw_remark"].'</td>
                    <td></td><td>'.number_format($getpointsdata["riw_points"], 2).'</td>';

                }

                $pointstable .= '<td>'.number_format(($credit-$debit), 2).'</td>
                </tr>
                ';

            }
           }


            $response["pointstable"] = $pointstable;

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