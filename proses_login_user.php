<?php
include "config.php";
session_start();

$message = '';
$_SESSION['nama'] = $user_data['nama'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id_user'];
        header("Location: index.php");
        exit;
    } else {
        $message = "Login gagal! Username atau password salah.";
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
            background: linear-gradient(135deg, #4a90e2, #a3c8f0);
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
    </style>
</head>

<body>
    <div class="message-box">
        <h2>Oops!</h2>
        <p><?= $message ?></p>
        <a href="login_user.php">&laquo; Kembali ke Login</a>
    </div>
</body>

</html>
