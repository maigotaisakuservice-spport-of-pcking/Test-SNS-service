<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}
require "database.php";

$content = $_POST['content'];
$ng_words = ["死ね", "バカ", "クズ"];

foreach ($ng_words as $word) {
    if (strpos($content, $word) !== false) {
        echo "不適切な言葉が含まれています";
        exit();
    }
}

$stmt = $pdo->prepare("INSERT INTO posts (content, created_at) VALUES (?, NOW())");
$stmt->execute([$content]);

header("Location: home.php");
exit();
