<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnEdit'])){
    $id = $_POST['id_layanan'];
    $nama = $_POST['namaEdit'];
    $deskripsi = $_POST['deskripsiEdit'];
    $harga = $_POST['hargaEdit'];


    $query = "UPDATE layanan SET nama_layanan ='$nama', deskripsi ='$deskripsi', harga ='$harga' WHERE id_layanan = '$id' ";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'layanan.php';
            </script>";
    }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'layanan.php';
            </script>";
    }
}
?>