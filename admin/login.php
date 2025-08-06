<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #1cd8e9ff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 350px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 25px;
      color: #333;
    }

    .login-container label {
      display: block;
      margin-bottom: 5px;
      text-align: left;
      color: #444;
    }

    .login-container input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .login-container button {
      width: 100%;
      padding: 10px;
      background-color: #2575fc;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-container button:hover {
      background-color: #1a5bd7;
    }

    .login-container p {
      margin-top: 15px;
      font-size: 14px;
    }

    .login-container a {
      color: #2575fc;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="login-container">

    <h2>Login Admin</h2>
    <form action="proses_login.php" method="POST">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>

</body>

</html>