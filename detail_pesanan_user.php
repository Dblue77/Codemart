<?php
session_start();
include "config.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$id_pesanan = (int) $_GET['id'];

// Ambil data pesanan
$query_pesanan = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan = $id_pesanan 
    AND id_user = {$_SESSION['user_id']}
");
$pesanan = mysqli_fetch_assoc($query_pesanan);

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

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
    <title>Detail Pesanan - CodeMart</title>
    <style>
        :root {
            --primary: #004976ff;
            --secondary: #A2F4FA;
            --accent: #FDC400;
            --dark: #222222;
            --light: #FFFFFF;
            --text: #333333;
            --shadow: 0 5px 15px rgba(0, 123, 189, 0.1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light);
            color: var(--text);
            margin: 0;
            padding: 20px;
        }

        h1,
        h3 {
            color: var(--primary);
        }

        .info-section {
            background-color: #A2F4FA;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--accent);
            color: var(--primary);
        }

        td img {
            width: 60px;
            border-radius: 6px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #002244;
        }

        .status-menunggu-verifikasi {
            color: #e67e22;
            font-weight: bold;
        }

        .status-diproses {
            color: #2980b9;
            font-weight: bold;
        }

        .status-dikirim {
            color: #27ae60;
            font-weight: bold;
        }

        .status-selesai {
            color: #16a085;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            table {
                border: none;
            }

            thead {
                display: none;
            }

            tr {
                display: block;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: var(--shadow);
                padding: 10px;
                background-color: #fff;
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td:last-child {
                border-bottom: none;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: var(--primary);
                flex-basis: 40%;
            }

            td img {
                width: 100px;
                height: auto;
                border-radius: 6px;
            }
        }
    </style>
</head>

<body>

    <h1>Detail Pesanan #<?= $pesanan['id_pesanan'] ?></h1>

    <div class="info-section">
        <h3>Informasi Pesanan</h3>
        <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($pesanan['created_at'])) ?></p>
        <p><strong>Status:</strong>
            <span class="status-<?= str_replace('_', '-', $pesanan['status']) ?>">
                <?php
                $status = [
                    'menunggu_verifikasi' => 'Menunggu Verifikasi',
                    'diproses' => 'Diproses',
                    'dikirim' => 'Dikirim',
                    'selesai' => 'Selesai'
                ];
                echo $status[$pesanan['status']] ?? ucfirst($pesanan['status']);
                ?>
            </span>
        </p>
        <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>
        <p><strong>Alamat Pengiriman:</strong><br><?= nl2br(htmlspecialchars($pesanan['alamat'])) ?></p>
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
                        <td data-label="Produk"><?= htmlspecialchars($item['nama_produk']) ?></td>
                        <td data-label="Gambar"><img src="admin/uploads/<?= $item['gambar'] ?>" alt="Produk"></td>
                        <td data-label="Harga">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td data-label="Jumlah"><?= $item['jumlah'] ?></td>
                        <td data-label="Subtotal">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

    <a href="pesanan.php">&laquo; Kembali ke Beranda</a>
    <?php include 'partials/footer.php'; ?>
</body>

</html>