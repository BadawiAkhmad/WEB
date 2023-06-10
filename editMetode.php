<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnEdit'])){
    $id = $_POST['id_metode'];
    $nama = $_POST['metodeEdit'];
    $jalur = $_POST['jalurEdit'];
    $no = $_POST['noEdit'];
    $admin = $_POST['adminEdit'];




    $query = "UPDATE metode_pembayaran SET nama_metode ='$nama', jalur_layanan ='$jalur', no_tujuan ='$no', id_admin = '$admin'  WHERE id_metode = '$id' ";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'metode_pembayaran.php';
            </script>";
    }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'metode_pembayaran.php';
            </script>";
    }
}
?>