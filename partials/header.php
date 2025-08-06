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
      color: white;
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


    .riwayat-pesanan {
      max-width: 1000px;
      margin: 40px auto;
      background: var(--secondary);
      box-shadow: var(--shadow);
      padding: 20px;
      border-radius: 12px;
      overflow-x: auto;
    }

    .riwayat-pesanan h2 {
      color: var(--primary);
      font-size: 2rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .riwayat-pesanan table {
      width: 100%;
      border-collapse: collapse;
    }

    .riwayat-pesanan th,
    .riwayat-pesanan td {
      padding: 12px 16px;
      border-bottom: 1px solid #ccc;
      text-align: center;
    }

    .riwayat-pesanan th {
      background-color: var(--primary);
      color: white;
      font-weight: bold;
    }

    .riwayat-pesanan td {
      color: var(--text);
      font-size: 0.95rem;
    }

    .riwayat-pesanan a {
      background-color: var(--accent);
      color: white;
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .riwayat-pesanan a:hover {
      background-color: var(--dark);
    }

    @media (max-width: 600px) {

      .riwayat-pesanan th,
      .riwayat-pesanan td {
        padding: 8px 10px;
        font-size: 0.85rem;
      }

      .riwayat-pesanan h2 {
        font-size: 1.5rem;
      }
    }

    .back-link {
      display: inline-block;
      margin: 20px;
      padding: 10px 16px;
      background-color: var(--accent);
      /* warna kuning dari tema */
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    < !-- Tambahan CSS di style --><style>.hamburger {
      display: none;
      cursor: pointer;
      z-index: 2001;
    }

    .hamburger span {
      display: block;
      width: 25px;
      height: 3px;
      background-color: var(--dark);
      margin: 5px 0;
      border-radius: 2px;
      transition: 0.4s ease;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    @media (max-width: 768px) {
      .hamburger {
        display: block;
      }

      .menu {
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: var(--primary);
        width: 100%;
        text-align: center;
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
        transition: clip-path 0.4s ease;
      }

      .menu.active {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
      }

      .menu li {
        margin: 1rem 0;
      }
    }

    .logo {
      display: flex;
      align-items: center;
      height: 60px;
    }

    .logo img {
      height: 100px;
      width: auto;
      object-fit: contain;
      transition: 0.3s ease;
      image-rendering: -webkit-optimize-contrast;
    }
  </style>

  <!-- Navbar HTML -->
  <nav>
    <div class="navbar">
      <a href="index.php" class="logo">
        <img src="assets/logorpldp.png" alt="Logo CodeMart">
      </a>

      <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <ul class="menu" id="menu">
        <?php if (isset($_SESSION['user'])): ?>
          <li><span>Hai, <?php echo htmlspecialchars($_SESSION['user']); ?></span></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">Tentang Kami</a></li>
          <li><a href="pesanan.php">Pesanan</a></li>
          <li><a href="keranjang.php">Keranjang</a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">Tentang Kami</a></li>
          <li><a href="login_user.php">Login</a></li>
          <li><a href="login_user.php">Keranjang</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <!-- Script untuk hamburger -->
  <script>
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      menu.classList.toggle('active');
    });
  </script>