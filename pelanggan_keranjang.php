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
            <h3><i class="fa-solid fa-cart-shopping"></i>Keranjang</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database
            $username = $_SESSION['login_user'];
            $q1 = "SELECT * FROM pelanggan, akun where pelanggan.id_akun = akun.id_akun AND akun.username = '$username'";
            $r1 = mysqli_query($conn, $q1);
            $has1 = mysqli_fetch_assoc($r1);

            $id_p = $has1['id_pelanggan'];
            $query = "SELECT * FROM keranjang where id_pelanggan = '$id_p'";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <form action="kelolaKeranjang.php" method="post">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID Keranjang</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">ID Layanan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <label hidden><?= $no++ ?></label>
                                    <td><?= $row['id_keranjang'] ?></td>

                                    <?php
                                    $id = $row['id_pelanggan'];
                                    $name_pelanggan = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'";
                                    $hasil = mysqli_query($conn, $name_pelanggan);
                                    $name = mysqli_fetch_assoc($hasil);
                                    ?>

                                    <td><?= $name['nama'] ?></td>
                                    <?php
                                    $id1 = $row['id_layanan'];
                                    $name_layanan = "SELECT * FROM layanan WHERE id_layanan = '$id1'";
                                    $c = mysqli_query($conn, $name_layanan);
                                    $n = mysqli_fetch_assoc($c);
                                    ?>
                                    <td><?= $n['nama_layanan'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="selectedRows[]" value="<?= $row['id_keranjang'] ?>">
                                            <input type="hidden" name="id_pelanggan" value="<?= $id ?>">
                                        </div>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="mb-3">
                        <label for="tgl" class="form-label">Masukan Tanggal Permintaan</label>
                        <input type="date" class="form-control" id="tgl" name="tgl">                        
                    </div>

                    <!-- Btn Add -->
                    <button type="submit" class="btn btn-primary w-25 mb-3" name="btnAdd">
                        <i class="fa-solid fa-square-plus rounded"></i> Add
                    </button>

                    <!-- Btn Hapus -->
                    <button type="submit" class="btn btn-danger w-25 mb-3" name="btnHapus"> Remove
                    </button>
                </form>
            </div>
            <script type="text/javascript" src="pelanggan.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>