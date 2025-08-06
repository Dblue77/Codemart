<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CodeMart</title>
    <style>
        :root {
            --primary: #004976;
            --accent: #FDC400;
            --secondary: #A2F4FA;
            --light: #ffffff;
            --dark: #222831;
            --bg: #F5F7FA;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--primary);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: var(--light);
            margin-right: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            color: var(--accent);
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            color: var(--primary);
            margin-top: 40px;
        }

        form {
            background: var(--light);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: var(--accent);
            color: var(--dark);
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #e6b800;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--light);
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: var(--primary);
            color: var(--light);
        }

        td img {
            max-width: 60px;
            border-radius: 4px;
        }

        a.action {
            color: var(--primary);
            font-weight: bold;
            margin-right: 10px;
        }

        a.action:hover {
            text-decoration: underline;
        }

        .user-info {
            text-align: right;
            color: var(--dark);
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div>
            <a href="index.php">Dashboard</a>
            <a href="kategori.php">Kategori</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="user-info">
            Halo, <?php echo $_SESSION['username'] ?>
        </div>
    </div>

    <div class="container">
        <!-- Tempatkan semua form, tabel, dan section lain di sini -->
        <!-- ... potongan HTML yang kamu punya tinggal dipindahkan ke dalam div.container ini -->
    </div>
</body>

</html>