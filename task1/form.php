<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $timestamp = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO notifications (title, timestamp) VALUES (:title, :timestamp)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://unpkg.com/htmx.org"></script>
</head>

<body>
    <form method="post" action="form.php" hx-post="form.php">
        <input type="text" name="title" placeholder="Title" required>
        <button type="submit">Add Notification</button>
    </form>
</body>

</html>