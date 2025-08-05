<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi User - CodeMart</title>
  <style>
    :root {
      --primary: #004976;
      --secondary: #A2F4FA;
      --accent: #FDC400;
      --dark: #222;
      --light: #fff;
      --text: #333;
      --shadow: 0 10px 25px rgba(0, 73, 118, 0.15);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, rgba(0, 73, 118, 0.9), rgba(162, 244, 250, 0.9));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .register-container {
      background: var(--light);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 500px;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: var(--primary);
      margin-bottom: 30px;
      font-size: 24px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: var(--dark);
    }

    input[type="text"],
    input[type="password"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 15px;
      transition: border-color 0.3s;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: var(--primary);
    }

    textarea {
      resize: vertical;
    }

    button {
      width: 100%;
      background-color: var(--primary);
      color: var(--light);
      padding: 14px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #003355;
    }

    @media (max-width: 480px) {
      .register-container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="register-container">
    <h2>Registrasi Pengguna</h2>
    <form action="proses_register_user.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required />

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />

      <label for="nama_lengkap">Nama Lengkap:</label>
      <input type="text" name="nama_lengkap" id="nama_lengkap" required />

      <label for="no_telepon">No Telepon:</label>
      <input type="number" name="no_telepon" id="no_telepon" required />

      <label for="alamat">Alamat:</label>
      <textarea name="alamat" id="alamat" rows="3" required></textarea>

      <button type="submit">Daftar</button>
    </form>
  </div>
</body>
</html>
