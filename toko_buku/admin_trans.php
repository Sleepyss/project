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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Riwayat Transaksi</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
    </head>
    <body>

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
            <div class="card md-3">
                <div class="card-header bg-dark">
                    <h4 class="text-white">Riwayat Pembelian Customer</h4>
                </div>
                <div class="card-body">
                    <?php 
                        $sql = "select * from transaksi t inner join customer c on t.id_customer = c.id_customer order by t.tgl desc"; 
                        $query = mysqli_query($connect, $sql);
                    ?>
                    <li class="list-group">
                        <?php foreach($query as $transaksi): ?>
                            <li class="list-group-item mb-4">
                                <h6>ID Transaki: <?php echo $transaksi["id_transaksi"]; ?></h6>
                                <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                                <h6>Tgl.Transaksi: <?php echo $transaksi["tgl"]; ?></h6>  
                                <h6>List Barang:</h6>
                                <?php 
                                    $sql2 = "select * from detail_transaksi d inner join buku b on d.kode_buku = b.kode_buku where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                                    $query2 = mysqli_query($connect, $sql2);
                                ?>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; foreach ($query2 as $detail): ?>
                                            <tr>
                                                <td><?php echo $detail["judul"]; ?></td>
                                                <td><?php echo $detail["jumlah"]; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>   
                            </li>
                        <?php endforeach; ?>
                    </li>
                </div>
            </div>
        </div>
    </body>
</html>
