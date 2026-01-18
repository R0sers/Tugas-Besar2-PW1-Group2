<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: ../auth/login.php");
    exit;
}

$cat = $_GET['cat'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysqli_query($conn, "
        INSERT INTO questions
        (category_id, question, option_a, option_b, option_c, correct)
        VALUES (
            $cat,
            '$_POST[question]',
            '$_POST[a]',
            '$_POST[b]',
            '$_POST[c]',
            '$_POST[correct]'
        )
    ");
    header("Location: question.php?cat=$cat");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Soal</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-container">
    <h2>➕ Tambah Soal</h2>

    <form method="post" class="admin-form">
        <label>Soal</label>
        <textarea name="question" placeholder="Tulis soal..." required></textarea>

        <label>Opsi A</label>
        <input name="a" placeholder="Jawaban A" required>

        <label>Opsi B</label>
        <input name="b" placeholder="Jawaban B" required>

        <label>Opsi C</label>
        <input name="c" placeholder="Jawaban C" required>

        <label>Jawaban Benar</label>
        <select name="correct">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        <button type="submit" class="btn-primary">Simpan Soal</button>
    </form>
</div>

    
</body>



