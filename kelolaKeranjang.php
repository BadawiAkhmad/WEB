<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
include "koneksi.php";
if (isset($_POST['btnHapus'])) {
    // Check if any rows are selected
    if (isset($_POST['selectedRows'])) {
        // Retrieve the selected row IDs
        $selectedRows = $_POST['selectedRows'];


        // Loop through the selected row IDs and delete them from the table
        foreach ($selectedRows as $rowID) {
            $lihatQuery = "SELECT * FROM keranjang WHERE id_keranjang = '$rowID'";
            $c = mysqli_query($conn, $lihatQuery);
            $n = mysqli_fetch_assoc($c);

            if ($n['status'] == "Belum Dipesan" || $n['status'] == "Dibatalkan" ){
                $deleteQuery = "DELETE FROM keranjang WHERE id_keranjang = '$rowID'";
                mysqli_query($conn, $deleteQuery);
            }

        }

        // Rows deleted successfully
        echo "<script>
                alert('Data Yang Sudah Dipesan Tidak Dapat Dihapus!');
                document.location = 'pelanggan_keranjang.php';
            </script>";
    } else {
        // No rows selected
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location = 'pelanggan_keranjang.php';
            </script>";
    }
} else if (isset($_POST['btnAdd'])) {
    if (isset($_POST['selectedRows'])) {

        $selectedRows = $_POST['selectedRows'];
        $idPelanggan = $_POST['id_pelanggan'];

        $total = 0;

        $id_keranjang = array();
        foreach ($selectedRows as $rowID) {
            $sql = "SELECT * FROM keranjang,layanan WHERE keranjang.id_layanan = layanan.id_layanan AND id_keranjang = $rowID";
            $h = mysqli_query($conn, $sql);
            $id_k = mysqli_fetch_assoc($h);
            $total += $id_k['harga'];
        }

        $tanggal = $_POST['tgl'];
        if ($tanggal>0) {
            
            foreach ($selectedRows as $id_keranjang){
                $addquery = "INSERT INTO pesanan (id_keranjang, tanggal_permintaan, id_pelanggan, total_bayar) VALUES ('$id_keranjang','$tanggal','$idPelanggan','$total')";
                mysqli_query($conn, $addquery);
                $addquery1 = "UPDATE keranjang SET status='Sudah Dipesan' where id_keranjang = '$id_keranjang'";
                mysqli_query($conn, $addquery1);
            }

            
            // Rows deleted successfully

            echo "<script>
                    alert('Pesanan Sukses!');
                    document.location = 'pelanggan_keranjang.php';
                 </script>";
        } else {
            echo "<script>
            alert('Masukkan Tanggal!');
            document.location = 'pelanggan_keranjang.php';
         </script>";
        }
    } else {
        // No rows selected
        echo "<script>
                alert('Pesanan Gagal!');
                document.location = 'pelanggan_keranjang.php';
            </script>";
    }
}
