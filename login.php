<?php
session_start();
$error = '';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect('localhost', 'root', '', 'pemesanan');

    $query = "SELECT * FROM akun WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['login_user'] = $username;

      if ($row['access'] == 1) {
        $_SESSION['access'] = true;
        header("location: list_pesanan.php");
      } else {
        header("location: pelanggan_layanan.php");
      }
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="css/style2.css">
</head>

<body class="img js-fullheight" style="background-image: url(images/anime.jpg);">
  </style>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h1 class="heading-section">Welcome</h1>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h3 class="mb-4 text-center">Have an account?</h3>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="signin-form">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                  <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control submit btn-primary submit px-3" name="submit">Sign In</button>
                </div>
              </form>
              <p class="w-100 text-center">&mdash; OR &mdash;</p>
              <a href="register.php"><button type="submit" class="form-control register-btn btn-primary px-2" name="submit">Sign Up</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

  <?php if (!empty($error) || (isset($_POST['submit']) && mysqli_num_rows($result) != 1)) { ?>
    <script>
      window.onload = function() {
        var errorMessage = "<?php echo !empty($error) ? $error : 'Username atau password salah.'; ?>";
        alert(errorMessage);
      };
    </script>
  <?php } ?>
</body>

</html>