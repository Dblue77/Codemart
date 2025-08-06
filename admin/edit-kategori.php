<?php
session_start(); // Pastikan session dimulai
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id_kategori'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id_kategori'];
$query = "SELECT * FROM kategori WHERE id_kategori = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}

// Menangani data POST
if (isset($_POST['UPDATE'])) {
    $id = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    $queryupdate = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id'";
    if (mysqli_query($conn, $queryupdate)) {
        echo "Data Kategori berhasil diupdate!";
        header("Location: kategori.php"); // Redirect kembali ke halaman index setelah update
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kategori Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(95, 68, 38);
            color: rgb(228, 214, 199);
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: white;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff8e1;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(100, 70, 50, 0.1);
            color: #5d4037;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #d7ccc8;
            border-radius: 6px;
            background-color: #ffffff;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            background-color: rgb(121, 97, 88);
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgb(109, 80, 69);
        }
    </style>

</head>

<body>

    <h2>Edit Kategori Produk</h2>

    <form action="" method="POST">
        <input type="text" name="id_kategori" value="<?php echo $data['id_kategori']; ?>">
        <label>Nama Kategori :</label><br>
        <input type="text" name="nama_kategori" value="<?php echo $data['nama_kategori']; ?>"><br><br>
        <button type="submit" name="UPDATE">Simpan Perubahan</button>
    </form>

</body>

</html>