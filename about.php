<?php
session_start();
include "config.php"; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - CodeMart</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #0066cc;
            color: white;
            padding: 16px 10px;
            text-align: center;
        }

        main {
            padding: 40px 20px;
            max-width: 900px;
            margin: auto;
        }

        h1,
        .judul {
            color: #000509ff;
        }
        h3 {
            color: #004080;
        }

        li {
            margin-bottom: 10px;
        }

        footer {
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <?php include 'partials/header.php'; ?>
    <main>
        <h2 class="judul">Selamat datang di <strong>CodeMart</strong>!</h2>
        <p><strong>CodeMart</strong> adalah penyedia jasa digital kreatif yang berfokus pada solusi desain dan
            teknologi. Kami hadir untuk membantu Anda mewujudkan ide-ide kreatif menjadi kenyataan digital yang
            profesional dan menarik.</p>

        <h3>Layanan Kami</h3>
        <ul>
            <li>🌐 Pembuatan Website (Company Profile, Toko Online, Portfolio, dsb.)</li>
            <li>🎨 Desain Banner, Poster, dan Konten Media Sosial</li>
            <li>✍️ Jasa Desain Logo dan Identitas Brand</li>
            <li>🎬 Jasa Edit Video untuk Konten Promosi, Sosial Media, dan Lainnya</li>
            <li>📦 Paket Lengkap Branding & Promosi Digital</li>
        </ul>

        <h3>Misi Kami</h3>
        <p>Kami berkomitmen untuk memberikan layanan yang cepat, berkualitas, dan sesuai dengan kebutuhan Anda. CodeMart
            percaya bahwa desain yang baik dan website yang optimal adalah kunci sukses di era digital.</p>

        <h3>Mengapa Memilih CodeMart?</h3>
        <ul>
            <li>✅ Desain custom dan profesional</li>
            <li>💬 Komunikasi mudah dan pelayanan ramah</li>
            <li>🚀 Proses cepat dan harga terjangkau</li>
            <li>🛠️ Tim kreatif yang berpengalaman</li>
        </ul>

        <p>Kami siap menjadi partner digital terbaik Anda. Hubungi kami sekarang dan mulai wujudkan proyek impian Anda
            bersama CodeMart!</p>
    </main>

    <footer>
        <?php include 'partials/footer.php'; ?>
    </footer>
</body>

</html>