<!doctype html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Pelanggan.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="pelanggan_akun.css">

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
        <div class="col-md-10 mt-4">
            <h3><i class="fa-solid fa-clipboard-user"></i>Detail Pengguna</h3>
            <form action="addDetailPelanggan.php" method="post">
                <?php
                // Include file koneksi.php
                include 'koneksi.php';

                $username = $_SESSION['login_user'];

                // Query untuk mendapatkan data dari database
                $query = "SELECT * FROM pelanggan, akun WHERE akun.username = '$username' and pelanggan.id_akun = akun.id_akun";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result)
                ?>

                <div class="detail mt-4">
                    <input type="hidden" name="id_pelanggan" value="<?= $row['id_pelanggan'] ?>">
                    <div class="mb-3 row">
                        <label for="nama_akun" class="col-sm-2 col-form-label">Nama :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?= $row['nama'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row['alamat'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telepon" class="col-sm-2 col-form-label">Telepon :</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="telepon" name="telepon" value="<?= $row['telepon'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="umur" class="col-sm-2 col-form-label">Umur :</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="umur" name="umur" value="<?= $row['umur'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="gender" name="gender">
                                <option selected value="<?= $row['gender'] ?>"><?= $row['gender'] ?></option>
                                <?php if ($row['gender'] == 'Laki-Laki') {
                                    echo '<option value="Perempuan">Perempuan</option>';
                                } else {
                                    echo '<option value="Laki-Laki">Laki-Laki</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $row['pekerjaan'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl" class="col-sm-2 col-form-label">Tanggal Lahir :</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $row['tanggal_lahir'] ?>">
                        </div>
                    </div>
                </div>

                <!-- Btn Add -->
                <button type="submit" class="btn btn-primary mb-3 mt-3" name="btnSimpan">Simpan</button>
                <button type="reset" class="btn btn-danger mb-3 mt-3"> Buang </button>
        </div>
        </form>

    </div>
    </div>




    <script type="text/javascript" src="Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>