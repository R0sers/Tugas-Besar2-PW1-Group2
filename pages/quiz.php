<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$cat = $_GET['cat'] ?? 1;

// ambil nama mapel
$c = mysqli_query($conn, "SELECT name FROM categories WHERE id=$cat");
$category = mysqli_fetch_assoc($c);

// ambil soal sesuai mapel
$q = mysqli_query($conn, "
    SELECT id, question, option_a, option_b, option_c, correct
    FROM questions
    WHERE category_id = $cat
");

$questions = [];
while ($row = mysqli_fetch_assoc($q)) {
    $questions[] = $row;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Quiz <?= $category['name']; ?></title>
    <link rel="stylesheet" href="../assets/CSS/quiz.css">
</head>
<body>

<h2><?= $category['name']; ?></h2>

<div id="q-number"></div>
<div id="q-text"></div>
<div id="options"></div>

<button id="prev">Kembali</button>
<button id="next">Lanjut</button>
<button id="submit" style="display:none">Selesai</button>

<div id="result"></div>

<script>
const categoryId = <?= $cat ?>;
const questions = <?= json_encode($questions); ?>;
</script>
<script src="../assets/JS/logic.js"></script>
</body>
</html>
