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

    .captcha-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      background: rgba(255, 255, 255, 0.15);
      padding: 14px;
      border-radius: 10px;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      max-width: 300px;
      margin: auto;
    }

    .captcha-box img {
      border-radius: 8px;
      height: 60px;
      width: auto;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .captcha-input-refresh {
      display: flex;
      gap: 10px;
      width: 100%;
    }

    .captcha-input-refresh input {
      flex: 1;
      height: 50px;
      padding: 0 12px;
      font-size: 16px;
      color: #333;
      background: rgba(255, 255, 255, 0.8);
      border: 1px solid transparent;
      border-radius: 8px;
      outline: none;
      transition: all 0.3s ease;
    }

    .captcha-input-refresh input:focus {
      border-color: #4a90e2;
      background: #fff;
      box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
    }

    .refresh-captcha {
      height: 50px;
      width: 50px;
      background: linear-gradient(135deg, #4a90e2, #357ABD);
      color: white;
      border: none;
      font-size: 18px;
      cursor: pointer;
      border-radius: 8px;
      transition: transform 0.2s ease, background 0.3s ease;
    }

    .refresh-captcha:hover {
      background: linear-gradient(135deg, #5aa0ff, #3b6fd1);
      transform: rotate(90deg);
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

      <label>Captcha:</label>
      <div class="captcha-box">
        <img id="captchaImage" src="captcha.php?rand=<?php echo time(); ?>" alt="Captcha">

        <div class="captcha-input-refresh">
          <input type="text" name="captcha" placeholder="Masukkan kode" required>
          <button type="button" id="refreshCaptcha" class="refresh-captcha" aria-label="Refresh captcha">↻</button>
        </div>
      </div>


      <button type="submit">Masuk</button>

      <p>Belum punya akun? <a href="register_user.php">Daftar sekarang</a></p>
    </form>
  </div>

  <script>
    document.getElementById('refreshCaptcha').addEventListener('click', function () {
      document.getElementById('captchaImage').src = 'captcha.php?rand=' + Date.now();
    });
  </script>

</body>

</html>