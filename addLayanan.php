<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
include "koneksi.php";
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];


    $sql = "INSERT INTO layanan (nama_layanan, deskripsi, harga) VALUES ('".$nama."', '".$deskripsi."', '".$harga."')";
    $query = $conn->query($sql);
    if ($query === true) {
        echo "<script>alert('Berhasil menambahkan layanan!');document.location='layanan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan layanan!');document.location='layanan.php';</script>";
    }
?>