<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pin = $_POST['pin'];
    if (strlen($pin) == 4 && substr($pin, 0, 2) === "14") {
        $_SESSION['loggedin'] = true;
        header("Location: home.php");
        exit();
    } else {
        $error = "無効な暗証番号です";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン - Test-SNS-service</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Test-SNS-service</h1>
    <form method="POST">
        <h2>ログイン</h2>
        <input type="text" name="pin" placeholder="4桁の暗証番号" required>
        <button type="submit">入室</button>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</body>
</html>
