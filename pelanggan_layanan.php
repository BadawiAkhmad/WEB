<!doctype html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}

$username = $_SESSION['login_user'];

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Pelanggan.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">

</head>

<body>
    <!--Navbar-->
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white">
                <i class="fa-regular fa-bell"></i>
                Barry Putra Wedding Organizer
            </a>

            <div class="icon">
                <a href="logout.php" style="text-decoration: none;">
                    <i class="fas fa-right-from-bracket text-white" data-toggle="tooltip" title="Sign Out"></i>
                </a>

            </div>

        </div>
    </nav>

    <div class="row no-gutters mt-5">
        <!--Side Bar-->
        <div class="col-md-2 mt-2 p-3">
            <ul class="nav flex-column m-lg-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan_layanan.php"><i class="fa-solid fa-cash-register"></i>Layanan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan_keranjang.php"><i class="fa-solid fa-cart-shopping"></i>Keranjang</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan_pesanan.php"><i class="fa-solid fa-bell-concierge"></i>Pesanan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan_akun.php"><i class="fa-solid fa-clipboard-user"></i>Account</a>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>

        <!--Main Bar-->
        <div class="col-md-10 mt-3">
            <h3><i class="fa-solid fa-cash-register"></i>List Layanan</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database
            $query = "SELECT * FROM layanan ";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <form action="" method="POST">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID layanan</th>
                                <th scope="col">Layanan</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?= $row['id_layanan'] ?></td>
                                    <td><?= $row['nama_layanan'] ?></td>
                                    <td><?= $row['deskripsi'] ?></td>
                                    <td><?= $row['harga'] ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="selectedRows[]" value="<?= $row['id_layanan'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <!-- Btn Add -->
                    <button type="submit" class="btn btn-primary w-25 mb-3" name="addToCart">
                        <i class="fa-solid fa-square-plus rounded"></i> Masukkan Keranjang
                    </button>
                </form>
            </div>

            <?php
                        
            if (!isset($_SESSION['login_user'])) {
                header("location: login.php");
            }
            
            $username = $_SESSION['login_user'];
            
            // Mengambil id_pelanggan
            $queryID = "SELECT * FROM akun WHERE username = '$username'";
            $resultID = mysqli_query($conn, $queryID);
            $id = mysqli_fetch_assoc($resultID);
            $id_akun=$id['id_akun'];
                        
            $p_id="SELECT * FROM pelanggan WHERE id_akun = '$id_akun' ";
            $resultPID = mysqli_query($conn, $p_id);
            $id_2 = mysqli_fetch_assoc($resultPID);
            $id_pelanggan = $id_2['id_pelanggan'];

            
            if (isset($_POST['addToCart'])) {
                // Check if any rows are selected
                if (isset($_POST['selectedRows'])) {
                    // Retrieve the selected row IDs
                    $selectedRows = $_POST['selectedRows'];

                    // Loop through the selected row IDs and insert them into the other table
                    foreach ($selectedRows as $rowID) {
                        $insertQuery = "INSERT INTO keranjang (id_layanan, id_pelanggan) VALUES ('$rowID', '$id_pelanggan')";
                        mysqli_query($conn, $insertQuery);
                    }
                    // Insert successful
                    echo "<script>
                            alert('Data Berhasil Masuk Keranjang!');
                            document.location = 'pelanggan_layanan.php';
                        </script>";
                } else {
                    // No rows selected
                    echo "<script>
                            alert('Data gagal Masuk Keranjang!');
                            document.location = 'pelanggan_layanan.php';
                        </script>";
                }
            }
            ?>


        </div>
    </div>
    </div>




    <script type="text/javascript" src="Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>