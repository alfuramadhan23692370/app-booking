<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    // Ganti ini dengan username/password admin yang sah
    if ($username === "admin" && $password === "admin123") {
        $_SESSION["admin_logged_in"] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1604145559206-f84d0c634f3d?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 10%;
            padding: 30px;
            background-color: rgba(255,255,255,0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .login-title {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-title">Login Admin</div>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100" type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
