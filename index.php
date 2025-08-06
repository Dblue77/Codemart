<?php
session_start();
include "config.php";

$query = "SELECT * FROM produk";
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if (!empty($keyword)) {
  $query .= " WHERE nama_produk LIKE '%$keyword%' OR id_kategori LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeMart</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Variabel warna */
    :root {
      --primary: #007BBD;
      /* Biru utama (dari monitor) */
      --secondary: #A2F4FA;
      /* Biru muda (background kanan logo) */
      --accent: #FDC400;
      /* Kuning emas (dari sayap) */
      --dark: #222222;
      /* Hitam gelap (untuk teks atau border) */
      --light: #FFFFFF;
      /* Putih (background bersih) */
      --text: #333333;
      /* Abu tua untuk teks utama */
      --shadow: 0 5px 15px rgba(0, 123, 189, 0.1);
      /* Bayangan lembut biru */
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
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
      background: linear-gradient(rgba(7, 160, 255, 0.6),
          /* primary */
          rgba(162, 244, 250, 0.34)
          /* secondary */
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
      color: black;
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
      color: white;
    }

    .typed-text {
      font-weight: bold;
      color: #1a08a0ff;
      /* Warna teks abu gelap */
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .cursor {
      display: inline-block;
      background-color: transparent;
      color: blue;
      animation: blink 0.7s infinite;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }


    @keyframes blink {

      0%,
      100% {
        opacity: 0;
      }

      50% {
        opacity: 1;
      }
    }

    .intro-banner {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      animation: fadeIn 0.3s ease;
    }

    .banner-box {
      position: relative;
      width: 90%;
      max-width: 600px;
      border-radius: 10px;
      overflow: hidden;
      background-color: white;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .banner-box img {
      width: 100%;
      height: auto;
      display: block;
    }

    .close-btn {
      position: absolute;
      top: 8px;
      right: 10px;
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      border: none;
      font-size: 22px;
      padding: 4px 10px;
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .close-btn:hover {
      background: rgba(0, 0, 0, 0.8);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @media (max-width: 480px) {
      .banner-box {
        max-width: 95%;
      }

      .close-btn {
        font-size: 18px;
      }
    }
  </style>
</head>

<body>
  <?php include 'partials/header.php'; ?>
  <!-- Background gerak section -->
  <div class="background-image">
    <div class="container-h1">
      <h1 class="h1"><span class="typed-text"></span><span class="cursor">|</span>
        <p>"CodeMart" Solusinya.</p>
      </h1>
    </div>
  </div>
  <!-- Hero section -->
  <div class="hero">
    <h2 class="h2">Temukan Produk</h2>
    <form method="GET" action="">
      <input type="text" name="keyword" placeholder="Cari Produk" value="<?php echo htmlspecialchars($keyword); ?>">
      <button type="submit">Cari</button>
    </form>
  </div>

  <div class="products">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product">
          <img src="admin/uploads/<?php echo htmlspecialchars($row['gambar']); ?>"
            alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
          <h3><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
          <!-- <p>Kategori: <?php echo htmlspecialchars($row['id_kategori']); ?></p> -->
          <p>Deskripsi: <?php echo $row['deskripsi']; ?></p>
          <p class="price">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
          <button onclick="addToCart(<?php echo $row['id_produk']; ?>)">Tambah</button>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align: left;">Produk tidak ditemukan.</p>
    <?php endif; ?>
  </div>


  <script>

    const typedText = document.querySelector(".typed-text");
    const cursor = document.querySelector(".cursor");

    const words = ["Jasa Pembuatan Website?", "Desain Grafis?", "Punya Video Tapi Tidak Bisa Edit?",];
    let wordIndex = 0;
    let charIndex = 0;
    let typing = true;

    function typeEffect() {
      const currentWord = words[wordIndex];

      if (typing) {
        typedText.textContent = currentWord.substring(0, charIndex++);
        if (charIndex > currentWord.length) {
          typing = false;
          setTimeout(typeEffect, 1000); // pause before deleting
        } else {
          setTimeout(typeEffect, 100); // speed of typing
        }
      } else {
        typedText.textContent = currentWord.substring(0, charIndex--);
        if (charIndex < 0) {
          typing = true;
          wordIndex = (wordIndex + 1) % words.length;
          setTimeout(typeEffect, 300);
        } else {
          setTimeout(typeEffect, 50); // speed of deleting
        }
      }
    }

    document.addEventListener("DOMContentLoaded", typeEffect);
  </script>
  <script>
    function addToCart(productId) {
      <?php if (!isset($_SESSION['user_id'])): ?>
        alert("Silakan login terlebih dahulu!");
        window.location.href = "login_user.php";
      <?php else: ?>
        fetch("add_to_cart.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "id_produk=" + productId
        })
          .then(response => response.json())
          .then(data => {
            alert(data.message);
            if (data.status === "success") {
              window.location.reload();
            }
          });
      <?php endif; ?>
    }

    window.addEventListener('DOMContentLoaded', () => {
      if (localStorage.getItem('bannerClosed') === 'true') {
        document.getElementById('introBanner').style.display = 'none';
      }
    });

    function closeBanner() {
      document.getElementById('introBanner').style.display = 'none';
      localStorage.setItem('bannerClosed', 'true');
    }
  </script>
  <footer>
    <?php include 'partials/footer.php'; ?>
  </footer>
</body>

</html>