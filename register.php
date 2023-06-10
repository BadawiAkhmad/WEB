<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="register.css">

</head>

<body>


  <section class="h-100 h-custom" style="background-color: #8fc4b7;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card rounded-3 semi-translucent-card">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Form Registrasi</h3>

              <div class="scrollable-form">
                <form class="px-md-2" action="regis.php" method="post">

                  <!-- Name field -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required />
                  </div>

                  <div class="row">
                    <!-- Username-->
                    <div class="col-md-6 mb-4">
                      <div class="form-outline datepicker">
                        <label for="username" class="form-label">Username yang digunakan</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                      </div>
                    </div>

                  <div class="row pb-2 pb-md-0 mb-md-4">
                    <div class="col-md-6">
                      <!-- Password -->
                      <div class="form-outline">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                        <span class="password-toggle" onclick="togglePassword()"><i class="bi bi-eye"></i></span>
                      </div>
                    </div>
                  </div>

                  <div class="row  pb-2 pb-md-0 mb-md-4">
                    <div class="col-md-6">
                      <!-- Ulangi Password -->
                      <div class="form-outline">
                        <label class="form-label" for="password2">Ulangi Password Anda</label>
                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Ulangi Password Anda" required/>
                        <span class="password-toggle" onclick="togglePassword()"><i class="bi bi-eye"></i></span>
                      </div>
                    </div>
                  </div>

                
                  <!-- Address field -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input type="text-area" id="alamat" name="alamat" class="form-control" placeholder="Address" required />
                  </div>

                  <!-- Telephone number field -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="telepon">Nomer Telepon</label>
                    <input type="tel" id="telepon" name="telepon" class="form-control" placeholder="Telephone Number" required/>
                  </div>

                  <!-- Email field -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required />
                  </div>
                  <!-- End of new form fields -->

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg mb-1">Submit</button>
                  </div>

                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
