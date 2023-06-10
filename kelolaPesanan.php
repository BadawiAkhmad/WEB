<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

include "koneksi.php";

if (isset($_POST['btnKonfirmasi'])) {
    $konfirmasi = "Pesanan Sudah Dikonfirmasi Oleh Admin";
    $tanggal = date("Y-m-d");

    // Check if any rows are selected
    if (isset($_POST['selectedRows'])) {
        // Retrieve the selected row IDs
        $selectedRows = $_POST['selectedRows'];

        // Loop through the selected row IDs and delete them from the table
        foreach ($selectedRows as $rowID) {
            $konfirmasiQuery = "UPDATE pesanan SET status_konfirmasi = '$konfirmasi', tanggal_konfirmasi = '$tanggal' WHERE id_pesanan = '$rowID' ";
            mysqli_query($conn, $konfirmasiQuery);
        }

        // Rows Update successfully
        echo "<script>
                alert('Data Berhasil Dikonfirmasi!');
                document.location = 'list_pesanan.php';
            </script>";
    } else {
        // No rows selected
        echo "<script>
                alert('Pilih pesanan yang akan dikonfirmasi!');
                document.location = 'list_pesanan.php';
            </script>";
    }
} else if (isset($_POST['btnCancel'])) {
    $cancel = $_POST['detail'];
    $tanggal = date("Y-m-d");

    // Check if any rows are selected
    if (isset($_POST['selectedRows'])) {
        // Retrieve the selected row IDs
        $selectedRows = $_POST['selectedRows'];

        // Loop through the selected row IDs and delete them from the table
        foreach ($selectedRows as $rowID) {
            $cancelQuery = "UPDATE pesanan SET status_konfirmasi = '$cancel', tanggal_konfirmasi = '$tanggal' WHERE id_pesanan = '$rowID' ";
            mysqli_query($conn, $cancelQuery);
        }

        // Rows Update successfully
        echo "<script>
                alert('Cancel Berhasil!');
                document.location = 'list_pesanan.php';
            </script>";
    } else {
        // No rows selected
        echo "<script>
                alert('Cancel Pesanan Gagal!');
                document.location = 'list_pesanan.php';
            </script>";
    }
} else if (isset($_POST['btnDownload'])) {
    $id = $_POST['id_pesan'];



    $sql = "SELECT * FROM pembayaran WHERE id_pesanan = '$id'";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();

        $file_data = $row['bukti'];
        $nama_file = $row['nama_file'];

        $path = "download/" . $nama_file;
        file_put_contents($path, $file_data);


        echo "<script>alert('File berhasil disimpan!');document.location='list_pesanan.php';</script>";
    } else {
        echo "<script>alert('File tidak ditemukan!');document.location='list_pesanan.php';</script>";
    }
}
