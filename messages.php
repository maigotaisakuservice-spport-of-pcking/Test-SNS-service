<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

require "database.php";

// メッセージ取得
$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メッセージ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>メッセージ</h2>
    <form method="POST" action="send_message.php">
        <input type="text" name="message" placeholder="メッセージ">
        <button type="submit">送信</button>
    </form>

    <h3>受信メッセージ</h3>
    <?php foreach ($messages as $msg): ?>
        <p><?= htmlspecialchars($msg['message']) ?> (<?= $msg['created_at'] ?>)</p>
    <?php endforeach; ?>

    <a href="home.php">戻る</a>
</body>
</html>
