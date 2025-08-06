<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register Admin</title>
  <style>
    body {
      background-color: #13e7e7ff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background-color: #ffffff;
      padding: 35px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      color: #4a5568;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #2d3748;
      font-size: 0.95em;
      font-weight: 600;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #cbd5e0;
      border-radius: 8px;
      background-color: #f7fafc;
      font-size: 1em;
      color: #2d3748;
      transition: border 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #63b3ed;
      outline: none;
      background-color: #fff;
    }

    button {
      width: 100%;
      background-color: #63b3ed;
      color: white;
      border: none;
      padding: 12px;
      font-size: 1em;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #4299e1;
    }

    p {
      text-align: center;
      margin-top: 20px;
      font-size: 0.95em;
      color: #4a5568;
    }

    a {
      color: #3182ce;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <form action="proses_register.php" method="POST">
    <h2>Register Admin</h2>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Register</button>

    <p>Sudah punya akun? <a href="login.php">Silahkan Login</a></p>
  </form>

</body>

</html>