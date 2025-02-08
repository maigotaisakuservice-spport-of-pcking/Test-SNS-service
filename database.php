<?php
$pdo = new PDO("sqlite:database.db"); // SQLite使用
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
