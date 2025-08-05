<?php
include "../config.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$queryGetKategori = "SELECT id_kategori, nama_kategori FROM kategori ORDER BY id_kategori DESC";
$resultKategori = $conn->query($queryGetKategori);

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id_produk = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 30px 25px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
            color: #1f2937;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            margin-top: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #3b82f6;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        img {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            background-color: #2563eb;
            color: white;
            padding: 12px 20px;
            margin-top: 25px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1e40af;
        }

        .back-btn {
            display: inline-block;
            background-color: #e2e8f0;
            color: #1e3a8a;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background-color: #cbd5e1;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php" class="back-btn">← Kembali</a>
    <h2>Edit Produk</h2>

    <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $data['gambar']; ?>">

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>

        <label>Kategori</label>
        <select name="id_kategori" required>
            <?php
            while ($row = $resultKategori->fetch_assoc()) {
                $selected = ($row['id_kategori'] == $data['id_kategori']) ? "selected" : "";
                echo "<option value='" . $row['id_kategori'] . "' $selected>" . $row['nama_kategori'] . "</option>";
            }
            ?>
        </select>

        <label>Harga</label>
        <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4"><?php echo $data['deskripsi']; ?></textarea>

        <label>Gambar Saat Ini</label><br>
        <img src="uploads/<?php echo $data['gambar']; ?>" width="100"><br>

        <label>Gambar Baru</label>
        <input type="file" name="gambar">

        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
