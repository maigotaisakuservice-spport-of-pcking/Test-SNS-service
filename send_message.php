<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

require "database.php";

$message = $_POST['message'];
$stmt = $pdo->prepare("INSERT INTO messages (message, created_at) VALUES (?, NOW())");
$stmt->execute([$message]);

header("Location: messages.php");
exit();
