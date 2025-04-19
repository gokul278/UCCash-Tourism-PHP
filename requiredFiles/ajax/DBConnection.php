<?php
header("Access-Control-Allow-Origin: *"); // or replace * with specific domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$con = mysqli_connect("localhost", "root", "", "uc-tour");
?>