<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login User - CodeMart</title>
  <style>
    :root {
      --primary: #004976;
      --secondary: #A2F4FA;
      --accent: #FDC400;
      --dark: #222222;
      --light: #ffffff;
      --text: #333333;
      --shadow: 0 10px 25px rgba(0, 73, 118, 0.2);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg,
          rgba(0, 73, 118, 0.9),
          rgba(162, 244, 250, 0.9));
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }

    .login-container {
      background-color: var(--light);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 420px;
      animation: fadeIn 0.6s ease;
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
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 15px;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: var(--primary);
    }

    button {
      width: 100%;
      background-color: var(--primary);
      color: white;
      padding: 14px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #003355;
    }

    p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #444;
    }

    a {
      color: var(--primary);
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login Pengguna</h2>
    <form action="proses_login_user.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required />

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />

      <button type="submit">Masuk</button>

      <p>Belum punya akun? <a href="register_user.php">Daftar sekarang</a></p>
    </form>
  </div>
</body>

</html>