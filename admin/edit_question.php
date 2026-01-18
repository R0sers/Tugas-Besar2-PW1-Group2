<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];
$q = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM questions WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD']=="POST") {
    mysqli_query($conn,"
        UPDATE questions SET
        question='$_POST[question]',
        option_a='$_POST[a]',
        option_b='$_POST[b]',
        option_c='$_POST[c]',
        correct='$_POST[correct]'
        WHERE id=$id
    ");
    header("Location: question.php?cat=".$q['category_id']);
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
    <h2>Edit Soal</h2>

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
