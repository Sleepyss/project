<?php 
    session_start();
    if(!isset($_SESSION["id_admin"])){
        header("location:login_admin.php");
    }
    include "config.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Data Admin</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            Plus = () => {
                document.getElementById('act').value = "plus";
                document.getElementById('id_admin').value = "";
                document.getElementById('nama').value = "";
                document.getElementById('kontak').value = "";
                document.getElementById('username2').value = "";
                document.getElementById('password2').value = "";
            }

            Edit = (item) => {
                document.getElementById('act').value = "update";
                document.getElementById('id_admin').value = item.id_admin;
                document.getElementById('nama').value = item.nama;
                document.getElementById('kontak').value = item.kontak;
                document.getElementById('username2').value = item.username2;
                document.getElementById('password2').value = item.password2;
            }
        </script>
    </head>
    <body>
        <?php
            $sql = "select * from admin";
            $query = mysqli_query($connect,$sql);
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Data Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Data Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buku.php">Data Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="proses_login_admin.php?logout=true">
                        <?php echo $_SESSION["nama"]; ?> | Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Main_page.php">Go back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_trans.php">Riwayat Transaksi</a>
                </li>
            </ul>            
        </nav>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Admin</h4>
                </div>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>id_admin</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $admin): ?>
                            <tr>
                                <td><?php echo $admin["id_admin"]; ?></td>
                                <td><?php echo $admin["nama"]; ?></td>
                                <td><?php echo $admin["kontak"]; ?></td>
                                <td><?php echo $admin["username2"]; ?></td>
                                <td><?php echo $admin["password2"]; ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($admin);?>)'>Edit</button>
                                    <a href="proses_crud_admin.php?hapus=true&id_admin=<?php echo $admin["id_admin"]?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div>
                    <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-success" onclick="Plus()">Tambah Data</button>
                </div>
            </div>

            <div class="modal fade" id="modal_admin">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="proses_crud_admin.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-danger text-white">
                                <h4>Form Admin</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="act" id="act">
                                ID_ADMIN
                                <input type="text" name="id_admin" id="id_admin" class="form-control" required />
                                NAMA
                                <input type="text" name="nama" id="nama" class="form-control" required />
                                KOTAK
                                <input type="text" name="kontak" id="kontak" class="form-control" required />
                                USERNAME
                                <input type="text" name="username2" id="username2" class="form-control" required />
                                PASSWORD
                                <input type="text" name="password2" id="password2" class="form-control" required />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="save_admin" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>