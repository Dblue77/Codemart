    <?php
    session_start();
    include "../config.php";

    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

    // Ambil kategori untuk form tambah produk
    $queryGetKategori = "SELECT id_kategori, nama_kategori FROM kategori ORDER BY id_kategori DESC";
    $resultKategori = $conn->query($queryGetKategori);

    // Proses tambah produk
    if (isset($_POST['submit'])) {
        $nama_produk = $_POST['nama_produk'];
        $id_kategori = $_POST['id_kategori'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];

        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $upload_dir = "uploads/";

        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
        $gambar_path = $upload_dir . basename($gambar);

        if (move_uploaded_file($tmp_name, $gambar_path)) {
            $query = "INSERT INTO produk (nama_produk, id_kategori, gambar, harga, deskripsi, stok)
                    VALUES ('$nama_produk', '$id_kategori', '$gambar', '$harga', '$deskripsi', '$stok')";
            mysqli_query($conn, $query);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard Admin - CodeMart</title>
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
                z-index: 1001;
                border-radius: 5px;
            }

            .main {
                flex-grow: 1;
                padding: 30px;
                width: 100%;
            }

            .topbar {
                margin-bottom: 30px;
                font-size: 16px;
                color: #4e4e4e;
            }

            h1, h2 {
                color: #333;
                margin-bottom: 15px;
            }

            label {
                font-weight: 600;
                display: block;
                margin-bottom: 8px;
                color: #4e4e4e;
            }

            input[type="text"],
            input[type="number"],
            select,
            textarea {
                padding: 10px;
                width: 100%;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin-bottom: 10px;
                transition: border 0.2s ease;
            }

            input:focus,
            textarea:focus,
            select:focus {
                border-color: #4e73df;
                outline: none;
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
                transition: background 0.2s ease;
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
                margin-bottom: 30px;
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

            .edit, .delete, .detail {
                padding: 6px 12px;
                border-radius: 4px;
                text-decoration: none;
                color: white;
            }

            .edit { background-color: #36b9cc; }
            .edit:hover { background-color: #2c9faf; }

            .delete { background-color: #e74a3b; }
            .delete:hover { background-color: #c0392b; }

            .detail { background-color: #1cc88a; }
            .detail:hover { background-color: #17a673; }

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
                    z-index: 1000;
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
            .aksi-wrapper {
        display: flex;
        gap: 8px; /* Jarak antar tombol */
        justify-content: center;
        align-items: center;
    }

    .logo {
        color: white
    }

    form input[type="text"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-right: 8px;
}
form button {
    padding: 8px 16px;
    background-color: #4e73df;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
form button:hover {
    background-color: #2e59d9;
}

        </style>
    </head>
    <body>

    <button class="hamburger">&#9776;</button>

    <div class="sidebar">
        <h2 class="logo">CodeMart Admin</h2>
        <a href="index.php" class="active">Dashboard</a>
        <a href="kategori.php">Kategori</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <div class="topbar">
            Halo, <?= $_SESSION['username'] ?>
        </div>

        <main>
            <h1>Dashboard Admin</h1>

            <!-- FORM TAMBAH PRODUK -->
            <form method="POST" enctype="multipart/form-data">
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" required>

                <label>Kategori:</label>
                <select name="id_kategori" required>
                    <?php while ($row = $resultKategori->fetch_assoc()) : ?>
                        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                    <?php endwhile; ?>
                </select>

                <label>Gambar:</label>
                <input type="file" name="gambar" required>

                <label>Harga:</label>
                <input type="number" name="harga" required>

                <label>Deskripsi:</label>
                <textarea name="deskripsi" rows="3" required></textarea>

                <label>Stok:</label>
                <input type="number" name="stok" required>

                <button type="submit" name="submit">Tambah Produk</button>
            </form>
<h2>Data Produk</h2>

<!-- Form Cari Produk -->
<form method="GET" style="margin-bottom: 20px;">
    <input type="text" name="cari_produk" placeholder="Cari produk..." value="<?= isset($_GET['cari_produk']) ? htmlspecialchars($_GET['cari_produk']) : '' ?>">
    <button type="submit">Cari</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Gambar</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php
    $cari_produk = isset($_GET['cari_produk']) ? $_GET['cari_produk'] : '';
    $query_produk = "SELECT b.id_produk, k.nama_kategori, b.nama_produk, b.gambar, b.harga, b.deskripsi, b.stok
                     FROM produk b 
                     JOIN kategori k ON b.id_kategori = k.id_kategori
                     WHERE b.nama_produk LIKE '%$cari_produk%'";
    $result_produk = $conn->query($query_produk);
    $no = 1;
    while ($row = $result_produk->fetch_assoc()) :
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_produk'] ?></td>
        <td><?= $row['nama_kategori'] ?></td>
        <td><img src="uploads/<?= $row['gambar'] ?>" width="50"></td>
        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td><?= $row['stok'] ?></td>
        <td>
            <div class="aksi-wrapper">
                <a class="edit" href="edit_produk.php?id=<?= $row['id_produk'] ?>">Edit</a>
                <a class="delete" href="hapus_produk.php?id=<?= $row['id_produk'] ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
            </div>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


            <!-- TABEL USER -->
            <h2>Data User</h2>
            <table>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Dibuat</th>
                </tr>
                <?php
                $no = 1;
                $result_user = $conn->query("SELECT * FROM user");
                while ($user = $result_user->fetch_assoc()) :
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['nama_lengkap'] ?></td>
                    <td><?= $user['no_telepon'] ?></td>
                    <td><?= $user['alamat'] ?></td>
                    <td><?= $user['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <!-- TABEL PESANAN -->
<h2>Data Pesanan</h2>

<!-- Form Cari Pesanan -->
<form method="GET" style="margin-bottom: 20px;">
    <input type="text" name="cari_pesanan" placeholder="Cari pesanan (ID/Username)..." value="<?= isset($_GET['cari_pesanan']) ? htmlspecialchars($_GET['cari_pesanan']) : '' ?>">
    <button type="submit">Cari</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Pelanggan</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <?php
    $cari_pesanan = isset($_GET['cari_pesanan']) ? $_GET['cari_pesanan'] : '';
    $query = "SELECT pesanan.*, user.username 
              FROM pesanan 
              JOIN user ON pesanan.id_user = user.id_user
              WHERE pesanan.id_pesanan LIKE '%$cari_pesanan%' 
              OR user.username LIKE '%$cari_pesanan%'
              ORDER BY pesanan.created_at DESC";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) :
    ?>
    <tr>
        <td><?= $row['id_pesanan'] ?></td>
        <td><?= $row['username'] ?></td>
        <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
        <td>
            <form method="POST" action="update_status.php">
                <input type="hidden" name="id_pesanan" value="<?= $row['id_pesanan'] ?>">
                <select name="status" onchange="this.form.submit()">
                    <option <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                 <!--   <option <?= $row['status'] == 'dikirim' ? 'selected' : '' ?>>dikirim</option> -->
                    <option <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </form>
        </td>
        <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
        <td><a class="detail" href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>">Detail</a></td>
    </tr>
    <?php endwhile; ?>
</table>

        </main>
    </div>

    <script>
        document.querySelector('.hamburger').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>

    </body>
    </html>
