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

            $pointsdata = $con->query("SELECT * FROM carandhousefundwallet WHERE user_id='{$values["userid"]}'");


           if(mysqli_num_rows($pointsdata) >= 1){
            foreach($pointsdata as $getpointsdata){

                $dateString = $getpointsdata["chfw_createdat"];

                $parts = explode(" ", $dateString);

                $date = $parts[0];
                $time = $parts[1];

                if($getpointsdata["chfw_action"] == "credit"){
                    $credit += (float) $getpointsdata["chfw_points"];
                }else if($getpointsdata["chfw_action"] == "debit"){
                    $debit += (float) $getpointsdata["chfw_points"];
                }

                $index++;

                $pointstable .= '
                <tr>
                    <th scope="row">'.$index.'</th>
                    <td>'.$date.'<p class="time">'.$time.'</p></td>
                    <td>'.$getpointsdata["chfw_bonusfrom"].'</td>
                    <td>'.$getpointsdata["chfw_lvl"].'</td>
                    <td>'.$getpointsdata["chfw_remark"].'</td>
                ';

                if($getpointsdata["chfw_action"] == "credit"){

                    $pointstable .= '<td>'.number_format($getpointsdata["chfw_points"], 2).'</td><td></td>';

                }else if($getpointsdata["chfw_action"] == "debit"){

                    $pointstable .= '<td></td><td>'.number_format($getpointsdata["chfw_points"], 2).'</td>';

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