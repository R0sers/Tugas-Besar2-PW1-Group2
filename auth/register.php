<?php
include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar');</script>";
    } else {
        mysqli_query($conn, "
            INSERT INTO users (nama, email, password, role_id)
            VALUES ('$nama', '$email', '$password', 2)
        ");
        header("Location: login.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

  <div class="auth-box">
    <h2>Register</h2>
    <p>Buat akun baru</p>

    <form action="#" method="post">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
      </div>

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


      <button type="submit">Daftar</button>
    </form>

    <div class="switch">
      Sudah punya akun? <a href="login.php">Login</a>
    </div>
  </div>

</body>

<script src="../assets/js/auth.js"></script>
</html>
