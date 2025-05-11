<?php


// require_once(__DIR__ . './requiredFiles/ajax/DBConnection.php');
require_once('./requiredFiles/ajax/DBConnection.php');

$apiUrl = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_iHkJLMAyYjo09RdpBq9GnugAj7rRFcdL6WwSg4kS&currencies=INR';

$response = file_get_contents($apiUrl);
if (!$response) {
    die("Failed to fetch API data.");
} else {
    $updateStatus = "UPDATE currency_rates SET inr_rate = '90.00', usd_rate = '1' WHERE cr_id=1";
    $con->query($updateStatus);
}

$data = json_decode($response, true);

if (!isset($data['data'])) {
    die("Invalid API response.");
} else {
    $updateStatus = "UPDATE currency_rates SET inr_rate = '90.00', usd_rate = '1' WHERE cr_id=1";
    $con->query($updateStatus);
}

foreach ($data['data'] as $currencyCode => $rate) {
    echo $currencyCode . ": " . $rate . "<br>"; // Added <br> for line breaks in HTML output
    $formatted_rate = number_format($rate, 2);
    $updateStatus = "UPDATE currency_rates SET inr_rate = '{$formatted_rate}', usd_rate = '1' WHERE cr_id=1";
    $con->query($updateStatus);
}

echo "Success";
