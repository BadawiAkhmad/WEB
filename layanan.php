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
            <h3><i class="fa-solid fa-bell-concierge"></i>Layanan</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database
            $query = "SELECT * FROM layanan ";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID_Layanan</th>
                            <th scope="col">Nama Layanan</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <label hidden><?= $no++ ?></label>
                                <td><?= $row['id_layanan'] ?></td>
                                <td><?= $row['nama_layanan'] ?></td>
                                <td><?= $row['deskripsi'] ?></td>
                                <td><?= $row['harga'] ?></td>
                                <td>
                                    <a href="#" class="editBtn text-decoration-none">
                                        <i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $no ?>" data-toggle="tooltip" title="Edit"></i>
                                    </a>
                                    <a href="#" class="deleteBtn text-decoration-none">
                                        <i class='fa-solid fa-trash-can' data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>" data-toggle='tooltip' title='Delete'></i>
                                    </a>
                                </td>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditLabel">Edit Layanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="editLayanan.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_layanan" value="<?= $row['id_layanan'] ?>">

                                                    <div class="mb-3">
                                                        <label for="namaEdit" class="form-label">Nama Layanan</label>
                                                        <input class="form-control" type="text" name="namaEdit" value="<?= $row['nama_layanan'] ?>" placeholder="Masukkan Nama Layanan Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsiEdit" class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" id="deskripsiEdit" name="deskripsiEdit" value="<?= $row['deskripsi'] ?>" placeholder="Masukkan Deskripsi Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hargaEdit" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="hargaEdit" name="hargaEdit" value="<?= $row['harga'] ?>" placeholder="Masukkan Harga Baru">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="btnEdit">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalHapusLabel">Form Hapus Layanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="hapusLayanan.php" method="post">

                                                <input type="hidden" name="idHapus" id="idHapus" value="<?= $row['id_layanan'] ?>">

                                                <div class="modal-body">

                                                    <h5 class='text-center'>Apakah anda yakin menghapus data ini?<br>
                                                        <span class='text-danger'><?= $row['id_layanan'] ?> - <?= $row['nama_layanan'] ?></span>
                                                    </h5>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="btnHapus">Delete</button>
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


    </div>
    <!-- Btn Add -->
    <button type="button" class="btn btn-primary w-25 mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <i class="fa-solid fa-square-plus rounded"></i> Add
    </button>

    <!-- Modal Add -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddLabel">Form Tambah Layanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addLayanan.php" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Layanan" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btnSave">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>




    <script type="text/javascript" src="Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>