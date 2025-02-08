<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

require "database.php";

// 投稿処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $ng_words = ["死ね", "バカ", "クズ"]; // 誹謗中傷対策用NGワード
    foreach ($ng_words as $word) {
        if (strpos($content, $word) !== false) {
            $error = "不適切な言葉が含まれています";
            break;
        }
    }
    if (!isset($error)) {
        $stmt = $pdo->prepare("INSERT INTO posts (content, created_at) VALUES (?, NOW())");
        $stmt->execute([$content]);
    }
}

// 投稿取得
$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タイムライン</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>タイムライン</h2>
    <form method="POST">
        <textarea name="content" placeholder="投稿内容"></textarea>
        <button type="submit">投稿</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>

    <h3>投稿一覧</h3>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?= htmlspecialchars($post['content']) ?></p>
            <small><?= $post['created_at'] ?></small>
        </div>
    <?php endforeach; ?>

    <a href="messages.php">メッセージ</a>
</body>
</html>
