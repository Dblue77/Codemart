<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$query = mysqli_query($conn, "
    SELECT produk.id_produk, produk.nama_produk, produk.harga, keranjang.jumlah 
    FROM keranjang 
    JOIN produk ON keranjang.id_produk = produk.id_produk 
    WHERE keranjang.id_user = {$_SESSION['user_id']}
");

$total = 0;
$item_count = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <script>
        function validateCheckout() {
            <?php if ($item_count == 0): ?>
                alert("Keranjang kosong! Tambahkan produk terlebih dahulu.");
                window.location.href = "index.php";
                return false;
            <?php else: ?>
                return true;
            <?php endif; ?>
        }
    </script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Variabel warna */
:root {
  --primary: #007BBD;     /* Biru utama (dari monitor) */
  --secondary: #A2F4FA;   /* Biru muda (background kanan logo) */
  --accent: #FDC400;      /* Kuning emas (dari sayap) */
  --dark: #222222;        /* Hitam gelap (untuk teks atau border) */
  --light: #FFFFFF;       /* Putih (background bersih) */
  --text: #333333;        /* Abu tua untuk teks utama */
  --shadow: 0 5px 15px rgba(0, 123, 189, 0.1); /* Bayangan lembut biru */
}
    
    /* Reset default */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      background-color: var(--light);
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
    }
    
    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.2rem 8%;
      background: var(--primary);
      box-shadow: var(--shadow);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    
    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--dark);
      letter-spacing: 1px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .menu {
      display: flex;
      list-style: none;
    }
    
    .menu li {
      margin: 0 0.8rem;
    }
    
    .menu a {
      text-decoration: none;
      color: var(--dark);
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 25px;
      transition: var(--transition);
      position: relative;
    }
    
    .menu a:hover:not(.active) {
      background: rgba(255, 255, 255, 0.3);
    }
    
    .menu .active {
      background: var(--secondary);
      color: var(--accent);
      font-weight: 600;
    }
    
    .menu a::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 3px;
      background: var(--accent);
      transition: var(--transition);
    }
    
    .menu a:hover::after {
      width: 100%;
    }
    
    .hamburger {
      display: none;
      cursor: pointer;
      color: var(--dark);
      font-size: 1.5rem;
    }
    
    /* Background gerak section */
    .background-image {
     background: linear-gradient(
    rgba(0, 73, 118, 0.45),   /* primary */
    rgba(162, 244, 250, 0.34) /* secondary */
  ),
  url("https://smkdp2jkt.sch.id/wp-content/uploads/2025/02/SLIDER1-940x510.jpg");
      background-size: cover;
      background-position: center;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    
    .container-h1 {
      position: relative;
      z-index: 2;
    }
    
    .logoa {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      border: 5px solid var(--secondary);
      box-shadow: var(--shadow);
      margin-bottom: 1.5rem;
      animation: float 4s ease-in-out infinite;
    }
    
    @keyframes float {
      0% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-20px);
      }
      100% {
        transform: translateY(0px);
      }
    }
    
    .h1 {
      font-size: 3.5rem;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(255, 254, 254, 0.3);
      animation: fadeInDown 1s ease;
    }
    
    .h2 {
      font-size: 1.8rem;
      font-weight: 400;
      max-width: 600px;
      margin: 0 auto;
      animation: fadeInUp 1s ease;
    }
    
    /* Hero section */
    .hero {
      padding: 3rem 0;
      text-align: center;
      background: var(--secondary);
      position: relative;
    }
    
    .hero p {
      font-size: 2rem;
      color: var(--accent);
      font-weight: 700;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
      }
    }
    
    /* Products section */
    .products {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 2rem;
      padding: 4rem 8%;
      background: var(--light);
    }
    
    .product {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: var(--transition);
      position: relative;
      display: flex;
      flex-direction: column;
    }
    
    .product:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(139, 69, 19, 0.2);
    }
    
    .product img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: var(--transition);
    }
    
    .product:hover img {
      transform: scale(1.1);
    }
    
    .product h3 {
      padding: 1rem 1rem 0.5rem;
      color: var(--dark);
      font-size: 1.3rem;
    }
    
    .product .price {
      padding: 0 1rem;
      color: var(--accent);
      font-weight: bold;
      font-size: 1.2rem;
      margin: 0.5rem 0;
    }
    
    .product p {
      padding: 0 1rem;
      color: #777;
      flex-grow: 1;
    }
    
    .product button {
      background: var(--primary);
      color: var(--dark);
      border: none;
      padding: 0.8rem;
      margin: 1rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: var(--transition);
      border: 2px solid var(--primary);
    }
    
    .product button:hover {
      background: transparent;
      color: var(--accent);
      border-color: var(--accent);
    }
    
    .product-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--accent);
      color: white;
      padding: 0.25rem 0.5rem;
      border-radius: 5px;
      font-size: 0.8rem;
      font-weight: bold;
    }
    
    /* Footer */
    .footer {
      background: var(--dark);
      color: var(--secondary);
      padding: 3rem 8% 2rem;
      text-align: center;
      position: relative;
    }
    
    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 10px;
      background: linear-gradient(to right, var(--primary), var(--secondary));
    }
    
    .footer p {
      margin-bottom: 1.5rem;
    }
    
    .social-icons {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .social-icons a {
      display: inline-block;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(255, 238, 169, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
    }
    
    .social-icons a:hover {
      background: var(--primary);
      transform: translateY(-5px);
    }
    
    .social-icons img {
      width: 30px;
      height: 30px;
      object-fit: contain;
    }
    
    iframe {
      width: 100%;
      max-width: 600px;
      height: 300px;
      border: none;
      border-radius: 10px;
      margin: 1rem auto;
      box-shadow: var(--shadow);
    }
    
    /* Animasi */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Responsif */
    @media (max-width: 992px) {
      .products {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      
      .navbar {
        padding: 1rem 5%;
      }
      
      .h1 {
        font-size: 2.8rem;
      }
      
      .h2 {
        font-size: 1.5rem;
      }
    }
    
    @media (max-width: 768px) {
      .hamburger {
        display: block;
      }
      
      .menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: var(--primary);
        flex-direction: column;
        padding: 1rem 0;
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
        transition: var(--transition);
      }
      
      .menu.active {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
      }
      
      .menu li {
        margin: 0.5rem 0;
        text-align: center;
      }
      
      .background-image {
        height: 70vh;
      }
      
      .h1 {
        font-size: 2.2rem;
      }
      
      .h2 {
        font-size: 1.3rem;
      }
    }
    
    @media (max-width: 480px) {
      .products {
        grid-template-columns: 1fr;
        max-width: 350px;
        margin: 0 auto;
      }
      
      .h1 {
        font-size: 2rem;
      }
      
      .hero p {
        font-size: 1.5rem;
      }
    }

h2 {
  font-family: monospace;
  font-size: 28px;
  color: white  ;
}

.typed-text {
  font-weight: bold;
  color: blue;
}

.cursor {
  display: inline-block;
  background-color: transparent;
  color: blue;
  animation: blink 0.7s infinite;
}

@keyframes blink {
  0%, 100% { opacity: 0; }
  50% { opacity: 1; }
}

        .item-box {
            background-color: var(--secondary);
            border: 1px solid var(--primary);
            border-radius: 12px;
            padding: 15px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: var(--shadow);
        }

        .item-box h3 {
            margin: 0 0 10px 0;
            color: var(--accent);
        }

        .item-box p {
            margin: 4px 0;
        }

        .btn-hapus {
            background-color: #ff4d4d;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        .btn-hapus:hover {
            background-color: #c0392b;
        }

        h4 {
            text-align: center;
            color: var(--accent);
        }

        .btn-checkout {
            display: inline-block;
            background-color: var(--accent);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            margin: 20px auto 0 auto;
            transition: background-color 0.3s;
        }

        .btn-checkout:hover {
            background-color: var(--dark);
        }

        .center {
            display: flex;
            justify-content: center;
        }
  </style>
</head>
<body>
<?php include 'partials/header.php'; ?>


    <h2>Keranjang Belanja</h2>
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="item-box">
            <h3><?= $row['nama_produk']; ?></h3>
            <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
            <p>Jumlah: <?= $row['jumlah']; ?></p>
            <a class="btn-hapus" href="hapus_keranjang.php?id_produk=<?= $row['id_produk']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">Hapus</a>
        </div>
        <?php $total += $row['harga'] * $row['jumlah']; ?>
    <?php endwhile; ?>

    <h4>Total: Rp <?= number_format($total, 0, ',', '.'); ?></h4>

    <div class="center">
        <a href="checkout.php" onclick="return validateCheckout()" class="btn-checkout">Checkout</a>
    </div>

    <footer>
      <?php include 'partials/footer.php'; ?>
    </footer>
</body>

</html>
