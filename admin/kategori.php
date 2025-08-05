<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $id_kategori = $_GET['delete_id'];
    $query_delete = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    if (mysqli_query($conn, $query_delete)) {
        echo "<script>alert('Kategori berhasil dihapus!');</script>";
    } else {
        echo "<script>alert('Gagal menghapus Kategori!');</script>";
    }
}

if (isset($_POST['SIMPAN'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    if (mysqli_query($conn, $query)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$datakategori = "SELECT * FROM kategori ORDER BY id_kategori ASC";
$resultkategori = $conn->query($datakategori);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori Produk - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, sans-serif;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: row;
        min-height: 100vh;
        background-color: #f8f9fc;
    }

    .sidebar {
        width: 220px;
        background-color: #4e73df;
        padding: 30px 15px;
        color: white;
        transition: transform 0.3s ease;
    }

    .sidebar h2 {
        font-size: 22px;
        margin-bottom: 30px;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .sidebar a:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .hamburger {
        display: none;
        background: #4e73df;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        font-size: 18px;
        position: fixed;
        top: 15px;
        right: 15px;
        z-index: 1000;
    }

    .main {
        flex-grow: 1;
        padding: 30px;
        width: 100%;
    }

    .topbar {
        margin-bottom: 30px;
    }

    .topbar h1 {
        font-size: 28px;
        color: #5a5c69;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 30px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #4e4e4e;
    }

    input[type="text"] {
        padding: 10px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        background-color: #4e73df;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin-top: 15px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #2e59d9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fc;
        font-weight: bold;
        color: #4e4e4e;
    }

    .action-btn {
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
        text-decoration: none;
        margin: 0 4px;
    }

    .edit {
        background-color: #36b9cc;
        color: white;
    }

    .edit:hover {
        background-color: #2c9faf;
    }

    .delete {
        background-color: #e74a3b;
        color: white;
    }

    .delete:hover {
        background-color: #c0392b;
    }

    /* === Responsive === */
    @media screen and (max-width: 768px) {
        body {
            flex-direction: column;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            transform: translateX(-100%);
            z-index: 999;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .hamburger {
            display: block;
        }

        .main {
            padding: 80px 20px 20px;
        }

        table, thead, tbody, th, td, tr {
            display: block;
            text-align: left;
        }

        thead {
            display: none;
        }

        tr {
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        td {
            border: none;
            padding: 10px 0;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
    }
    </style>
</head>
<body>

    <button class="hamburger" onclick="toggleSidebar()">☰</button>

    <div class="sidebar" id="sidebar">
        <h2>CodeMart Admin</h2>
        <a href="index.php"> Dashboard</a>
        <a href="kategori.php"> Kategori</a>
    </div>

    <div class="main">
        <div class="topbar">
            <h1>Kelola Kategori Produk</h1>
        </div>

        <div class="card">
            <form method="POST" action="">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Novel, Komik, Bisnis">
                <button type="submit" name="SIMPAN">+ Tambah Kategori</button>
            </form>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($kategori = $resultkategori->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='No'>" . $no++ . "</td>";
                        echo "<td data-label='Nama Kategori'>" . htmlspecialchars($kategori['nama_kategori']) . "</td>";
                        echo "<td data-label='Aksi'>
                                <a class='action-btn edit' href='edit-kategori.php?id_kategori={$kategori['id_kategori']}'>Edit</a>
                                <a class='action-btn delete' href='?delete_id={$kategori['id_kategori']}' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
