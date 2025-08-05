<?php
session_start();
include "../config.php";


$id_pesanan = (int)$_GET['id'];

// Ambil data pesanan + bukti transfer
$query_pesanan = mysqli_query($conn, "
    SELECT pesanan.*, user.username 
    FROM pesanan 
    JOIN user ON pesanan.id_user = user.id_user
    WHERE pesanan.id_pesanan = $id_pesanan
");
$pesanan = mysqli_fetch_assoc($query_pesanan);

// Ambil item pesanan
$query_items = mysqli_query($conn, "
    SELECT detail_pesanan.*, produk.nama_produk, produk.gambar
    FROM detail_pesanan
    JOIN produk ON detail_pesanan.id_produk = produk.id_produk
    WHERE detail_pesanan.id_pesanan = $id_pesanan
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <style>
        :root {
            --primary: #90caf9;
            --dark: #1565c0;
            --light: #e3f2fd;
            --text-dark: #0d47a1;
            --bg: #f0f8ff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg);
        }

.container {
    max-width: 960px;
    margin: 40px auto;
    background-color: white;
    padding: 30px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.bukti-wrapper {
    max-width: 300px;
    overflow: hidden;
}

.bukti-transfer {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    object-fit: contain;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}


        h1 {
            text-align: center;
            color: var(--text-dark);
            margin-bottom: 30px;
        }

        h3 {
            border-bottom: 2px solid var(--primary);
            padding-bottom: 6px;
            color: var(--dark);
            margin-top: 30px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 10px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: var(--dark);
            color: white;
        }

        td img {
            width: 60px;
            border-radius: 6px;
        }

        .status-pending {
            color: #f57c00;
            font-weight: bold;
        }

        .status-verified {
            color: #2e7d32;
            font-weight: bold;
        }

        .bukti-transfer {
            max-width: 100%;
            margin-top: 10px;
            border-radius: 8px;
        }

        a {
            color: var(--dark);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: var(--primary);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: var(--dark);
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 12px;
                width: 45%;
                padding-right: 10px;
                font-weight: bold;
                white-space: nowrap;
            }

            td:nth-of-type(1)::before { content: "Produk"; }
            td:nth-of-type(2)::before { content: "Gambar"; }
            td:nth-of-type(3)::before { content: "Harga"; }
            td:nth-of-type(4)::before { content: "Jumlah"; }
            td:nth-of-type(5)::before { content: "Subtotal"; }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Pesanan #<?= $id_pesanan ?></h1>

        <div class="info-section">
            <h3>Informasi Pesanan</h3>
            <p><strong>Pelanggan:</strong> <?= $pesanan['username'] ?></p>
            <p><strong>Tanggal Pesan:</strong> <?= date('d/m/Y H:i', strtotime($pesanan['created_at'])) ?></p>
            <p><strong>Status:</strong>
                <span class="<?= $pesanan['status'] == 'menunggu_verifikasi' ? 'status-pending' : 'status-verified' ?>">
                    <?= ucfirst(str_replace('_', ' ', $pesanan['status'])) ?>
                </span>
            </p>
            <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>
            <p><strong>Alamat Pengiriman:</strong><br><?= nl2br($pesanan['alamat']) ?></p>
        </div>

<div class="info-section">
    <h3>Bukti Transfer</h3>
    <?php if ($pesanan['bukti_transfer']): ?>
        <div class="bukti-wrapper">
            <img src="../bukti_transfer/<?= $pesanan['bukti_transfer'] ?>" alt="Bukti Transfer" class="bukti-transfer">
        </div>
        <p><a href="../bukti_transfer/<?= $pesanan['bukti_transfer'] ?>" download>Download Bukti</a></p>
    <?php else: ?>
        <p>Belum mengupload bukti transfer.</p>
    <?php endif; ?>
</div>


        <div class="info-section">
            <h3>Item Pesanan</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = mysqli_fetch_assoc($query_items)): ?>
                        <tr>
                            <td><?= $item['nama_produk'] ?></td>
                            <td><img src="uploads/<?= $item['gambar'] ?>" alt="<?= $item['nama_produk'] ?>"></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <a href="index.php" class="back-link">&laquo; Kembali ke Dashboard</a>
    </div>
</body>

</html>
