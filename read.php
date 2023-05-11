<?php 
require_once 'koneksi.php';

if (isset($_POST['delete'])) {
    $pengguna_id = $_POST['delete'];
    $query = "DELETE FROM users WHERE id='$pengguna_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        header('Location: read.php');
    } else {
        echo 'Failed to delete user.';
    }
}

if (isset($_POST['reset'])) {
    $query = "ALTER TABLE users AUTO_INCREMENT = 1";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        header('Location: read.php');
    } else {
        echo 'Failed to reset ID.';
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
    <title>Data Pengguna</title>
</head>
<body>
    
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="card">
                <h4>Data Pengguna
                    <a href="create.php" class="btn btn-primary float-end">Tambah Pengguna</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form method="post" style="display: none;">
                        <button type="hidden" name="reset" class="btn btn-secondary btn-sm">Reset ID</button>
                    </form>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Aksi</th>
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM users";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $counter = 1;
                                foreach ($query_run as $pengguna) {
                                    ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td>
                                            <a href="detail.php?id=<?= $pengguna['id']; ?>" class="btn btn-primary btn-sm">Detail</a>
                                            <a href="edit.php?id=<?= $pengguna['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form method="post" style="display: inline;">
                                                <button type="submit" name="delete" value="<?= $pengguna['id'];?>" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                        <td><img src="uploads/<?php echo $pengguna['avatar']; ?>" alt="Avatar" width="40"></td>
                                        <td><?= $pengguna['name'];?></td>
                                        <td><?= $pengguna['email'];?></td>
                                        <td><?= $pengguna['phone'];?></td>
                                        <td><?= $pengguna['role'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h5> No Record Found </h5>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>