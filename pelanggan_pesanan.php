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
            <h3><i class="fa-solid fa-bell-concierge"></i>List Pesanan</h3>

            <?php
            // Include file koneksi.php
            include 'koneksi.php';

            // Query untuk mendapatkan data dari database

            $username = $_SESSION['login_user'];
            $q1 = "SELECT * FROM pelanggan, akun where pelanggan.id_akun = akun.id_akun AND akun.username = '$username'";
            $r1 = mysqli_query($conn, $q1);
            $has1 = mysqli_fetch_assoc($r1);

            $id_p = $has1['id_pelanggan'];
            $query = "SELECT * FROM pesanan WHERE id_pelanggan = '$id_p'";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="table-container">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID_Pesanan</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Permintaan Layanan </th>
                            <th scope="col">Tanggal Pesanan</th>
                            <th scope="col">Tanggal Konfirmasi</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Status Pesanan</th>
                            <th scope="col">Upload Bukti Pembayaran</th>
                            <th scope="col">Status Pembayaran</th>
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
                                <td class="btnUploud text-center">
                                    <button type="button" class="btn btn-outline-success btn-sm " data-bs-toggle="modal" data-bs-target="#modalUploud<?= $no ?>">Uploud</button>
                                </td>
                                <td><?= $row['status_pembayaran'] ?></td>
                                <td>
                                    <a href="#" class="deleteBtn text-decoration-none">
                                        <i class='fa-solid fa-trash-can' data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>" data-toggle='tooltip' title='Delete'></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Upload -->
                            <div class="modal fade" id="modalUploud<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalUploudLabel">Silahkan Pilih Metode Pembayaran dan Gambar Bukti Pembayaran</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="uploudFile.php" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">

                                                <?php
                                                $q1 = "SELECT * FROM metode_pembayaran";
                                                $h1 = mysqli_query($conn, $q1);

                                                $m1 = array();

                                                // Loop melalui hasil query
                                                while ($row_m1 = mysqli_fetch_assoc($h1)) {
                                                    // Memeriksa apakah data sudah ada dalam array 
                                                    if (!in_array($row_m1['nama_metode'], $m1)) {
                                                        // Jika belum ada, masukkan ke dalam array
                                                        $m1[] = $row_m1['nama_metode'];
                                                    }
                                                }
                                                ?>
                                                <div class="metode mb-3">
                                                    <label for="metode<?= $no ?>" class="form-label">Metode Pembayaran</label>
                                                    <select class="form-select" id="metode<?= $no ?>" name="metode" aria-label="Default select example" required>
                                                        <option selected disabled>Pilih Metode Pembayaran</option>
                                                        <?php
                                                        foreach ($m1 as $n) : ?>
                                                            <option value="<?= $n ?>"><?= $n ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <?php
                                                ?>

                                                <div class="jalur mb-3">
                                                    <label for="jalur<?= $no ?>" class="form-label">Jalur Layanan</label>
                                                    <select class="form-select" id="jalur<?= $no ?>" name="jalur" aria-label="Default select example" required>
                                                        <option selected disabled>Pilih Jalur Pembayaran</option>
                                                    </select>
                                                </div>

                                                <script>
                                                    document.getElementById('metode<?= $no ?>').addEventListener('change', function() {
                                                        var metode = this.value;
                                                        var jalur = document.getElementById('jalur<?= $no ?>');

                                                        // Bersihkan opsi-opsi yang ada
                                                        jalur.innerHTML = '';

                                                        // Isi opsi-opsi sesuai dengan nilai namaEdit
                                                        if (metode == "M-Banking") {
                                                            jalur.innerHTML += '<option value="BRI">BRI</option>';
                                                            jalur.innerHTML += '<option value="BCA">BCA</option>';
                                                            jalur.innerHTML += '<option value="BNI">BNI</option>';
                                                            jalur.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                                        } else if (metode == "Transfer Bank") {
                                                            jalur.innerHTML += '<option value="BRI">BRI</option>';
                                                            jalur.innerHTML += '<option value="BCA">BCA</option>';
                                                            jalur.innerHTML += '<option value="BNI">BNI</option>';
                                                            jalur.innerHTML += '<option value="Mandiri">Mandiri</option>';
                                                        } else if (metode == "E-Wallet") {
                                                            jalur.innerHTML += '<option value="ShoopePay">ShoopePay</option>';
                                                            jalur.innerHTML += '<option value="Dana">Dana</option>';
                                                            jalur.innerHTML += '<option value="Gopay">Gopay</option>';
                                                        }
                                                    });
                                                </script>

                                                <div class="nomer-tujuan mb-3">
                                                    <label for="nomer<?= $no ?>" class="form-label">Nomer Tujuan</label>
                                                    <select class="form-select" id="nomer<?= $no ?>" name="no" aria-label="Default select example" required>
                                                        <option selected disabled>No Tujuan</option>
                                                    </select>
                                                </div>

                                                <?php
                                                $s1 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'Transfer Bank' and jalur_layanan = 'BRI'";
                                                $s2 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'Transfer Bank' and jalur_layanan = 'BNI'";
                                                $s3 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'Transfer Bank' and jalur_layanan = 'BCA'";
                                                $s4 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'Transfer Bank' and jalur_layanan = 'Mandiri'";
                                                $s5 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'M-Banking' and jalur_layanan = 'BRI'";
                                                $s6 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'M-Banking' and jalur_layanan = 'BNI'";
                                                $s7 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'M-Banking' and jalur_layanan = 'BCA'";
                                                $s8 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'M-Banking' and jalur_layanan = 'Mandiri'";
                                                $s9 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'E-Wallet' and jalur_layanan = 'ShoopePay'";
                                                $s10 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'E-Wallet' and jalur_layanan = 'Dana'";
                                                $s11 = "SELECT * FROM metode_pembayaran WHERE nama_metode = 'E-Wallet' and jalur_layanan = 'Gopay'";

                                                $z1 = mysqli_query($conn, $s1);
                                                $z2 = mysqli_query($conn, $s2);
                                                $z3 = mysqli_query($conn, $s3);
                                                $z4 = mysqli_query($conn, $s4);
                                                $z5 = mysqli_query($conn, $s5);
                                                $z6 = mysqli_query($conn, $s6);
                                                $z7 = mysqli_query($conn, $s7);
                                                $z8 = mysqli_query($conn, $s8);
                                                $z9 = mysqli_query($conn, $s9);
                                                $z10 = mysqli_query($conn, $s10);
                                                $z11 = mysqli_query($conn, $s11);
                                                ?>

                                                <script>
                                                    function updateNoOptions(metode, jalur, no) {
                                                        var noElement = document.getElementById('nomer' + no);
                                                        // Bersihkan opsi-opsi yang ada
                                                        noElement.innerHTML = '';

                                                        // Isi opsi-opsi sesuai dengan nilai metode dan jalur
                                                        if (metode === "Transfer Bank" && jalur === "BRI") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z1)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "Transfer Bank" && jalur === "BNI") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z2)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "Transfer Bank" && jalur === "BCA") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z3)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "Transfer Bank" && jalur === "Mandiri") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z4)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "M-Banking" && jalur === "BRI") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z5)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "M-Banking" && jalur === "BNI") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z6)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "M-Banking" && jalur === "BCA") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z7)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "M-Banking" && jalur === "Mandiri") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z8)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "E-Wallet" && jalur === "ShoopePay") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z9)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "E-Wallet" && jalur === "Dana") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z10)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        } else if (metode === "E-Wallet" && jalur === "Gopay") {
                                                            <?php while ($row_j = mysqli_fetch_assoc($z11)) : ?>
                                                                noElement.innerHTML += '<option value="<?= $row_j['no_tujuan'] ?>"><?= $row_j['no_tujuan'] ?></option>';
                                                            <?php endwhile; ?>
                                                        }
                                                    }

                                                    document.getElementById('metode<?= $no ?>').addEventListener('change', function() {
                                                        var metode = this.value;
                                                        var jalur = document.getElementById('jalur<?= $no ?>').value;
                                                        var no = <?= $no ?>;
                                                        updateNoOptions(metode, jalur, no);
                                                    });

                                                    document.getElementById('jalur<?= $no ?>').addEventListener('change', function() {
                                                        var metode = document.getElementById('metode<?= $no ?>').value;
                                                        var jalur = this.value;
                                                        var no = <?= $no ?>;
                                                        updateNoOptions(metode, jalur, no);
                                                    });
                                                </script>

                                                <div class="mb-3">
                                                    <input type="hidden" name="id_pesanan" value="<?= $row['id_pesanan'] ?>">
                                                    <div class="mb-3">
                                                        <label for="bukti<?= $no?>" class="form-label">Uploud Bukti Pembayaran </label>
                                                        <input class="form-control" type="file" name="file" id="bukti<?= $no?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary" name="btnUploud">Upload</button>
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
                                            <h1 class="modal-title fs-5" id="modalHapusLabel">Form Hapus Data Admin</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="batalPesan.php" method="post">

                                            <input type="hidden" name="idHapus" id="idHapus" value="<?= $row['id_pesanan'] ?>">
                                            <input type="hidden" name="idKeranjang" id="idKeranjang" value="<?= $row['id_keranjang'] ?>">
                                            <input type="hidden" name="status" id="status" value="<?= $row['status_konfirmasi'] ?>">
                                            <div class="modal-body">
                                                <h5 class='text-center'>Apakah anda yakin membatalkan pesanan ini?<br></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary" name="btnHapus">Batalkan</button>
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
    <script type="text/javascript" src="Admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>