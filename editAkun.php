<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

include "koneksi.php";

if (isset($_POST['btnEdit'])){
    $id = $_POST['user_id'];
    $username = $_POST['usernameEdit'];
    $pass = $_POST['passwordEdit'];

    $query = "UPDATE akun SET username ='$username', password ='$pass' WHERE id_akun = $id";

    $simpan = mysqli_query($conn, $query);
    
    //Cek hasil Save
    if($simpan){
        echo "<script>
                alert('Edit Data Sukses!');
                document.location = 'akun.php';
            </script>";
    }else{
        echo "<script>
                alert('Edit Data Gagal!');
                document.location = 'akun.php';
            </script>";
    }
}
?>