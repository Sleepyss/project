<?php 
    session_start();

    include "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>

    </head>
    <body>

        <!-- Nav Start -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <a class="navbar-brand" href="#">
                <img src="" alt="Logo" style="width: 40px">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Main_page.php">Home</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="proses_login_customer.php?logout=true">
                        <?php echo $_SESSION["nama"]; ?> | Logout
                     </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cart.php">
                        Cart <?php echo count($_SESSION["cart"]); ?>
                    </a>
                </li>
            </ul>            
        </nav>
        <!-- Nav End -->
        
        <div class="container">
            <div class="card mt-3">
                <div class="card-header bg-dark">
                    <h4 class="text-white">Riwayat Pembelian</h4>
                </div>
                <div class="card-body">
                    <?php 
                        $sql = "select * from transaksi t inner join customer c on t.id_customer = c.id_customer where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
                        $query = mysqli_query($connect, $sql);
                    ?>
                    <ul class="list-group">
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
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; foreach ($query2 as $detail): ?>
                                            <tr>
                                                <td><?php echo $detail["judul"]; ?></td>
                                                <td><?php echo $detail["jumlah"]; ?></td>
                                                <td>Rp. <?php echo number_format($detail["harga"]); ?></td>
                                                <td>
                                                    Rp. <?php echo number_format($detail["harga"]*$detail["jumlah"]); ?>
                                                </td>
                                            </tr>
                                        <?php $total += ($detail["harga"] * $detail["jumlah"]); endforeach; ?>
                                    </tbody>
                                </table>

                                <h6 class="text-danger">Rp. <?php echo number_format($total); ?></h6>
                            </li>
                         <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </body>
</html>