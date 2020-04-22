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
        <title>Data Customer</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            Tambah = () => {
                document.getElementById('aksi').value = "isi";
                document.getElementById('id_customer').value = "";
                document.getElementById('nama').value = "";
                document.getElementById('alamat').value = "";
                document.getElementById('kontak').value = "";
                document.getElementById('username1').value = "";
                document.getElementById('password1').value = "";
            }

            Edit = (item) => {
                document.getElementById('aksi').value = "perbarui";
                document.getElementById('id_customer').value = item.id_customer;
                document.getElementById('nama').value = item.nama;
                document.getElementById('alamat').value = item.alamat;
                document.getElementById('kontak').value = item.kontak;
                document.getElementById('username1').value = item.username1;
                document.getElementById('password1').value = item.password1;
            }
        </script>
    </head>
    <body>
        <?php
            $sql = "select * from customer";
            $query = mysqli_query($connect,$sql);
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="customer.php">Data Customer</a>
                </li>
                <li class="nav-item">
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
                    <h4>Customer</h4>
                </div>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>id_customer</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $customer): ?>
                            <tr>
                                <td><?php echo $customer["id_customer"]; ?></td>
                                <td><?php echo $customer["nama"]; ?></td>
                                <td><?php echo $customer["alamat"]; ?></td>
                                <td><?php echo $customer["kontak"]; ?></td>
                                <td><?php echo $customer["username1"]; ?></td>
                                <td><?php echo $customer["password1"]; ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_customer" type="button" class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($customer);?>)'>Edit</button>
                                    <a href="proses_crud_customer.php?hapus=true&id_customer=<?php echo $customer["id_customer"]?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div>
                    <button data-toggle="modal" data-target="#modal_customer" type="button" class="btn btn-sm btn-success" onclick="Tambah()">Tambah Data</button>
                </div>
            </div>

            <div class="modal fade" id="modal_customer">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="proses_crud_customer.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-danger text-white">
                                <h4>Form Customer</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="aksi" id="aksi">
                                ID_CUSTOMER
                                <input type="text" name="id_customer" id="id_customer" class="form-control" required />
                                NAMA
                                <input type="text" name="nama" id="nama" class="form-control" required />
                                ALAMAT
                                <input type="text" name="alamat" id="alamat" class="form-control" required />
                                KONTAK
                                <input type="text" name="kontak" id="kontak" class="form-control" required />
                                USERNAME
                                <input type="text" name="username1" id="username1" class="form-control" required />
                                PASSWORD
                                <input type="text" name="password1" id="password1" class="form-control" required />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="save_customer" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>