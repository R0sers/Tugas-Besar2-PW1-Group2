<?php
$conn = mysqli_connect("localhost", "root", "", "base_core");

if (!$conn) {
  die("Koneksi database gagal");
}
