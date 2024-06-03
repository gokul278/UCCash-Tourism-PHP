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

            $data = $con->query("SELECT * FROM tourdestination");

            $carddata = "";

            foreach($data as $index=>$getdata){
                $carddata .= '
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="img/tourdestination/'.$getdata["tour_thumbnail"].'" class="img-fluid w-100 rounded-top" alt="img" style="width:275px;height:378px">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>'.$getdata["tour_days"].'</small>
                        </div>
                    </div>
                    <div class="packages-content bg-light">
                        <div style="text-align: center;" class="p-4 pb-0">
                            <h5 class="mb-0">Thailand</h5>
                            <small  class="text-uppercase">'.$getdata["tour_days"].'</small>
                            
                            <p class="mb-4">'.$getdata["tour_amount"].'</p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="#" class="btn-hover btn text-white py-2 px-4"><b>Booking Code-'.$getdata["tour_bookingcode"].'</b></a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <a href="tour description.php?bookingcode='.$getdata["tour_bookingcode"].'" class="btn-hover btn text-white py-2 px-4"><b>View Details</b></a>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            
            $response["carddata"] = $carddata;
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