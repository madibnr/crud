<?php
session_start();
require_once 'koneksi.php';

$err        = "";
$username   = "";

if(isset($_SESSION['session_username'])){
    header("location:read.php");
    exit();
}

if(isset($_POST['login'])){
    $username   = $_POST['name'];
    $password   = $_POST['password'];

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0){
            $err .= "<li>Username <b>$username</b> tidak tersedia atau password yang dimasukkan tidak sesuai.</li>";
        } else {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = $password;
            header("location:read.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if($err){ ?>
                            <div class="alert alert-danger">
                                <ul><?php echo $err ?></ul>
                            </div>
                        <?php } ?>
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan username" value="<?php echo $username; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
