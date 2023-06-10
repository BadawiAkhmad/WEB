<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
include "koneksi.php";
$nama = $_POST['namaAdd'];
$jalur = $_POST['jalurAdd'];
$no = $_POST['nomor_tujuan'];
$id = $_POST['adminAdd'];



    $sql = "INSERT INTO metode_pembayaran (nama_metode, jalur_layanan, no_tujuan, id_admin) VALUES ('".$nama."', '".$jalur."', '".$no."', '".$id."')";
    $query = $conn->query($sql);
    if ($query === true) {
        echo "<script>alert('Berhasil menambahkan metode!');document.location='metode_pembayaran.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan metode!');document.location='metode_pembaran.php';</script>";
    }
?>