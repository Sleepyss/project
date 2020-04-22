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
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Keranjang Pembelanjaan</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($_SESSION["cart"] as $cart): ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $cart["judul"]; ?></td>
                                    <td>Rp <?php echo $cart["harga"]; ?></td>
                                    <td><?php echo $cart["jumlah_beli"]; ?></td>
                                    <td>Rp <?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                                    <td>
                                        <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"]?>">
                                            <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++; endforeach; ?>
                        </tbody>
                        <tfoot>
                            <a href="proses_cart.php?checkout=true">
                                <button type="button" class="btn btn-success">
                                    Checkout
                                </button>
                            </a>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>