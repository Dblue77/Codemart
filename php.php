<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['id_pesanan'])) {
    header("Location: index.php");
    exit;
}

$id_pesanan = (int)$_GET['id_pesanan'];
$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan = $id_pesanan 
    AND id_user = $user_id
");
$pesanan = mysqli_fetch_assoc($query);

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

// Hitung ulang total jika total kosong atau 0
if (!$pesanan['total'] || $pesanan['total'] == 0) {
    $cart_query = mysqli_query($conn, "
        SELECT SUM(keranjang.jumlah * produk.harga) as total
        FROM keranjang 
        JOIN produk ON keranjang.id_produk = produk.id_produk
        WHERE keranjang.id_user = $user_id
    ");
    $cart_data = mysqli_fetch_assoc($cart_query);
    $pesanan['total'] = $cart_data['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            color: #0d47a1;
        }

        .info-section {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .info-section p {
            margin: 12px 0;
            font-size: 16px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            color: white;
        }

        .status-menunggu-verifikasi { background-color: #fbc02d; }
        .status-diproses { background-color: #42a5f5; }
        .status-dikirim { background-color: #29b6f6; }
        .status-selesai { background-color: #66bb6a; }

        .payment-instruction {
            background-color: #e3f2fd;
            border-left: 4px solid #42a5f5;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
        }

        .payment-instruction h3 {
            margin-top: 0;
            color: #1565c0;
        }

        a {
            display: block;
            text-align: center;
            margin: 30px auto 10px;
            max-width: 200px;
            text-decoration: none;
            background-color: #1e88e5;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #1565c0;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .info-section, .payment-instruction {
                padding: 15px;
            }

            a {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<h2>Pesanan Berhasil Dibuat!</h2>

<div class="info-section">
    <p><strong>ID Pesanan:</strong> <?= $pesanan['id_pesanan']; ?></p>
    <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></p>
    <p><strong>Status:</strong>
        <span class="badge status-<?= str_replace('_', '-', $pesanan['status']) ?>">
            <?php
            $status = [
                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                'diproses' => 'Diproses',
                'dikirim' => 'Dikirim',
                'selesai' => 'Selesai'
            ];
            echo $status[$pesanan['status']] ?? $pesanan['status'];
            ?>
        </span>
    </p>
    <p><strong>Metode Pembayaran:</strong> <?= strtoupper($pesanan['metode_pembayaran']); ?></p>
</div>

<?php if ($pesanan['metode_pembayaran'] == 'transfer_bank'): ?>
    <div class="payment-instruction">
        <h3>Instruksi Pembayaran</h3>
        <p><strong>Transfer ke:</strong> BANK RTP (825089210187)</p>
        <p><strong>Jumlah:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></p>
        <p><strong>Kode Referensi:</strong> ORDER-<?= $pesanan['id_pesanan']; ?></p>
    </div>
<?php endif; ?>

<a href="index.php">&laquo; Kembali ke Beranda</a>

</body>
</html>




        <?php
        session_start();
        include "config.php";

        if (!isset($_SESSION['user_id'])) {
            header("Location: login_user.php");
            exit;
        }

        $user_query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = {$_SESSION['user_id']}");
        $user_data = mysqli_fetch_assoc($user_query);

        $cart_query = mysqli_query($conn, "
            SELECT produk.*, keranjang.jumlah 
            FROM keranjang 
            JOIN produk ON keranjang.id_produk = produk.id_produk 
            WHERE keranjang.id_user = {$_SESSION['user_id']}
        ");

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
            <style>
                :root {
                    --primary: #004976;
                    --secondary: #A2F4FA;
                    --accent: #FDC400;
                    --dark: #222222;
                    --light: #FFFFFF;
                    --text: #333333;
                    --shadow: 0 5px 15px rgba(0, 123, 189, 0.1);
                }

                body {
                    font-family: 'Arial', sans-serif;
                    background-color: var(--secondary);
                    color: var(--text);
                    margin: 0;
                    padding: 0;
                }

                .container {
                    max-width: 800px;
                    margin: 30px auto;
                    background-color: var(--light);
                    padding: 30px;
                    border-radius: 12px;
                    box-shadow: var(--shadow);
                }

                h2 {
                    color: var(--primary);
                    text-align: center;
                    margin-bottom: 20px;
                }

                .order-summary {
                    background-color: #f2f9fb;
                    border: 1px solid #b6dce2;
                    padding: 20px;
                    border-radius: 8px;
                    margin-bottom: 25px;
                }

                .order-summary h3 {
                    color: var(--primary);
                    margin-bottom: 10px;
                }

                .order-summary p {
                    margin: 8px 0;
                }

                .form-group {
                    margin-bottom: 20px;
                }

                label {
                    font-weight: bold;
                    color: var(--primary);
                    margin-bottom: 6px;
                    display: block;
                }

                input, textarea, select {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    font-size: 14px;
                    box-sizing: border-box;
                }

                .bank-info {
                    background-color: #fff9e6;
                    border-left: 4px solid var(--accent);
                    padding: 15px;
                    margin-top: 25px;
                    border-radius: 6px;
                }

                .bank-info h3 {
                    margin-top: 0;
                    color: var(--accent);
                }

                .btn-submit {
                    background-color: var(--primary);
                    color: white;
                    border: none;
                    padding: 14px 25px;
                    font-size: 16px;
                    border-radius: 8px;
                    cursor: pointer;
                    transition: background 0.3s ease;
                    width: 100%;
                    margin-top: 20px;
                }

                .btn-submit:hover {
                    background-color: #00385d;
                }

                a.back-link {
                    display: block;
                    margin-top: 25px;
                    text-align: center;
                    color: var(--primary);
                    text-decoration: none;
                }

                a.back-link:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Checkout</h2>

                <div class="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    <?php foreach ($items as $item): ?>
                        <p><?= htmlspecialchars($item['nama_produk']) ?> (<?= $item['jumlah'] ?>x) - Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></p>
                    <?php endforeach; ?>
                    <p><strong>Total Harga: Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
                </div>

                <form action="proses_checkout.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user_data['nama_lengkap'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="tel" name="no_telepon" value="<?= htmlspecialchars($user_data['no_telepon'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required><?= htmlspecialchars($user_data['alamat'] ?? '') ?></textarea>
                    </div>

                    <input type="hidden" name="metode_pembayaran" value="transfer_bank">

                    <div class="bank-info">
                       <!-- <h3>Instruksi Pembayaran</h3>
                        <p>Silakan transfer ke rekening berikut:</p>
                        <p><strong>Bank RTP</strong></p>
                        <p>Nomor Rekening: <strong>8250 8921 0187</strong></p>
                        <p>Atas Nama: <strong>Flowly Book</strong></p>
                        <p>Jumlah: <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
                        <p>Kode Referensi: <strong>ORDER-<?= time() ?></strong></p> -->
                    </div>

                <div class="form-group">
                        <label>Upload Bukti Transfer (JPG/PNG, max 2MB)</label>
                        <input type="file" name="bukti_transfer" accept="image/jpeg, image/png" required>
                </div>

                    <button type="submit" class="btn-submit">Konfirmasi Pesanan</button>
                </form>

                <a href="index.php" class="back-link">&laquo; Kembali ke Beranda</a>
            </div>
        </body>
        </html>




        <?php
session_start();
include "config.php";

// Validasi
if (!isset($_SESSION['user_id']) || empty($_POST['alamat'])) {
    header("Location: checkout.php");
    exit;
}

// Proses Upload Bukti Transfer
$upload_dir = "bukti_transfer/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$bukti_transfer = $_FILES['bukti_transfer'];
$ext = pathinfo($bukti_transfer['name'], PATHINFO_EXTENSION);
$filename = "TRF-" . $_SESSION['user_id'] . "-" . time() . "." . $ext;
$target_file = $upload_dir . $filename;

// Validasi File
$allowed_ext = ['jpg', 'jpeg', 'png'];
if (!in_array(strtolower($ext), $allowed_ext)) {
    die("Hanya file JPG/PNG yang diizinkan!");
}

if (move_uploaded_file($bukti_transfer['tmp_name'], $target_file)) {
    // Hitung total dari keranjang
    $total = 0;
    $id_user = $_SESSION['user_id'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $query_keranjang = mysqli_query($conn, "
        SELECT produk.harga, keranjang.jumlah 
        FROM keranjang 
        JOIN produk ON keranjang.id_produk = produk.id_produk 
        WHERE keranjang.id_user = $id_user
    ");

    while ($row = mysqli_fetch_assoc($query_keranjang)) {
        $total += $row['harga'] * $row['jumlah'];
    }

    // 1. Simpan ke tabel pesanan (DENGAN bukti transfer)
    $query = "INSERT INTO pesanan (
        id_user, alamat, metode_pembayaran, bukti_transfer, total, status
    ) VALUES (
        $id_user, 
        '$alamat', 
        'transfer_bank', 
        '$filename', 
        $total, 
        'pending' 
    )";

    mysqli_query($conn, $query);
    $id_pesanan = mysqli_insert_id($conn);

    // 2. Pindahkan item keranjang ke detail_pesanan
    mysqli_query($conn, "
        INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, harga)
        SELECT $id_pesanan, id_produk, jumlah, (SELECT harga FROM produk WHERE id_produk = keranjang.id_produk)
        FROM keranjang 
        WHERE id_user = $id_user
    ");

    // 3. Kosongkan keranjang
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_user = $id_user");

    // 4. Redirect ke halaman konfirmasi
    header("Location: konfirmasi.php?id_pesanan=$id_pesanan");
    exit;
} else {
    die("Gagal upload bukti transfer!");
}