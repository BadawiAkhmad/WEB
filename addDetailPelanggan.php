<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
include "koneksi.php";

if (isset($_POST['btnSimpan'])){
    $id = $_POST['id_pelanggan'];
    $nama = $_POST['nama_akun'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $umur = $_POST['umur'];
    $jk = $_POST['gender'];
    $pekerjaan = $_POST['pekerjaan'];
    $tgl = $_POST['Tanggal Lahir'];

    $sql = "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat', telepon = '$telepon', email = '$email', umur = '$umur', gender = '$jk', pekerjaan = '$pekerjaan' where id_pelanggan = '$id'";
    $query = $conn->query($sql);
    if ($query === true) {
        echo "<script>alert('Berhasil Menyimpan Data!');document.location='pelanggan_akun.php';</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan Data!');document.location='pelanggan.php';</script>";
    }
}
