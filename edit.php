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
                    <form class="row g-3" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pengguna_id" value="<?= $pengguna['id'] ?>">

                        <div class="col-12">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" value="<?= $pengguna['name'] ?>" id="name" name="name" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="admin" <?php if ($pengguna['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="staff" <?php if ($pengguna['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" value="<?= $pengguna['password'] ?>">
                                <button class="btn btn-outline-secondary" type="button" id="showPassword">Show</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $pengguna['email'] ?>" placeholder="name@examples.com">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telp</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="<?= $pengguna['phone'] ?>" placeholder="08xxxx">
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $pengguna['address'] ?>" placeholder="Masukkan Alamat Lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ganti Foto</label>
                            <input class="form-control" type="file" id="avatar" name="avatar" value="<?= isset($pengguna['avatar']) ? $pengguna['avatar'] : '' ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" id="update" name="update" class="btn btn-primary">Simpan</button>
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
    <script>
        document.getElementById("showPassword").addEventListener("click", function () {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                this.textContent = "Show";
            }
        });
    </script>

</body>
</html>