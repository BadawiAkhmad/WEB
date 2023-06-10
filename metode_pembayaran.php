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
            <h3><i class="fa-solid fa-cash-register"></i>Metode Bayar</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';
            // Query untuk mendapatkan data dari database
            $query = "SELECT * FROM metode_pembayaran ";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID_Metode</th>
                            <th scope="col">Nama Metode</th>
                            <th scope="col">Jalur</th>
                            <th scope="col">Nomer Tujuan</th>
                            <th scope="col">Atas Nama</th>
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
                                <td><?= $row['id_metode'] ?></td>
                                <td><?= $row['nama_metode'] ?></td>
                                <td><?= $row['jalur_layanan'] ?></td>
                                <td><?= $row['no_tujuan'] ?></td>
                                <?php
                                $id = $row['id_admin'];
                                $admin = "SELECT * FROM admin WHERE id_admin = $id";
                                $hasil = mysqli_query($conn, $admin);
                                $n = mysqli_fetch_assoc($hasil);
                                ?>

                                <td><?= $n['nama_admin']; ?></td>
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
                                                <h1 class="modal-title fs-5" id="modalEditLabel">Edit Metode Pembayaran</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="editMetode.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_metode" value="<?= $row['id_metode'] ?>">

                                                    <div class="mb-3">
                                                        <label for="metodeEdit" class="form-label">Nama Metode</label>
                                                        <select class="form-select" aria-label="Default select example" name="metodeEdit" id="metodeEdit">
                                                            <option selected value="<?= $row['nama_metode'] ?>">Pilih Nama Metode Baru</option>
                                                            <option value="M-Banking">M-Banking</option>
                                                            <option value="Transfer Bank">Transfer Bank</option>
                                                            <option value="E-Wallet">E-Wallet</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jalurEdit" class="form-label">Jalur Layanan</label>
                                                        <select class="form-select" aria-label="Default select example" name="jalurEdit" id="jalurEdit">
                                                            <option selected value="<?= $row['jalur_layanan'] ?>">Pilih Jalur Baru</option>
                                                        </select>
                                                    </div>
                                                    <script>
                                                        document.getElementById('metodeEdit').addEventListener('change', function() {
                                                            var metodeEdit = this.value;
                                                            var jalurEdit = document.getElementById('jalurEdit');

                                                            // Bersihkan opsi-opsi yang ada
                                                            jalurEdit.innerHTML = '';

                                                            // Isi opsi-opsi sesuai dengan nilai namaEdit
                                                            if (metodeEdit == "M-Banking") {
                                                                jalurEdit.innerHTML += '<option value="BRI">BRI</option>';
                                                                jalurEdit.innerHTML += '<option value="BCA">BCA</option>';
                                                                jalurEdit.innerHTML += '<option value="BNI">BNI</option>';
                                                                jalurEdit.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                                            } else if (metodeEdit == "Transfer Bank") {
                                                                jalurEdit.innerHTML += '<option value="BRI">BRI</option>';
                                                                jalurEdit.innerHTML += '<option value="BCA">BCA</option>';
                                                                jalurEdit.innerHTML += '<option value="BNI">BNI</option>';
                                                                jalurEdit.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                                            } else if (metodeEdit == "E-Wallet") {
                                                                jalurEdit.innerHTML += '<option value="ShoopePay">ShoopePay</option>';
                                                                jalurEdit.innerHTML += '<option value="Dana">Dana</option>';
                                                                jalurEdit.innerHTML += '<option value="Gopay">Gopay</option>';
                                                            }
                                                        });
                                                    </script>
                                                    <div class="mb-3">
                                                        <label for="noEdit" class="form-label">Nomer Tujuan</label>
                                                        <input type="number" class="form-control" id="noEdit" name="noEdit" value="<?= $row['no_tujuan'] ?>" placeholder="Masukkan Nomer Baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminEdit" class="form-label">Admin Pemegang</label>
                                                        <select class="form-select" aria-label="Default select example" name="adminEdit" id="adminEdit">
                                                            <option selected value="<?= $row['id_admin'] ?>">Pilih Admin Pemegang Baru</option>
                                                            <?php
                                                            $query1 = "SELECT * FROM admin";
                                                            $admin1 = mysqli_query($conn, $query1);
                                                            ?>

                                                            <?php
                                                            $a = 1;
                                                            while ($nama = mysqli_fetch_assoc($admin1)) :
                                                            ?>
                                                                <option value="<?= $nama['id_admin'] ?>"><?= $nama['nama_admin'] ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
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
                                            <form action="hapusMetode.php" method="post">

                                                <input type="hidden" name="idHapus" id="idHapus" value="<?= $row['id_metode'] ?>">

                                                <div class="modal-body">

                                                    <h5 class='text-center'>Apakah anda yakin menghapus data ini?<br>
                                                        <span class='text-danger'><?= $row['id_metode'] ?> - <?= $row['no_tujuan'] ?></span>
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
                    <h1 class="modal-title fs-5" id="modalAddLabel">Form Tambah Metode</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addMetode.php" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="namaAdd" class="form-label">Nama Metode</label>
                            <select class="form-select" aria-label="Default select example" name="namaAdd" id="namaAdd">
                                <option selected disabled>Pilih Nama Metode</option>
                                <option value="M-Banking">M-Banking</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jalurAdd" class="form-label">Jalur Layanan</label>
                            <select class="form-select" aria-label="Default select example" name="jalurAdd" id="jalurAdd">
                                <option selected disabled>Pilih Jalur</option>
                            </select>
                        </div>
                        <script>
                            document.getElementById('namaAdd').addEventListener('change', function() {
                                var namaAdd = this.value;
                                var jalurAdd = document.getElementById('jalurAdd');

                                // Bersihkan opsi-opsi yang ada
                                jalurAdd.innerHTML = '';

                                // Isi opsi-opsi sesuai dengan nilai namaEdit
                                if (namaAdd == "M-Banking") {
                                    jalurAdd.innerHTML += '<option value="BRI">BRI</option>';
                                    jalurAdd.innerHTML += '<option value="BCA">BCA</option>';
                                    jalurAdd.innerHTML += '<option value="BNI">BNI</option>';
                                    jalurAdd.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                } else if (namaAdd == "Transfer Bank") {
                                    jalurAdd.innerHTML += '<option value="BRI">BRI</option>';
                                    jalurAdd.innerHTML += '<option value="BCA">BCA</option>';
                                    jalurAdd.innerHTML += '<option value="BNI">BNI</option>';
                                    jalurAdd.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                } else if (namaAdd == "E-Wallet") {
                                    jalurAdd.innerHTML += '<option value="ShoopePay">ShoopePay</option>';
                                    jalurAdd.innerHTML += '<option value="Dana">Dana</option>';
                                    jalurAdd.innerHTML += '<option value="Gopay">Gopay</option>';
                                }
                            });
                        </script>
                        <div class="mb-3">
                            <label for="nomor_tujuan" class="form-label">Nomer Tujuan</label>
                            <input type="number" class="form-control" id="nomor_tujuan" name="nomor_tujuan" placeholder="Masukkan Nomor Tujuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminAdd" class="form-label">Admin Pemegang</label>
                            <select class="form-select" aria-label="Default select example" name="adminAdd" id="adminAdd">
                                <option selected disabled>Pilih Admin Pemegang</option>
                                <?php
                                $query1 = "SELECT * FROM admin";
                                $admin1 = mysqli_query($conn, $query1);
                                ?>

                                <?php
                                $a = 1;
                                while ($nama = mysqli_fetch_assoc($admin1)) :
                                ?>
                                    <option value="<?= $nama['id_admin'] ?>"><?= $nama['nama_admin'] ?></option>
                                <?php endwhile; ?>
                            </select>
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