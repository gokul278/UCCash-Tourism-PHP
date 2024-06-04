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

            $bookingid = $_POST["bookingcode"];
            
            $data = $con->query("SELECT * FROM tourdestination WHERE id='{$bookingid}'");
            $getdata = $data->fetch_assoc();

            $daysplandata = "";
            
            $daysplan = json_decode($getdata['tour_daysplan'], true);
            foreach($daysplan as $index=>$getdaysplan){
                $daysplandata .= '
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading'.($index+1).'">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse'.($index+1).'"
                            aria-expanded="false" aria-controls="collapse'.($index+1).'">
                            <h5 style="background-color:#f7c128; padding: 10px; font-size: large;" align="center">Day '.($index+1).'
                            </h5>
                            <h6>&nbsp;&nbsp;&nbsp;&nbsp;'.$getdata["tour_name"].'</h6>
                        </button>
                    </h2>
                    <div id="collapse'.($index+1).'" class="accordion-collapse collapse"
                        aria-labelledby="heading'.($index+1).'" data-bs-parent="#accordionExample">
                        <div style="text-align: justify;" class="accordion-body">
                            '.$getdaysplan.'
                        </div>
                    </div>
                </div>
                ';
            }

            $response["tourid"] = $getdata["id"];
            $response["tour_thumbnail"] = $getdata["tour_thumbnail"];
            $response["tour_image1"] = $getdata["tour_image1"];
            $response["tour_image2"] = $getdata["tour_image2"];
            $response["tour_image3"] = $getdata["tour_image3"];
            $response["tour_image4"] = $getdata["tour_image4"];
            $response["tour_image5"] = $getdata["tour_image5"];
            $response["tour_name"] = $getdata["tour_name"];
            $response["tour_bookingcode"] = $getdata["tour_bookingcode"];
            $response["tour_days"] = $getdata["tour_days"];
            $response["tour_fromdate"] = $getdata["tour_fromdate"];
            $response["tour_todate"] = $getdata["tour_todate"];
            $response["tour_amount"] = $getdata["tour_amount"];
            $response["tour_inclusion"] = $getdata["tour_inclusion"];
            $response["tour_exclusion"] = $getdata["tour_exclusion"];
            $response["daysplandata"] = $daysplandata;


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