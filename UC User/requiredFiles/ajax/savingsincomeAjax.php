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

            $pointsdata = $con->query("SELECT * FROM savingsincome WHERE user_id='{$values["userid"]}'");


           if(mysqli_num_rows($pointsdata) >= 1){
            foreach($pointsdata as $getpointsdata){

                $dateString = $getpointsdata["si_createdat"];

                $parts = explode(" ", $dateString);

                $date = $parts[0];
                $time = $parts[1];

                if($getpointsdata["si_action"] == "credit"){
                    $credit += (float) $getpointsdata["si_points"];
                }else if($getpointsdata["si_action"] == "debit"){
                    $debit += (float) $getpointsdata["si_points"];
                }

                $index++;

                $name = $con->query("SELECT * FROM userdetails WHERE user_id='{$getpointsdata["si_bonusfrom"]}'");
                $getname = $name->fetch_assoc();

                $pointstable .= '
                <tr>
                    <th scope="row">'.$index.'</th>
                    <td>'.$date.'<p class="time">'.$time.'</p></td>
                    <td>'.$getpointsdata["si_bonusfrom"].'</td>
                    <td>'.$getname["user_name"].'</td>
                    <td>'.$getpointsdata["si_lvl"].'</td>
                    <td>'.$getpointsdata["si_remark"].'</td>
                ';

                if($getpointsdata["si_action"] == "credit"){

                    $pointstable .= '<td>'.number_format($getpointsdata["si_points"], 2).'</td><td></td>';

                }else if($getpointsdata["si_action"] == "debit"){

                    $pointstable .= '<td></td><td>'.number_format($getpointsdata["si_points"], 2).'</td>';

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