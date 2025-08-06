<?php
session_start();
include "config.php";

// Redirect jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

// Ambil data user
$user_query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = {$_SESSION['user_id']}");
$user_data = mysqli_fetch_assoc($user_query);

// Ambil data keranjang user
$cart_query = mysqli_query($conn, "
    SELECT produk.*, keranjang.jumlah 
    FROM keranjang 
    JOIN produk ON keranjang.id_produk = produk.id_produk 
    WHERE keranjang.id_user = {$_SESSION['user_id']}
");

// Hitung total harga
$total = 0;
$items = [];
while ($row = mysqli_fetch_assoc($cart_query)) {
    $total += $row['harga'] * $row['jumlah'];
    $items[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout - CodeMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
            color: #0d47a1;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #1565c0;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .order-summary,
        .form-group,
        .bank-info {
            margin-bottom: 20px;
        }

        .order-summary p,
        .bank-info p {
            margin: 8px 0;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbdefb;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .bank-info {
            background: #e3f2fd;
            padding: 15px 20px;
            border-left: 5px solid #42a5f5;
            border-radius: 10px;
        }

        .btn-submit {
            background: #1e88e5;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover,
        .btn-back:hover {
            background-color: #1565c0;
        }

        .btn-back {
            display: block;
            text-align: center;
            background-color: #1e88e5;
            color: white;
            text-decoration: none;
            padding: 10px 0.5px;
            border-radius: 6px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #1565c0;
        }


        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Checkout</h2>



        <!-- Ringkasan Pesanan -->
        <div class="order-summary">
            <h3>Ringkasan Pesanan</h3>
            <?php foreach ($items as $item): ?>
                <p>
                    <?= htmlspecialchars($item['nama_produk']) ?> (<?= $item['jumlah'] ?>x) -
                    Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                </p>
            <?php endforeach; ?>
            <p><strong>Total Harga: Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
        </div>

        <!-- Form Checkout -->
        <form action="proses_checkout.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user_data['nama_lengkap'] ?? '') ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="tel" name="no_telepon" value="<?= htmlspecialchars($user_data['no_telepon'] ?? '') ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required><?= htmlspecialchars($user_data['alamat'] ?? '') ?></textarea>
            </div>

            <!-- Metode Pembayaran -->
            <input type="hidden" name="metode_pembayaran" value="transfer_bank">

            <!-- Instruksi Transfer Bank -->
            <div class="bank-info">
                <h3>Instruksi Pembayaran</h3>
                <p>Silakan transfer ke rekening berikut:</p>
                <p><strong>Bank RTP</strong></p>
                <p>Nomor Rekening: <strong>8250 8921 0187</strong></p>
                <p>Atas Nama: <strong>CodeMart</strong></p>
                <p>Jumlah: <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
                <p>Kode Referensi: <strong>ORDER-<?= time() ?></strong></p>
            </div>

            <!-- Upload Bukti -->
            <div class="form-group">
                <label>Upload Bukti Transfer (JPG/PNG, maks 2MB)</label>
                <input type="file" name="bukti_transfer" accept="image/jpeg, image/png" required>
            </div>
            <button type="submit" class="btn-submit">Konfirmasi Pesanan</button>
            <a href="index.php" class="btn-back">&laquo; Kembali ke Beranda</a>
        </form>
    </div>
</body>

</html>