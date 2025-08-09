<?php
include "config.php";
session_set_cookie_params([
    'httponly' => true,
    'secure' => false,
    'samesite' => 'Strict'
]);
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['captcha']) || !isset($_SESSION['captcha_code']) || trim($_POST['captcha']) !== strval($_SESSION['captcha_code'])) {
        $message = "Captcha salah!";
    } else {
        unset($_SESSION['captcha_code']);

        $username = trim($_POST['username']);
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            header("Location: index.php");
            exit;
        } else {
            $message = "Login gagal! Username atau password salah.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Gagal</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(0, 73, 118, 0.9), rgba(162, 244, 250, 0.9));
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .message-box {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 420px;
            width: 90%;
            text-align: center;
        }

        h2 {
            color: #4a90e2;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #444;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4a90e2;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #357ABD;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="message-box">
        <div class="logo">
            <img src="assets/logorpldp.png" alt="CodeMart Logo">
        </div>
        <h2>Oops!</h2>
        <p><?= $message ?></p>
        <a href="login_user.php">&laquo; Kembali ke Login</a>
    </div>
</body>

</html>