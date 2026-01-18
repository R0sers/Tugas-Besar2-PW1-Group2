<?php
session_start();
include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role_id'];

        header("Location: ../pages/page1.php");
        exit;
    } else {
        echo "<script>alert('Email atau password salah');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

  <div class="auth-box">
    <h2>Login</h2>
    <img src="../assets/img/basecore1.png" alt="">
    <p>Masuk ke Base Core</p>

    <form action="#" method="post">
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-group password-group">
            <label>Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁</span>
            </div>
</div>

<script src="../assets/js/auth.js"></script>


      <button type="submit">Login</button>
    </form>

    <div class="switch">
      Belum punya akun? <a href="register.php">Daftar</a>
    </div>
  </div>

</body>

<script src="../assets/js/auth.js"></script>
</html>
