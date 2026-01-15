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

<form method="post">
    <textarea name="question"><?= $q['question'] ?></textarea><br>
    <input name="a" value="<?= $q['option_a'] ?>"><br>
    <input name="b" value="<?= $q['option_b'] ?>"><br>
    <input name="c" value="<?= $q['option_c'] ?>"><br>

    <select name="correct">
        <option <?= $q['correct']=="A"?"selected":"" ?>>A</option>
        <option <?= $q['correct']=="B"?"selected":"" ?>>B</option>
        <option <?= $q['correct']=="C"?"selected":"" ?>>C</option>
    </select>

    <button>Update</button>
</form>
