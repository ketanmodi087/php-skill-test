<?php
require 'config.php';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$lastId = 0;
if (isset($_SERVER['HTTP_LAST_EVENT_ID'])) {
    $lastId = (int)$_SERVER['HTTP_LAST_EVENT_ID'];
}

set_time_limit(120);

while (true) {
    set_time_limit(120);

    $stmt = $db->prepare("SELECT * FROM notifications WHERE id > :lastId ORDER BY id ASC");
    $stmt->bindParam(':lastId', $lastId);
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($notifications as $notification) {
        echo "id: " . $notification['id'] . "\n";
        echo "data: " . $notification['title'] . " at " . $notification['timestamp'] . "\n\n";
        $lastId = $notification['id'];
    }

    ob_flush();
    flush();
    // Wait for 1 second before checking for new data
    sleep(1);
}
