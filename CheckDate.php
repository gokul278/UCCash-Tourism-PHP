<?php

require_once('./requiredFiles/ajax/DBConnection.php');

$checkdateres = $con->query("SELECT * FROM userdetails");

foreach ($checkdateres as $checkrow) {
    if (!empty($checkrow["created_at"])) {
        $createdAt = new DateTime($checkrow["created_at"]);
        $today = new DateTime();
        $rangeStart = clone $createdAt;
        $rangeEnd = clone $rangeStart;
        $rangeEnd->modify('+29 days');

        $userId = $checkrow["user_id"];
        $lastStart = null;
        $lastEnd = null;

        while ($rangeStart <= $today) {
            // Always use full 30-day chunk
            $lastStart = clone $rangeStart;
            $lastEnd = clone $rangeEnd;

            // Move to next range
            $rangeStart->modify('+30 days');
            $rangeEnd = clone $rangeStart;
            $rangeEnd->modify('+29 days');
        }

        // Insert last full 30-day range
        $sql = "INSERT INTO rewardbonus (user_id, rb_start, rb_end) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $userId, $lastStart->format('Y-m-d'), $lastEnd->format('Y-m-d'));
        $stmt->execute();

        echo "Inserted for User ID: $userId => " . $lastStart->format('Y-m-d') . " to " . $lastEnd->format('Y-m-d') . "<br><hr>";
    } else {
        echo "Skipping user with null created_at<br>";
    }
}
