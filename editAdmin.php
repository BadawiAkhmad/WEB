<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnEdit'])){
    $id = $_POST['id_admin'];
    $nama = $_POST['namaEdit'];
    $alamat = $_POST['alamatEdit'];
    $telepon = $_POST['teleponEdit'];
    $email = $_POST['emailEdit'];
    $jabatan = $_POST['jabatanEdit'];


    $query = "UPDATE admin SET nama_admin ='$nama', alamat ='$alamat', telepon ='$telepon', email ='$email', jabatan = '$jabatan' WHERE id_admin = '$id' ";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'admin.php';
            </script>";
    }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'admin.php';
            </script>";
    }
}
?>