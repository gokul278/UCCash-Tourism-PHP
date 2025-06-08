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

        $stmt_img = $con->prepare("SELECT id, imagename, description FROM busniesstools ORDER BY id DESC");
        if (!$stmt_img) {
            $response["status"] = "error";
            $response["message"] = "Prepare failed (images): (" . $con->errno . ") " . $con->error;
            echo json_encode($response);
            exit;
        }
        $stmt_img->execute();
        $result_img = $stmt_img->get_result();
        $images = array();
        while ($row = $result_img->fetch_assoc()) {
            $images[] = $row;
        }
        $stmt_img->close();
        $response["galleryimages"] = $images;

        $stmt_details = $con->prepare("SELECT admin_profile FROM admindetails WHERE admin_id = ?");
        if (!$stmt_details) {
            $response["status"] = "error";
            $response["message"] = "Prepare failed (admin_details): (" . $con->errno . ") " . $con->error;
            echo json_encode($response);
            exit;
        }
        $stmt_details->bind_param("s", $values["admin_id"]);
        $stmt_details->execute();
        $result_details = $stmt_details->get_result();
        $getdetails = $result_details->fetch_assoc();
        $stmt_details->close();

        $response["profile_image"] = $getdetails ? $getdetails["admin_profile"] : null;

        $response["status"] = "success";
        echo json_encode($response);
    } else if ($way == "insertimage") {
        // if (!isset($_FILES["addimage"])) {
        //     $response["status"] = "error";
        //     $response["message"] = "No file uploaded or upload error.";
        //     echo json_encode($response);
        //     exit;
        // }

        $description = isset($_POST["description"]) ? trim($_POST["description"]) : "";
        $original_filename = basename($_FILES["addimage"]["name"]);
        $extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $timestamp = date("YmdHis");
        $newImageName = $timestamp . '_' . uniqid() . '.' . $extension;
        $target_dir = "../../img/businesstools/";
        $target_file = $target_dir . $newImageName;

        // Validate file type (optional but recommended)
        // $allowed_extensions = ['pdf'];
        // if (!in_array($extension, $allowed_extensions)) {
        //     $response["status"] = "error";
        //     $response["message"] = "Invalid file type. Allowed types: " . implode(", ", $allowed_extensions);
        //     echo json_encode($response);
        //     exit;
        // }

        if (move_uploaded_file($_FILES["addimage"]["tmp_name"], $target_file)) {
            $stmt = $con->prepare("INSERT INTO busniesstools (imagename, description) VALUES (?, ?)");
            if (!$stmt) {
                $response["status"] = "error";
                $response["message"] = "Prepare failed (insert): (" . $con->errno . ") " . $con->error;
                unlink($target_file); // Clean up uploaded file
                echo json_encode($response);
                exit;
            }
            $stmt->bind_param("ss", $newImageName, $description);
            if ($stmt->execute()) {
                $response["status"] = "success";
            } else {
                $response["status"] = "error";
                $response["message"] = "Execute failed (insert): (" . $stmt->errno . ") " . $stmt->error;
                unlink($target_file); // Clean up uploaded file
            }
            $stmt->close();
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to move uploaded file.";
            $response["data"] = ini_get('upload_max_filesize');
        }
        echo json_encode($response);
    } else if ($way == "updateDescription") {
        if (!isset($_POST["id"]) || !isset($_POST["description"])) {
            $response["status"] = "error";
            $response["message"] = "Missing parameters for description update.";
            echo json_encode($response);
            exit;
        }
        $id = (int)$_POST["id"];
        $description = trim($_POST["description"]);

        $stmt = $con->prepare("UPDATE busniesstools SET description = ? WHERE id = ?");
        if (!$stmt) {
            $response["status"] = "error";
            $response["message"] = "Prepare failed (update desc): (" . $con->errno . ") " . $con->error;
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param("si", $description, $id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response["status"] = "success";
            } else {
                $response["status"] = "nochange";
                $response["message"] = "Description was the same or image not found.";
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Execute failed (update desc): (" . $stmt->errno . ") " . $stmt->error;
        }
        $stmt->close();
        echo json_encode($response);
    } else if ($way == "deleteimage") { // Corrected: was assignment (=), now comparison (==)
        if (!isset($_POST["id"]) || !isset($_POST["imagename"])) {
            $response["status"] = "error";
            $response["message"] = "Missing parameters for deletion.";
            echo json_encode($response);
            exit;
        }
        $id = (int)$_POST["id"];
        $imagename = basename($_POST["imagename"]); // Sanitize imagename
        $filepath = "../../img/busniesstools/" . $imagename;

        $stmt = $con->prepare("DELETE FROM busniesstools WHERE id = ? AND imagename = ?");
        if (!$stmt) {
            $response["status"] = "error";
            $response["message"] = "Prepare failed (delete): (" . $con->errno . ") " . $con->error;
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param("is", $id, $imagename);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            if (file_exists($filepath) && !unlink($filepath)) {
                $response["status"] = "warning"; // DB deleted, file not
                $response["message"] = "Image record deleted, but failed to delete the image file from server.";
            } else {
                $response["status"] = "success";
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to delete image record from database or image not found. Error: " . $stmt->error;
        }
        $stmt->close();
        echo json_encode($response);
    }
} else if ($values["status"] == "auth_failed") {

    $response["status"] = $values["status"];
    $response["message"] = $values["message"];
    echo json_encode($response);
}
