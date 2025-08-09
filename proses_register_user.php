<?php
session_start();
include "config.php";

$status = "";
$pesan = "";
$link = "";

// Proses hanya kalau method POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Cek captcha
    if (!isset($_POST['captcha']) || $_POST['captcha'] !== $_SESSION['captcha_code']) {
        $status = "gagal";
        $pesan = "Kode captcha salah! Silakan coba lagi.";
    } else {
        // Sanitasi input
        $username = htmlspecialchars(trim($_POST['username']));
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap']));
        $no_telepon = htmlspecialchars(trim($_POST['no_telepon']));
        $alamat = htmlspecialchars(trim($_POST['alamat']));

        // Cek username sudah ada atau belum
        $stmt = $conn->prepare("SELECT id_user FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $status = "gagal";
            $pesan = "Username <strong>$username</strong> sudah digunakan!";
        } else {
            // Insert data user
            $stmt = $conn->prepare("INSERT INTO user (username, password, nama_lengkap, no_telepon, alamat) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $passwordHash, $nama_lengkap, $no_telepon, $alamat);

            if ($stmt->execute()) {
                $status = "sukses";
                $pesan = "Registrasi berhasil!";
                $link = "<a href='login_user.php'>Klik di sini untuk login</a>";
            } else {
                $status = "gagal";
                $pesan = "Terjadi kesalahan saat registrasi. Coba lagi.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        :root {
            --primary: #004976;
            --accent: #FDC400;
            --secondary: #A2F4FA;
            --light: #fff;
            --error: #e74c3c;
            --success: #27ae60;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, rgba(0, 73, 118, 0.95), rgba(162, 244, 250, 0.95));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .message-box {
            background: var(--light);
            padding: 30px 40px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 480px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.4s ease-in-out;
        }

        .message-box h2 {
            color:
                <?php echo $status == 'sukses' ? 'var(--success)' : 'var(--error)'; ?>
            ;
            margin-bottom: 20px;
        }

        .message-box p {
            font-size: 16px;
            color: #333;
        }

        .message-box a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: var(--primary);
            color: var(--light);
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .message-box a:hover {
            background: #003355;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
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
        <h2><?php echo $status == 'sukses' ? 'Berhasil!' : 'Gagal!'; ?></h2>
        <p><?php echo $pesan; ?></p>
        <?php if ($link)
            echo $link; ?>
        <div style="margin-top: 10px;">
            <a href="register_user.php">Kembali ke Form</a>
        </div>
    </div>
</body>

</html>