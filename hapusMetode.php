<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnHapus'])){
    $id = $_POST['idHapus'];

    $query = "DELETE FROM metode_pembayaran WHERE id_metode='$id'";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location = 'metode_pembayaran.php';
            </script>";
    }else{
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location = 'metode_pembayaran.php';
            </script>";
    }
}
?>