<?php
session_start();
include "../config.php";

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $admin_id = $_SESSION['admin_id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil password lama dari database
    $query = "SELECT password FROM admin WHERE id_admin = $admin_id";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if (!$admin || !password_verify($password_lama, $admin['password'])) {
        $message = "Password lama salah.";
    } elseif ($password_baru !== $konfirmasi_password) {
        $message = "Konfirmasi password tidak cocok.";
    } else {
        // Hash password baru
        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

        // Update password di database
        $update = mysqli_query($conn, "UPDATE admin SET password = '$hashed_password' WHERE id_admin = $admin_id");

        if ($update) {
            $success = "Password berhasil diganti.";
        } else {
            $message = "Terjadi kesalahan saat mengganti password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Password</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: #4e73df;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #2e59d9;
        }

        .message {
            margin-top: 1rem;
            background: #ffdede;
            color: #a94442;
            padding: 0.8rem;
            border-radius: 8px;
            text-align: center;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        a {
            display: block;
            margin-top: 1rem;
            text-align: center;
            color: #4e73df;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Ganti Password Admin</h2>
        <form method="POST">
            <input type="password" name="password_lama" placeholder="Password Lama" required>
            <input type="password" name="password_baru" placeholder="Password Baru" required>
            <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password Baru" required>
            <button type="submit">Ganti Password</button>
        </form>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="message success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <a href="index.php">← Kembali ke Dashboard</a>
    </div>
</body>

</html>