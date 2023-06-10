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
$akses = $_POST['akses'];
$jabatan = $_POST['jabatan'];

if ($psw == $psw2) {
    $sql = "INSERT INTO akun (username, password, access) VALUES ('".$user."', '".$psw."', '".$akses."')";
    $query = $conn->query($sql);
    if ($query === true) {
        // Mendapatkan nilai 'user_id' yang dihasilkan
        $user_id = $conn->insert_id;

        if($akses==0){
            $sql3 = "INSERT INTO pelanggan (nama, alamat, telepon, email, id_akun) VALUES ('".$nama."', '".$alamat."', '".$tlp."', '".$email."', '".$user_id."')";
            $query3 = $conn->query($sql3);

            if ($query3 === true) {
            echo "<script>alert('Akun Berhasil Dibuat!');document.location='akun.php';</script>";
            } else {
            echo "<script>alert('Gagal Membuat Akun!');document.location='akun.php';</script>";
            }
        }else{
            $sql3 = "INSERT INTO admin (nama_admin, alamat, telepon, email, jabatan, id_akun) VALUES ('".$nama."', '".$alamat."', '".$tlp."', '".$email."', '".$jabatan."', '".$user_id."')";
            $query3 = $conn->query($sql3);

            if ($query3 === true) {
            echo "<script>alert('Akun Berhasil Dibuat!');document.location='akun.php';</script>";
            } else {
            echo "<script>alert('Gagal Membuat Akun!');document.location='akun.php';</script>";
            }
        }
        
    } else {
        echo "<script>alert('Gagal melakukan pembuatan akun!');document.location='akun.php';</script>";
    }
} else {
    echo "<script>alert('Ulangi, Password anda tidak sama!');document.location='akun.php';</script>";
}
