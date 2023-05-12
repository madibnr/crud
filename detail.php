<?php
session_start();
require_once 'koneksi.php';

if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}

if(isset($_POST['update']))
{
    $pengguna_id = $_POST['pengguna_id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['address'];
    $avatar = $_POST['avatar'];

    $query = "UPDATE users SET name='$name', role='$role', password='$password', email='$email', phone='$phone', address='$alamat', avatar='$avatar' 
                WHERE id='$pengguna_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Berhasil Edit Pengguna";
        header("Location: read.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Gagal Edit Pengguna";
        header("Location: read.php");
        exit(0);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Edit Pengguna</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Pengguna</h1>
            <div>
                <a href="read.php" class="btn btn-primary">Kembali</a>
            </div>
        </header>

            <?php 
            if(isset($_GET['id']))
            {
                $pengguna_id = mysqli_real_escape_string($conn, $_GET['id']);
                $query = "SELECT * FROM users WHERE id='$pengguna_id'";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    $pengguna = mysqli_fetch_array($query_run);
                    ?>
                    <form class="row g-3" method="post">
                        <input type="hidden" name="pengguna_id" value="<?= $pengguna['id'] ?>">

                        <div class="col-12">
                            <label for="name" class="form-label">Nama</label>
                            <p class="form-control">
                                <?= $pengguna['name'] ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <p class="form-control">
                                <?= $pengguna['role'] ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $pengguna['password'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <p class="form-control">
                                <?= $pengguna['email'] ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telp</label>
                            <p class="form-control">
                                <?= $pengguna['phone'] ?>
                            </p>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <p class="form-control">
                                <?= $pengguna['address'] ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Unggah Foto</label>
                            <p class="form-control">
                                <?= $pengguna['avatar'] ?>
                            </p>
                        </div>
                    </form>
                    <?php
                }
                else
                {
                    echo "<h4>Id tidak ditemukan</h4>";
                }
            }
            ?>
    </div>
</body>
</html>