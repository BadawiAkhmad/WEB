<?php
include "koneksi.php";
$nama = $_POST['nama'];
$user = $_POST['username'];
$psw = $_POST['password'];
$psw2 = $_POST['password2'];
$email = $_POST['email'];
$tlp = $_POST['telepon'];
$alamat = $_POST['alamat'];
$level = 0;

if ($psw == $psw2) {
    $sql = "INSERT INTO akun (username, password, access) VALUES ('".$user."', '".$psw."', '".$level."')";
    $query = $conn->query($sql);
    if ($query === true) {
        // Mendapatkan nilai 'user_id' yang dihasilkan
        $user_id = $conn->insert_id;

        $sql3 = "INSERT INTO pelanggan (nama, alamat, telepon, email, id_akun) VALUES ('".$nama."', '".$alamat."', '".$tlp."', '".$email."', '".$user_id."')";
        $query3 = $conn->query($sql3);

        if ($query3 === true) {
            echo "<script>alert('Anda Sukses Registrasi!');document.location='login.php';</script>";
        } else {
            echo "<script>alert('Gagal melakukan insert ke tabel pelanggan!');document.location='register.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal melakukan insert ke tabel users!');document.location='register.php';</script>";
    }
} else {
    echo "<script>alert('Ulangi, Password anda tidak sama!');document.location='register.php';</script>";
}
?>
