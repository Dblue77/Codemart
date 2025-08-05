<?php
session_start();
include "../config.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        // Login sukses
        $_SESSION['admin_id'] = $admin['id_admin'];
        $_SESSION['username'] = $admin['username'];
        header("Location: index.php");
        exit;
    } else {
        $message = "Login gagal. Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>
  <style>
    :root {
      --primary: #5dade2;
      --accent: #3498db;
      --light: #ecf6fc;
      --dark: #2c3e50;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --radius: 12px;
      --transition: 0.3s ease;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--light);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      color: var(--accent);
      margin-bottom: 1.5rem;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: var(--radius);
      transition: border-color var(--transition);
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: var(--accent);
      outline: none;
    }

    button {
      width: 100%;
      padding: 0.8rem;
      background: var(--primary);
      border: none;
      color: white;
      font-weight: bold;
      border-radius: var(--radius);
      cursor: pointer;
      transition: background var(--transition);
    }

    button:hover {
      background: var(--accent);
    }

    .message {
      margin-top: 1rem;
      background: #ffdede;
      color: #a94442;
      padding: 0.8rem;
      border-radius: var(--radius);
    }

    a {
      color: var(--accent);
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <?php if (!empty($message)): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
