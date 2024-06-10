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

        $count = 0;

        $data = $con->query("SELECT * FROM tourdestination");

        foreach ($data as $index => $getdata) {

            $count++;

            $daysplan = json_decode($getdata['tour_daysplan'], true);

            $i = 0;
            $plan = "";

            foreach ($daysplan as $dayplan) {
                $i++;

                if ($i == 1) {
                    $plan .= '
            <div class="form-group mb-2">
                <label for="days' . $count . '' . $i . '">Day ' . $i . '</label>
                <textarea class="form-control day-1-textbox"
                    name="days' . $i . '" id="days' . $count . '' . $i . '" placeholder="' . htmlspecialchars($dayplan) . '"
                    style="height: 100px;" required>' . htmlspecialchars($dayplan) . '</textarea>
            </div>
            ';
                } else {
                    $plan .= '
            <div class="form-group mb-2" id="box' . $count . '' . $i . '">
                <label for="days' . $count . '' . $i . '">Day ' . $i . '</label>
                <textarea class="form-control day-1-textbox"
                    name="days' . $i . '" id="days' . $count . '' . $i . '" placeholder="' . htmlspecialchars($dayplan) . '"
                    style="height: 100px;" re
                    quired>' . htmlspecialchars($dayplan) . '</textarea>
            </div>';
                }
            }

            $tabledata .= '
                    <tr>
                        <th scope="row">' . $count . '</th>
                        <td>
                            <figure>
                                <img src="../UC User/img/tourdestination/' . $getdata["tour_thumbnail"] . '" alt="image"
                                    style="width: 100px; height: 100px;">
                                <figcaption>' . $getdata["tour_name"] . '</figcaption>
                            </figure>
                        </td>
                        <td>' . $getdata["tour_bookingcode"] . '</td>
                        <td>' . $getdata["tour_days"] . '</td>
                        <td>' . $getdata["tour_fromdate"] . '</td>
                        <td>' . $getdata["tour_todate"] . '</td>
                        <td>' . $getdata["tour_amount"] . ' $</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal' . $count . '">
                                <b>Edit</b>
                            </button>
                            <br/>
                            <br/>
                            <!-- <button type="button" class="btn btn-danger" tourid="' . $getdata['id'] . '" onclick="deletetour(this)">
                            <b>Delete</b>
                        </button> --!>
                            <div class="modal fade" id="exampleModal' . $count . '" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel' . $count . '" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="color: #000;" class="modal-title" id="exampleModalLabel' . $count . '">
                                                                Update Tour Destination Details</h5>
                                                            <button type="button" class="close btn btn-danger"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" align="start">
                                                            <strong>
                                                                <form class="custom-form" id="updatedestination' . $getdata['id'] . '">
                                                                    <div class="mb-3" style="margin-bottom: 15px;">
                                                                        <label for="formFileMultiple"
                                                                            style="font-weight: bold; color: #fff;">Upload
                                                                            Images</label>
                                                                        <div class="image-upload-model">
                                                                            <!-- Image 1 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Thumbnail" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="thumbnail" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                            <!-- Image 2 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Image1" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="image1" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                            <!-- Image 3 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Image2" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="image2" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                            <!-- Image 4 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Image3" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="image3" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                            <!-- Image 5 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Image4" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="image4" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                            <!-- Image 6 -->
                                                                            <div class="file-input-container" data-placeholder="Choose Image5" data-filename="">
                                                                                <input type="file" accept="image/*"
                                                                                    name="image5" required
                                                                                    onchange="this.parentNode.setAttribute(\'data-filename\', this.files[0].name); this.parentNode.classList.add(\'file-selected\');">
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="imgdescribe">Image Country :</label>
                                                                        <input type="text" class="form-control" name="imgdescribe" id="imgdescribe"
                                                                            placeholder="Enter Image Country" value="' . $getdata['tour_name'] . '" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="bookingCode">Booking Code :</label>
                                                                        <input type="text" class="form-control" name="bookingcode" id="bookingCode" value="' . $getdata['tour_bookingcode'] . '" placeholder="Enter booking code" readonly required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="days">Days :</label>
                                                                        <input type="text" class="form-control" name="days" value="' . $getdata['tour_days'] . '" id="days"
                                                                            placeholder="Enter days" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="fromDate">From Date :</label>
                                                                        <input type="date" class="form-control" name="fromDate" id="fromDate" value="' . $getdata['tour_fromdate'] . '"
                                                                            placeholder="Enter from date" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="toDate">To Date :</label>
                                                                        <input type="date" class="form-control" name="toDate" id="toDate" value="' . $getdata['tour_todate'] . '"
                                                                            placeholder="Enter to date" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="amount">Amount :</label>
                                                                        <input type="number" class="form-control" name="amount" id="amount" value="' . $getdata['tour_amount'] . '"
                                                                            placeholder="Enter amount" required>
                                                                    </div>
                                                                    <div id="form-container">
                                                                        <div id="textboxes' . $count . '">
                                                                        ' . $plan . '
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <button type="button" id="textboxbtn' . $count . '"
                                                                                class="btn btn-success" max="' . $i . '"
                                                                                onclick="addtextbox(this)"
                                                                                boxid="' . $count . '">Add</button>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <button type="button" class="btn btn-danger"
                                                                                onclick="removetextbox(this)"
                                                                                boxid="' . $count . '">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-container mb-3">
                                                                        <div class="form-group">
                                                                            <label for="days-1">Inclusion</label>
                                                                            <textarea name="inclusion" class="form-control day-1-textbox"
                                                                                placeholder="Inclusion"
                                                                                style="height: 100px;" required>' . $getdata['tour_inclusion'] . '</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-container mb-3">
                                                                        <div class="form-group">
                                                                            <label for="days-1">Exclusion</label>
                                                                            <textarea name="exclusion" class="form-control day-1-textbox"
                                                                                placeholder="Exclusion"
                                                                                style="height: 100px;" required>' . $getdata['tour_exclusion'] . '</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="way" value="updatedestination">
                                                                    <input type="hidden" name="tourid" value="' . $getdata['id'] . '">
                                                                    <p align="center" style="color:red">Use &lt;br/&gt; to give new line</p>
                                                                </strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"><strong>Close</strong></button>
                                                            <button type="button" class="btn btn-primary" id="updatebtn' . $getdata['id'] . '"  tourid="' . $getdata['id'] . '" onclick="updatetour(this)"><strong
                                                            style="color: #000;">Update Destination</strong></button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                            </td>
                        </tr>
                    ';


        }

        $response["tabledata"] = $tabledata;

        $response["status"] = "success";
        echo json_encode($response);

    } else if ($way == "newdestination") {

        $thumbnail = $_FILES["thumbnail"]["name"];
        $image1 = $_FILES["image1"]["name"];
        $image2 = $_FILES["image2"]["name"];
        $image3 = $_FILES["image3"]["name"];
        $image4 = $_FILES["image4"]["name"];
        $image5 = $_FILES["image5"]["name"];
        $tourname = $_POST["imgdescribe"];
        $bookingcode = $_POST["bookingcode"];
        $days = $_POST["days"];
        $fromDate = $_POST["fromDate"];
        $toDate = $_POST["toDate"];
        $amount = $_POST["amount"];
        $daysplan = [];
        $inclusion = $_POST["inclusion"];
        $exclusion = $_POST["exclusion"];
        $timestamp = date("YmdHis");

        $count = 0;

        while (true) {
            try {
                $count++;
                if (!isset($_POST["days" . $count])) {
                    break;
                }
                array_push($daysplan, $_POST["days" . $count]);
            } catch (Exception $e) {
                break;
            }
        }

        $daysplan = json_encode($daysplan);


        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '0_' . $thumbnail)) {

            if (move_uploaded_file($_FILES["image1"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '1_' . $image1)) {

                if (move_uploaded_file($_FILES["image2"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '2_' . $image2)) {

                    if (move_uploaded_file($_FILES["image3"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '3_' . $image3)) {

                        if (move_uploaded_file($_FILES["image4"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '4_' . $image4)) {

                            if (move_uploaded_file($_FILES["image5"]["tmp_name"], "../../../UC User/img/tourdestination/" . $timestamp . '5_' . $image5)) {

                                $thum = $timestamp . '0_' . $thumbnail;
                                $img1 = $timestamp . '1_' . $image1;
                                $img2 = $timestamp . '2_' . $image2;
                                $img3 = $timestamp . '3_' . $image3;
                                $img4 = $timestamp . '4_' . $image4;
                                $img5 = $timestamp . '5_' . $image5;

                                $insertdestination = $con->query("INSERT INTO tourdestination
                                (tour_thumbnail,tour_image1,tour_image2,tour_image3,tour_image4,tour_image5,tour_name,tour_bookingcode,tour_days,tour_fromdate,tour_todate,tour_amount,tour_daysplan,tour_inclusion,tour_exclusion)
                                VALUES ('{$thum}','{$img1}','{$img2}','{$img3}','{$img4}','{$img5}','{$tourname}','{$bookingcode}','{$days}','{$fromDate}','{$toDate}','{$amount}','{$daysplan}','{$inclusion}','{$exclusion}')");

                                $response["status"] = "success";
                                echo json_encode($response);

                            }

                        }
                    }
                }
            }

        }




    } else if ($way == "updatedestination") {

        $tourid = $_POST["tourid"];
        $thumbnail = isset($_FILES["thumbnail"]["name"]) ? $_FILES["thumbnail"]["name"] : "";
        $image1 = isset($_FILES["image1"]["name"]) ? $_FILES["image1"]["name"] : "";
        $image2 = isset($_FILES["image2"]["name"]) ? $_FILES["image2"]["name"] : "";
        $image3 = isset($_FILES["image3"]["name"]) ? $_FILES["image3"]["name"] : "";
        $image4 = isset($_FILES["image4"]["name"]) ? $_FILES["image4"]["name"] : "";
        $image5 = isset($_FILES["image5"]["name"]) ? $_FILES["image5"]["name"] : "";
        $tourname = $_POST["imgdescribe"];
        $bookingcode = $_POST["bookingcode"];
        $days = $_POST["days"];
        $fromDate = $_POST["fromDate"];
        $toDate = $_POST["toDate"];
        $amount = $_POST["amount"];
        $daysplan = [];
        $inclusion = $_POST["inclusion"];
        $exclusion = $_POST["exclusion"];
        $timestamp = date("YmdHis");

        $count = 0;

        while (true) {
            try {
                $count++;
                if (!isset($_POST["days" . $count])) {
                    break;
                }
                array_push($daysplan, $_POST["days" . $count]);
            } catch (Exception $e) {
                break;
            }
        }

        $daysplan = json_encode($daysplan);

        $image = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
        $getimage = $image->fetch_assoc();

        //Thumbnail Image
        if (strlen($thumbnail) > 3) {

            $thumbnail = $timestamp . '0_' . $thumbnail;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_thumbnail"])) {

                if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "../../../UC User/img/tourdestination/" . $thumbnail)) {

                    $update = $con->query("UPDATE tourdestination SET tour_thumbnail='{$thumbnail}' WHERE id='{$tourid}'");

                }

            }

        }

        //image 1
        if (strlen($image1) > 3) {

            $image1 = $timestamp . '1_' . $image1;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image1"])) {

                if (move_uploaded_file($_FILES["image1"]["tmp_name"], "../../../UC User/img/tourdestination/" . $image1)) {

                    $update = $con->query("UPDATE tourdestination SET tour_image1='{$image1}' WHERE id='{$tourid}'");

                }

            }

        }

        //image 2
        if (strlen($image2) > 3) {

            $image2 = $timestamp . '2_' . $image2;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image2"])) {

                if (move_uploaded_file($_FILES["image2"]["tmp_name"], "../../../UC User/img/tourdestination/" . $image2)) {

                    $update = $con->query("UPDATE tourdestination SET tour_image2='{$image2}' WHERE id='{$tourid}'");

                }

            }

        }

        //image 3
        if (strlen($image3) > 3) {

            $image3 = $timestamp . '3_' . $image3;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image3"])) {

                if (move_uploaded_file($_FILES["image3"]["tmp_name"], "../../../UC User/img/tourdestination/" . $image3)) {

                    $update = $con->query("UPDATE tourdestination SET tour_image3='{$image3}' WHERE id='{$tourid}'");

                }

            }

        }

        //image 4
        if (strlen($image4) > 3) {

            $image4 = $timestamp . '4_' . $image4;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image4"])) {

                if (move_uploaded_file($_FILES["image4"]["tmp_name"], "../../../UC User/img/tourdestination/" . $image4)) {

                    $update = $con->query("UPDATE tourdestination SET tour_image4='{$image4}' WHERE id='{$tourid}'");

                }

            }

        }

        //image 5
        if (strlen($image5) > 3) {

            $image5 = $timestamp . '5_' . $image5;

            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image5"])) {

                if (move_uploaded_file($_FILES["image5"]["tmp_name"], "../../../UC User/img/tourdestination/" . $image5)) {

                    $update = $con->query("UPDATE tourdestination SET tour_image5='{$image5}' WHERE id='{$tourid}'");

                }

            }

        }


        //update Details
        $updatedetails = $con->query("UPDATE tourdestination SET tour_name='{$tourname}', tour_bookingcode='{$bookingcode}',
        tour_days='{$days}', tour_fromdate='{$fromDate}', tour_todate='{$toDate}', tour_amount='{$amount}', tour_daysplan='{$daysplan}', tour_inclusion='{$inclusion}', tour_exclusion='{$exclusion}' WHERE id='{$tourid}'");

        if ($updatedetails) {
            $response["status"] = "success";
            echo json_encode($response);
        }

    }else if ($way == "deletedestination"){

        $tourid = $_POST["tourid"];

        $image = $con->query("SELECT * FROM tourdestination WHERE id='{$tourid}'");
        $getimage = $image->fetch_assoc();

        if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_thumbnail"])) {
            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image1"])) {
                if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image2"])) {
                    if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image3"])) {
                        if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image4"])) {
                            if (unlink("../../../UC User/img/tourdestination/" . $getimage["tour_image5"])) {
                                $deletedestination = $con->query("DELETE FROM tourdestination WHERE id='{$tourid}'");

                                if ($deletedestination) {
                                    $response["status"] = "success";
                                    echo json_encode($response);
                                }
                            }
                        }
                    }
                }
            }
        }

    }

} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);

}

?>