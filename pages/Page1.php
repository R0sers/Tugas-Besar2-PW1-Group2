<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Core</title>
    <link rel="stylesheet" href="../assets/CSS/page1.css">
</head>
<body>

<header class="topbar">
    <h1 class="logo">BASE CORE</h1>
    <a href="../auth/logout.php" class="logout">Logout</a>
</header>

<section class="profile-box">
    <div class="pfp">
        <?php echo strtoupper(substr($_SESSION['nama'],0,2)); ?>
    </div>
    <div class="profile-info">
        <h2>
            <?php echo $_SESSION['nama']; ?>
            <span class="badge">Premium</span>
        </h2>
    </div>
</section>

<section class="info-box">
    <h3>WHAT IS BASE CORE</h3>
    <p>
        Base Core sebagai latihan untuk meningkatkan kemampuan
        dasar yang mampu membantu belajar cara belajar.
    </p>
</section>

<section class="core-section">
    <h2>Core Practice</h2>

    <div class="card red">
        <h3>Matematika</h3>
        <button onclick="location.href='math.php'">Mulai</button>
    </div>

    <div class="card yellow">
        <h3>Bahasa Indonesia</h3>
        <button onclick="location.href='indo.php'">Mulai</button>
    </div>

    <div class="card purple">
        <h3>Bahasa Inggris</h3>
        <button onclick="location.href='english.php'">Mulai</button>
    </div>

    <div class="card green">
        <h3>Sains Dasar</h3>
        <button onclick="location.href='sains.php'">Mulai</button>
    </div>

    <div class="card blue">
        <h3>Logic</h3>
        <button onclick="location.href='logic.php'">Mulai</button>
    </div>
</section>

<script src="../assets/js/page1.js"></script>
</body>
</html>
