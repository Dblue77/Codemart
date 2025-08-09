<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User - CodeMart</title>
  <style>
    :root {
      --primary: #0d6efd;
      --primary-hover: #0b5ed7;
      --bg: #f5f5f5;
      --light: #ffffff;
      --text: #333333;
      --accent: #ffc107;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, rgba(0, 73, 118, 0.9), rgba(162, 244, 250, 0.9));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-box {
      background: var(--light);
      padding: 35px 30px;
      border-radius: 10px;
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 380px;
    }

    .logo {
      text-align: center;
      margin-bottom: 10px;
    }

    .logo img {
      height: 100px;
    }

    h2 {
      text-align: center;
      font-size: 20px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 25px;
    }

    .input-group {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
      background: #fff;
      overflow: hidden;
    }

    .input-group i {
      background: #f1f1f1;
      padding: 10px;
      font-size: 16px;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
    }

    .input-group input {
      flex: 1;
      padding: 10px;
      border: none;
      outline: none;
      font-size: 14px;
    }

    .input-group input:focus {
      background: #fff;
    }

    /* Captcha */
    .captcha-container {
      margin-bottom: 15px;
    }

    .captcha-box {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 8px;
      padding: 8px;
      border-radius: 6px;
    }

    .captcha-box img {
      height: 50px;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .refresh-captcha {
      background: var(--accent);
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 40px;
      height: 40px;
      font-size: 18px;
      color: #fff;
    }

    .refresh-captcha:hover {
      background: #e0a800;
    }

    /* Button */
    button[type="submit"] {
      width: 100%;
      padding: 12px;
      border: none;
      background: var(--primary);
      color: white;
      font-size: 15px;
      font-weight: 500;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.2s;
    }

    button[type="submit"]:hover {
      background: var(--primary-hover);
    }

    p {
      text-align: center;
      font-size: 13px;
      color: #555;
      margin-top: 15px;
    }

    a {
      color: var(--primary);
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .password-group {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      cursor: pointer;
      color: #888;
      display: flex;
      align-items: center;
      font-size: 16px;
    }

    .toggle-password:hover {
      color: var(--primary);
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <div class="login-box">
    <div class="logo">
      <img src="assets/logorpldp.png" alt="CodeMart Logo">
    </div>
    <h2>Masuk ke Akun Anda</h2>
    <form action="proses_login_user.php" method="POST">

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Masukkan username" required>
      </div>

      <div class="input-group password-group">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        <span class="toggle-password"><i class="fas fa-eye-slash"></i></span>
      </div>

      <div class="captcha-container">
        <label style="font-size:14px; font-weight:500; color:#333; margin-bottom:5px; display:block;">
          <i class="fas fa-shield-alt"></i> Verifikasi Captcha
        </label>
        <div class="captcha-box">
          <img id="captchaImage" src="captcha.php?rand=<?php echo time(); ?>" alt="Captcha">
          <button type="button" id="refreshCaptcha" class="refresh-captcha"><i class="fas fa-sync-alt"></i></button>
        </div>
        <div class="input-group">
          <i class="fas fa-key"></i>
          <input type="text" name="captcha" placeholder="Masukkan kode captcha" required>
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

    document.querySelector('.toggle-password').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });


  </script>
  
</body>

</html>