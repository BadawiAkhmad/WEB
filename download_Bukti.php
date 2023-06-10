<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

include "koneksi.php";
$id = $_POST['bukti'];



$sql = "SELECT * FROM pembayaran WHERE id_pembayaran = '$id'";
$query = $conn->query($sql);
if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();

    $file_data = $row['bukti'];
    $nama_file = $row['nama_file'];

    $path = "download/" . $nama_file;
    file_put_contents($path, $file_data);


    echo "<script>alert('File berhasil disimpan!');document.location='list_pesanan.php';</script>";
} else {
    echo "<script>alert('File tidak ditemukan!');document.location='list_pesanan.php';</script>";
}
