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
        <title>Data Buku</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            Add = () => {
                document.getElementById('action').value = "insert";
                document.getElementById('kode_buku').value = "";
                document.getElementById('judul').value = "";
                document.getElementById('penulis').value = "";
                document.getElementById('harga').value = "";
                document.getElementById('stok').value = "";
            }

            Edit = (item) =>{
                document.getElementById('action').value = "update";
                document.getElementById('kode_buku').value = item.kode_buku;
                document.getElementById('judul').value = item.judul;
                document.getElementById('penulis').value = item.penulis;
                document.getElementById('harga').value = item.harga;
                document.getElementById('stok').value = item.stok;

            }
        </script>
    </head>
    <body>
        <?php
            $sql = "select * from buku";
            $query = mysqli_query($connect,$sql);
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Data Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Data Admin</a>
                </li>
                <li class="nav-item active">
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
                    <h4>Buku</h4>
                </div>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>kode_buku</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $buku): ?>
                            <tr>
                                <td><?php echo $buku["kode_buku"]; ?></td>
                                <td><?php echo $buku["judul"]; ?></td>
                                <td><?php echo $buku["penulis"]; ?></td>
                                <td><?php echo $buku["harga"]; ?></td>
                                <td><?php echo $buku["stok"]; ?></td>
                                <td>
                                    <img src="<?php echo 'image/'.$buku['image'];?>" alt="Foto Buku" width="200" />
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_buku" type="button" class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($buku);?>)'>Edit</button>
                                    <a href="proses_crud_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"]?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div>
                <button data-toggle="modal" data-target="#modal_buku" type="button" class="btn btn-sm btn-success" onclick="Add()">Tambah Data</button>
            </div>
        </div>

        <div class="modal fade" id="modal_buku">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="proses_crud_buku.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header bg-danger text-white">
                            <h4>Form Customer</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" id="action">
                            KODE_BUKU
                            <input type="text" name="kode_buku" id="kode_buku" class="form-control" required />
                            JUDUL
                            <input type="text" name="judul" id="judul" class="form-control" required />
                            PENULIS
                            <input type="text" name="penulis" id="penulis" class="form-control" required />
                            HARGA
                            <input type="text" name="harga" id="harga" class="form-control" required />
                            STOK
                            <input type="text" name="stok" id="stok" class="form-control" required />
                            IMAGE
                            <input type="file" name="image" id="image" class="form-control" >
                        </div> 
                        <div class="modal-footer">
                            <button type="submit" name="save_buku" class="btn btn-primary">
                                SAVE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>