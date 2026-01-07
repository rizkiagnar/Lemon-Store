<?php
session_start();
include 'db.php';
$error = '';
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($q) == 1) {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Daily Journal</title>
    <link rel="icon" href="image/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <style>
        #profile-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #profile-card:hover {
            transform: scale(1.02);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
</head>

<body class="primary">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle h1 display-4"></i>
                            <p>Welcome to Lemon Gadget Admin</p>
                            <hr />
                        </div>
                        <form action="" method="post">
                            <input type="text" name="user" class="form-control my-4 py-2 rounded-4"
                                placeholder="Username" />
                            <input type="password" name="pass" class="form-control my-4 py-2 rounded-4"
                                placeholder="Password" />
                            <div class="text-center my-3 d-grid">
                                <button class="btn btn-danger rounded-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <?php
    //set variable username dan password dummy
    $username = "admin";
    $password = "123456";

    //check apakah ada request dengan method POST yang dilakukan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //check apakah username dan password yang di POST sama dengan data dummy
        if ($_POST['user'] == $username AND $_POST['pass'] == $password) {
            echo '
          <div class="d-flex justify-content-center mt-4">
            <div class="p-4 rounded-5 shadow-sm bg-success-subtle text-success-emphasis text-center" style="min-width: 300px;">
              <div>user : ' . $_POST['user'] . '</div>
              <div>pass : ' . $_POST['pass'] . '</div>
              <div class="fw-bold mt-2">Username dan Password Benar</div>
            </div>
          </div>';
        } else {
            echo '
          <div class="d-flex justify-content-center mt-4">
              <div class="p-4 rounded-5 shadow-sm bg-danger-subtle text-danger-emphasis text-center" style="min-width: 300px;">
                <div>user : ' . $_POST['user'] . '</div>
                <div>pass : ' . $_POST['pass'] . '</div>
                <div class="fw-bold mt-2">Username dan Password Salah</div>
              </div>
          </div>';
        }
    }
    ;
    ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>
<?php

?>