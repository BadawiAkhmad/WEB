<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

include "koneksi.php";
$nama = $_POST['nama'];
$user = $_POST['username'];
$psw = $_POST['password'];
$psw2 = $_POST['password2'];
$email = $_POST['email'];
$tlp = $_POST['telepon'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$akses = 1;

if ($psw == $psw2) {
    $sql = "INSERT INTO akun (username, password, access) VALUES ('".$user."', '".$psw."', '".$akses."')";
    $query = $conn->query($sql);
    if ($query === true) {
        // Mendapatkan nilai 'user_id' yang dihasilkan
        $user_id = $conn->insert_id;

            $sql3 = "INSERT INTO admin (nama_admin, alamat, telepon, email, jabatan, id_akun) VALUES ('".$nama."', '".$alamat."', '".$tlp."', '".$email."', '".$jabatan."', '".$user_id."')";
            $query3 = $conn->query($sql3);

            if ($query3 === true) {
            echo "<script>alert('Admin Berhasil Ditambahkan!');document.location='admin.php';</script>";
            } else {
            echo "<script>alert('Gagal Menambahkan Admin!');document.location='admin.php';</script>";
            }
        
    } else {
        echo "<script>alert('Gagal melakukan penambahan admin!');document.location='admin.php';</script>";
    }
} else {
    echo "<script>alert('Ulangi, Password anda tidak sama!');document.location='admin.php';</script>";
}