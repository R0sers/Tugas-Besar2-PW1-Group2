<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$cat = $_GET['cat'] ?? 1;

/* ambil nama mapel */
$c = mysqli_query($conn, "SELECT name FROM categories WHERE id = $cat");
$category = mysqli_fetch_assoc($c);

/* ambil soal */
$q = mysqli_query($conn, "
    SELECT id, question, option_a, option_b, option_c, correct
    FROM questions
    WHERE category_id = $cat
");

$questions = [];
while ($row = mysqli_fetch_assoc($q)) {
    $questions[] = $row;
}

/* mapping tema */
$themeMap = [
    1 => "math",
    2 => "indo",
    3 => "english",
    4 => "sains",
    5 => "logic"
];

$theme = $themeMap[$cat] ?? "Logic";
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Quiz <?= htmlspecialchars($category['name']) ?></title>

   
    <link rel="stylesheet" href="../assets/CSS/quiz.css">


    <link rel="stylesheet" href="../assets/CSS/<?= $theme ?>.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="title"><?= htmlspecialchars($category['name']) ?></div>
            <div class="subtitle" id="progress-text">1/<?= count($questions) ?> Soal</div>
        </div>
        <div class="header-right">
            <div class="progress-pill" id="progress-pill">
                1/<?= count($questions) ?> Soal
            </div>
            <button class="back-btn" onclick="history.back()">Kembali</button>
        </div>
    </div>

    <!-- CARD -->
    <div class="card">
        <div class="question-header">
            <div class="q-number" id="q-number">Soal 1</div>
            <div class="q-diff">Pilihan A / B / C</div>
        </div>

        <div class="q-text" id="q-text"></div>
        <div class="options" id="options"></div>

        <div class="controls">
            <div>
                <button class="secondary" id="prev">Kembali</button>
                <button class="secondary" id="next">Lanjut</button>
            </div>
            <button class="report">🚩 Lapor Soal</button>
        </div>

        <div class="footer-note">
            Pilih jawaban, lalu tekan lanjut untuk ke soal berikutnya.
        </div>

        <div id="result"></div>
    </div>
</div>

<!-- FINISH SCREEN -->
<div id="finish-screen" style="display:none;">
    <h3>🎉 Quiz Selesai</h3>
    <p id="final-score"></p>
    <div class="finish-actions">
        <button onclick="window.location.href='../pages/Page1.php'">
            Kembali ke Dashboard
        </button>
    </div>
</div>

<!-- DATA SOAL -->
<script>
const questions = <?= json_encode($questions); ?>;
</script>

<!-- LOGIC -->
<script src="../assets/JS/logic.js"></script>

</body>
</html>
