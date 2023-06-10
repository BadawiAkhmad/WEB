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
    <link rel="stylesheet" href="Admin.css">
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
                    <a class="nav-link active" aria-current="page" href="list_pesanan.php"><i class="fa-solid fa-list"></i>List Pesanan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php"><i class="fa-solid fa-user"></i>Admin</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan.php"><i class="fa-solid fa-users"></i>Pelanggan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="metode_pembayaran.php"><i class="fa-solid fa-cash-register"></i>Metode Bayar</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="layanan.php"><i class="fa-solid fa-bell-concierge"></i>Layanan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="akun.php"><i class="fa-solid fa-clipboard-user"></i>Account</a>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>

        <!--Main Bar-->
        <div class="col-md-10 mt-3">
            <h3><i class="fa-solid fa-list"></i>List Pesanan</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database
            $query = "SELECT * FROM pesanan ";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <form action="kelolaPesanan.php" method="post">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID_Pesanan</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">Permintaan Layanan </th>
                                <th scope="col">Tanggal Pesananan</th>
                                <th scope="col">Tanggal Konfirmasi</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Status Pesanan</th>
                                <th scope="col">Bukti Pembayaran</th>
                                <th scope="col">Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <label hidden><?= $no++ ?></label>
                                    <td><?= $row['id_pesanan'] ?></td>

                                    <!-- Ambil Data Pelanggan Pemesan -->
                                    <?php
                                    $id_pelanggan = $row['id_pelanggan'];
                                    $query3 = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
                                    $h = mysqli_query($conn, $query3);
                                    $data_pelanggan = mysqli_fetch_assoc($h);

                                    if ($data_pelanggan) {
                                        $nama_pelanggan = $data_pelanggan['nama'];
                                    } else {
                                        $nama_pelanggan = 'Tidak Ditemukan';
                                    }
                                    ?>
                                    <td><?= $nama_pelanggan ?></td>


                                    <!-- Ambil Data Layanan Yang dipesan -->
                                    <?php
                                    $a = $row['id_keranjang'];
                                    $sql = "SELECT * FROM keranjang, layanan WHERE keranjang.id_layanan = layanan.id_layanan and keranjang.id_keranjang = '$a'";
                                    $h2 = mysqli_query($conn, $sql);
                                    $nama_lay = mysqli_fetch_assoc($h2);
                                    ?>


                                    <td><?= $nama_lay['nama_layanan'] ?></td>
                                    <td><?= $row['tanggal_permintaan'] ?></td>
                                    <td><?= $row['tanggal_konfirmasi'] ?></td>
                                    <td><?= $nama_lay['harga'] ?></td>
                                    <td><?= $row['status_konfirmasi'] ?></td>
                                    <td class="btnDownload text-center">
                                        <button type="button" class="btn btn-outline-success btn-sm " data-bs-toggle="modal" data-bs-target="#modalDownload<?= $no ?>">Download</button>
                                    </td>
                                    <td>
                                        <div class="form-check text-center ">
                                            <input class="form-check-input " type="checkbox" name="selectedRows[]" value="<?= $row['id_pesanan'] ?>">
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Download -->
                                <div class="modal fade" id="modalDownload<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalDwonloadLabel">Konfirmasi Download</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="kelolaPesanan.php" method="post">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="id_pesan" class="form-label">Anda Akan Mendownload Bukti Pesanan Ini </label>
                                                        <input type="hidden" name="id_pesan" value="<?= $row['id_pesanan'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="btnDownload">Download</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

            </div>
        </div>

    <?php endwhile; ?>
    </tbody>
    </table>

    <select class="form-select" aria-label="Default select example" name="detail">
        <option selected value="Pesanan Dibatalkan Oleh Admin">Pilih Detail Cancel Sebelum Membatalkan Pesanan</option>
        <option value="Pesanan Dibatalkan Admin Karena Jadwal Penuh">Pesanan dibatalkan karena jadwal penuh</option>
        <option value="Pesanan Dibatalkan Admin Karena Bukti Uang Pangkal Tidak Ada">Pesanan dibatalkan karena bukti uang pangkal tidak ada</option>
        <option value="Pesanan Dibatalkan Admin Karena Layanan Yang Dipilih Tidak Tersedia">Pesanan dibatalkan karena layanan yang dipilih tidak tersedia</option>
    </select>


    <!-- Btn Confirm -->
    <button type="submit" class="btn btn-primary w-25 mb-3 mt-3" name="btnKonfirmasi">
        <i class="fa-solid fa-square-plus rounded"></i> Konfirmasi
    </button>

    <!-- Btn Cancel -->
    <button type="submit" class="btn btn-danger w-25 mb-3 mt-3" name="btnCancel">
        <i class="fa-solid fa-square-minus"></i> Cancel
    </button>

    </form>

    </div>
    <script type="text/javascript" src="Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>