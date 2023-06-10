<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnUploud'])){
    $metode = $_POST['metode'];
    $jalur = $_POST['jalur'];
    $no = $_POST['no'];
    $id = $_POST['id_pesanan'];
    $file = $_FILES['file']['tmp_name'];
    $nama_file = $_FILES['file']['name'];
    if (!empty($file)) {

        $sql = "SELECT * FROM metode_pembayaran WHERE nama_metode = '$metode' and jalur_layanan = '$jalur' and no_tujuan = '$no'";
        $h = mysqli_query($conn, $sql);

        $n = mysqli_fetch_assoc($h);

        $id_metode = $n['id_metode'];

        // Read the file content as binary
        $data = addslashes(file_get_contents($file));

        // Prepare the query to insert file data into the database
        $query = "INSERT INTO pembayaran (id_metode, bukti, nama_file, id_pesanan) VALUES ('$id_metode', '$data', '$nama_file', '$id')";

        // Execute the query
        $result = mysqli_query($conn, $query);

        if ($result) {
            $update = "UPDATE pesanan SET status_pembayaran = 'Sudah Uploud Bukti Transfer' where id_pesanan = '$id'";
            $has = mysqli_query($conn, $update);
            if($has){
                // Display success message
                echo "<script>alert('Berhasil Uploud!');document.location='pelanggan_pesanan.php';</script>";
            }else{
                // Display error message
                echo "<script>alert('Error dalam Uploud!');document.location='pelanggan_pesanan.php';</script>";
            }
            
        } else {
            // Display error message
            echo "<script>alert('Error dalam Uploud!');document.location='pelanggan_pesanan.php';</script>";
        }
    } else {
        // File was not selected
        echo "<script>alert('Silahkan Pilih File Terlebih Dahulu!');document.location='pelanggan_pesanan.php';</script>";
    }
}
?>