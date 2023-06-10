<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnHapus'])){
    $id = $_POST['idHapus'];

    $query = "DELETE FROM akun WHERE id_akun ='$id'";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location = 'pelanggan.php';
            </script>";
    }else{
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location = 'pelanggan.php';
            </script>";
    }
}
?>