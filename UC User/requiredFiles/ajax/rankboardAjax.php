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

            $tabledata = "";

            $tabledata .= "<tr>
            <th scope='row'>1</th>
            <td>5</td>
            <td>Director</td>
            <td>Bonus Travel Point Redeem</td>
            ";

            $level1 = $con->query("SELECT * FROM genealogy WHERE lvl1='{$values["userid"]}'");
            $level1number = $level1->num_rows;

            if($level1number >= 5){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>2</th>
            <th>25</th>
            <td>Senior Director</td>
            <td>Leadership Income Redeem</td>
            ";

            $level2 = $con->query("SELECT * FROM genealogy WHERE lvl2='{$values["userid"]}'");
            $level2number = $level2->num_rows;

            if($level2number >=  25){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>3</th>
            <th>125</th>
            <td>Bronze Director</td>
            <td>Car & House Fund Redeem</td>
            ";

            $level3 = $con->query("SELECT * FROM genealogy WHERE lvl3='{$values["userid"]}'");
            $level3number = $level3->num_rows;

            if($level3number >= 125){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>4</th>
            <th>375</th>
            <td>Silver Director</td>
            <td>Royalty Income Redeem</td>
            ";

            $level4 = $con->query("SELECT * FROM genealogy WHERE lvl4='{$values["userid"]}'");
            $level4number = $level4->num_rows;

            if($level4number >= 375){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>5</th>
            <th>1500</th>
            <td>Gold Director</td>
            <td>2 Lakh Car Fund**</td>
            ";

            $level5 = $con->query("SELECT * FROM genealogy WHERE lvl5='{$values["userid"]}'");
            $level5number = $level5->num_rows;

            if($level5number >= 1500){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>6</th>
            <th>5000</th>
            <td>Diamond Director</td>
            <td>5 Lakh Diamond Reward</td>
            ";

            $level6 = $con->query("SELECT * FROM genealogy WHERE lvl6='{$values["userid"]}'");
            $level6number = $level6->num_rows;

            if($level6number >= 5000){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
            }


            $tabledata .= "<tr>
            <th scope='row'>7</th>
            <th>15000</th>
            <td>Crow Director</td>
            <td>15 Lakh worth Fully Paid Car</td>
            ";

            $level7 = $con->query("SELECT * FROM genealogy WHERE lvl7='{$values["userid"]}'");
            $level7number = $level7->num_rows;

            if($level7number >= 15000){
                $tabledata .= '<td class="green">Achieved</td></tr>';
            }else{
                $tabledata .= '<td class="red">Not Achieved</td></tr>';
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