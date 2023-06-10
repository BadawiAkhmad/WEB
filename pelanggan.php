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
            <h3><i class="fa-solid fa-users"></i>Data Pengunjung</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database
            $query = "SELECT * FROM pelanggan ";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Akun</th>
                            <th scope="col">Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <label hidden><?= $no++ ?></label>
                                <td><?= $row['id_pelanggan'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['telepon'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['umur'] ?></td>
                                <td><?= $row['gender'] ?></td>
                                <td><?= $row['pekerjaan'] ?></td>
                                <td><?= $row['tanggal_lahir'] ?></td>
                                <td><?= $row['id_akun'] ?></td>

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
                                                <h1 class="modal-title fs-5" id="modalEditLabel">Edit Data Pelanggan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="editPelangganAdmin.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pelanggan" value="<?= $row['id_pelanggan'] ?>">

                                                    <div class="mb-3">
                                                        <label for="namaEdit" class="form-label">Nama Lengkap Pengunjung</label>
                                                        <input class="form-control" type="text" name="namaEdit" value="<?= $row['nama'] ?>" placeholder="Masukkan Nama Pengunjung Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="alamatEdit" class="form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="alamatEdit" name="alamatEdit" value="<?= $row['alamat'] ?>" placeholder="Masukkan Alamat Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="teleponEdit" class="form-label">Telepon</label>
                                                        <input class="form-control" type="tel" name="teleponEdit" value="<?= $row['telepon'] ?>" placeholder="Masukkan Nomer Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="emailEdit" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="emailEdit" name="emailEdit" value="<?= $row['email'] ?>" placeholder="Masukkan Email Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="umurEdit" class="form-label">Umur</label>
                                                        <input class="form-control" type="number" name="umurEdit" value="<?= $row['umur'] ?>" placeholder="Masukkan Umur Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jkEdit" class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select" aria-label="Default select example" name="jkEdit">
                                                            <option selected value="<?= $row['gender'] ?>"><?= $row['gender'] ?></option>
                                                            <?php if($row['gender'] == 'Laki-Laki'){
                                                                echo '<option value="Perempuan">Perempuan</option>';
                                                            }else{
                                                                echo '<option value="Laki-Laki">Laki-Laki</option>';
                                                            } 
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pekerjaanEdit" class="form-label">Pekerjaan</label>
                                                        <input class="form-control" type="text" name="pekerjaanEdit" value="<?= $row['pekerjaan'] ?>" placeholder="Masukkan Pekerjaan Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tglLahir" name="tglLahir" value="<?= $row['tanggal_lahir'] ?>" placeholder="Masukkan Tanggal Lahir Baru">
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
                                                <h1 class="modal-title fs-5" id="modalHapusLabel">Form Hapus Data Akun</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="hapusPelanggan.php" method="post">

                                                <input type="hidden" name="idHapus" id="idHapus" value="<?= $row['id_akun'] ?>">

                                                <div class="modal-body">

                                                    <h5 class='text-center'>Apakah anda yakin menghapus data ini?<br>
                                                        <span class='text-danger'><?= $row['id_pelanggan'] ?> - <?= $row['nama'] ?></span>
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
                    <h1 class="modal-title fs-5" id="modalAddLabel">Form Tambah Data Penggunna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addPelanggan.php" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Nomer Telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
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