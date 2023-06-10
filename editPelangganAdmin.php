<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnEdit'])){
    $id = $_POST['id_pelanggan'];
    $nama = $_POST['namaEdit'];
    $alamat = $_POST['alamatEdit'];
    $telepon = $_POST['teleponEdit'];
    $email = $_POST['emailEdit'];
    $umur = $_POST['umurEdit'];
    $jk = $_POST['jkEdit'];
    $pekerjaan = $_POST['pekerjaanEdit'];
    $tanggal = $_POST['tglLahir'];

    if (!empty($tanggal)){
        
        $query = "UPDATE pelanggan SET nama ='$nama', alamat ='$alamat', telepon ='$telepon', email ='$email', umur ='$umur', gender ='$jk', pekerjaan ='$pekerjaan', tanggal_lahir = '$tanggal' WHERE id_pelanggan = '$id' ";

         $simpan = mysqli_query($conn, $query);
    
         //Cek hasil Save
        if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'pelanggan.php';
            </script>";
        }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'pelanggan.php';
            </script>";
        }
    }else{
        $query = "UPDATE pelanggan SET nama ='$nama', alamat ='$alamat', telepon ='$telepon', email ='$email', umur ='$umur', gender ='$jk', pekerjaan ='$pekerjaan' WHERE id_pelanggan = '$id' ";

         $simpan = mysqli_query($conn, $query);
    
         //Cek hasil Save
        if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'pelanggan.php';
            </script>";
        }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'pelanggan.php';
            </script>";
        }
    }

}
?>