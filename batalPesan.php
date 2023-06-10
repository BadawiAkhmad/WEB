<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnHapus'])){
    $id = $_POST['idHapus'];
    $keranjang = $_POST['idKeranjang'];
    $status = $_POST['status'];

    if ($status == "Belum Dikonfirmasi Admin"){
        $q = "UPDATE keranjang SET status = 'Dibatalkan' where id_keranjang = '$keranjang'";
        $s = mysqli_query($conn, $q);

        $query = "DELETE FROM pesanan WHERE id_pesanan='$id'";
        $del = mysqli_query($conn, $query);
        
        echo "<script>
                alert('Pesanan Berhasil Dibatalkan!');
                document.location = 'pelanggan_pesanan.php';
            </script>";
    }else{
        echo "<script>
                alert('Pesanan Tidak Boleh Dibatalkan!');
                document.location = 'pelanggan_pesanan.php';
            </script>";
    }
}
?>