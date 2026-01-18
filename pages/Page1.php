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

    <link rel="stylesheet" href="../assets/css/Page1.css">
</head>
<body>

<header class="topbar">
    <h1 class="logo">BASE CORE</h1>

    <div class="topbar-actions">
        <?php if ($_SESSION['role'] == 1): ?>
            <a href="../admin/question.php" class="admin-panel">Admin Panel</a>
        <?php endif; ?>

        <a href="../auth/logout.php" class="logout">Logout</a>
    </div>
</header>


<section class="profile-box">
    <div class="pfp">
        <?php echo strtoupper(substr($_SESSION['nama'],0,2)); ?>
    </div>
    <div class="profile-info">
        <h2>
    <?php echo $_SESSION['nama']; ?>

    <?php if ($_SESSION['role'] == 1): ?>
        <span class="badge badge-admin">Admin</span>
    <?php else: ?>
        <span class="badge badge-user">Premium</span>
    <?php endif; ?>
</h2>

    </div>
</section>

<section class="info-box">
    <img src="../assets/img/BASE%20CORE.png" alt="base core" class="info-image">
    <h3>WHAT IS BASE CORE</h3>
    <p>
        Base Core sebagai latihan untuk meningkatkan kemampuan
        dasar yang mampu membantu belajar cara belajar.
    </p>
</section>

<section class="core-section">
    <h2>Core Practice</h2>

    <div class="card red">
        <h3>🧮 Matematika</h3>
        <button class="btn-mapel" data-cat="1">Mulai</button>
    </div>

    <div class="card yellow">
        <h3>🇮🇩 Bahasa Indonesia</h3>
        <button class="btn-mapel" data-cat="2">Mulai</button>
    </div>

    <div class="card purple">
        <h3>🇬🇧 Bahasa Inggris</h3>
        <button class="btn-mapel" data-cat="3">Mulai</button>
    </div>

    <div class="card green">
        <h3>🔭 Sains Dasar</h3>
        <button class="btn-mapel" data-cat="4">Mulai</button>
    </div>

    <div class="card blue">
        <h3>🧠 Logic</h3>
        <button class="btn-mapel" data-cat="5">Mulai</button>
    </div>
</section>


<script src="../assets/JS/page1.js"></script>
</body>
</html>