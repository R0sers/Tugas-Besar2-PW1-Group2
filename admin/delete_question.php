<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM questions WHERE id=$id");

header("Location: question.php");
