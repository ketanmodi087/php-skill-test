<?php
$db = new PDO('sqlite:notifications.db');
$db->exec("CREATE TABLE IF NOT EXISTS notifications (
    id INTEGER PRIMARY KEY, 
    title TEXT, 
    timestamp TEXT
)");
