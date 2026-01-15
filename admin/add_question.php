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


<form method="post">
    <textarea name="question" placeholder="Soal" required></textarea><br>
    <input name="a" placeholder="Opsi A" required><br>
    <input name="b" placeholder="Opsi B" required><br>
    <input name="c" placeholder="Opsi C" required><br>

    <select name="correct">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>

    <button>Simpan</button>
</form>
