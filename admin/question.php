<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: ../auth/login.php");
    exit;
}

$cat = $_GET['cat'] ?? 1;

$categories = mysqli_query($conn, "SELECT * FROM categories");
$questions = mysqli_query($conn, "
    SELECT * FROM questions WHERE category_id = $cat
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Soal</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<h2>Kelola Soal</h2>

<form method="get">
    <select name="cat" onchange="this.form.submit()">
        <?php while($c = mysqli_fetch_assoc($categories)): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id']==$cat?'selected':'' ?>>
                <?= $c['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<br>

<a href="add_question.php?cat=<?= $cat ?>">+ Tambah Soal</a>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Soal</th>
    <th>Jawaban</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($q = mysqli_fetch_assoc($questions)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $q['question'] ?></td>
    <td><?= $q['correct'] ?></td>
    <td>
        <a href="edit_question.php?id=<?= $q['id'] ?>">Edit</a> |
        <a href="delete_question.php?id=<?= $q['id'] ?>" onclick="return confirm('Hapus soal?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
