<?php
session_start();
include "config.php";

// Cek login & parameter
if (!isset($_SESSION['user_id']) || !isset($_GET['id_pesanan'])) {
    header("Location: index.php");
    exit;
}

$id_pesanan = (int) $_GET['id_pesanan'];

// Ambil data pesanan
$query = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan = $id_pesanan 
    AND id_user = {$_SESSION['user_id']}
");
$pesanan = mysqli_fetch_assoc($query);

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

// Ambil nama user dari session (tidak perlu query ulang)
$nama_user = $_SESSION['nama_lengkap'] ?? 'User';

// Format pesan WhatsApp
$no_wa_admin = '6285210720275'; // ← ganti dengan nomor admin WA (format 62)
$pesan = "Halo, CS CodeMart, saya sudah melakukan pemesanan dengan detail berikut:

No. Order : {$pesanan['id_pesanan']}
Order Name : {$nama_user}
Total Pembayaran : Rp " . number_format($pesanan['total'], 0, ',', '.') . "
Metode Pembayaran: " . strtoupper($pesanan['metode_pembayaran']) . "

Mohon untuk dapat diverifikasi kembali order saya.
Terima kasih!";

// Encode ke format URL
$pesan_encoded = urlencode($pesan);
$link_wa = "https://wa.me/{$no_wa_admin}?text={$pesan_encoded}";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
            color: #0d47a1;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #1565c0;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        .payment-box {
            background: #e3f2fd;
            border-left: 5px solid #42a5f5;
            padding: 15px 20px;
            border-radius: 10px;
            margin-top: 25px;
            text-align: left;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
                margin: 20px;
            }

            p {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Pesanan Anda Berhasil!</h2>

        <p><strong>No. Order:</strong> <?= $pesanan['id_pesanan']; ?></p>
        <p><strong>Order Name:</strong> <?= htmlspecialchars($nama_user); ?></p>
        <p><strong>Total Pembayaran:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= strtoupper($pesanan['metode_pembayaran']); ?></p>

        <?php if ($pesanan['metode_pembayaran'] == 'transfer_bank'): ?>
            <div class="payment-box">
                <h3>Instruksi Transfer</h3>
                <p><strong>Bank Tujuan:</strong> BANK RTP (825089210187)</p>
                <p><strong>Jumlah:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></p>
                <p><strong>Kode Referensi:</strong> ORDER-<?= $pesanan['id_pesanan']; ?></p>
            </div>
        <?php endif; ?>

        <p style="margin-top: 30px; font-style: italic;">Mengalihkan ke WhatsApp dalam beberapa detik...</p>
    </div>


    <script>
        // Redirect ke WhatsApp setelah 5 detik
        setTimeout(function () {
            window.location.href = "<?= $link_wa ?>";
        }, 5000);
    </script>


</body>

</html>