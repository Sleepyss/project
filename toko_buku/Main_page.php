<?php 
    session_start();
    if(!isset($_SESSION["id_customer"])){
        header("location:login_customer.php");
    }
    include "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Buku</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript">
            Purchase = (item) => { 
                document.getElementById('kode_buku').value = item.kode_buku;
                document.getElementById("judul").innerHTML = item.judul;
                document.getElementById("penulis").innerHTML ="penulis : " + item.penulis;
                document.getElementById("harga").innerHTML ="harga : " + item.harga;
                document.getElementById("stok").innerHTML ="stok : " + item.stok;
                document.getElementById("jumlah_beli").value = "1";
                document.getElementById("image").src = "image/" + item.image;
                document.getElementById("jumlah_beli").max = item.stok;
            }
        </script>
    </head>
    <body>

        <!-- Header Start -->
        <div class="jumbotron text-center header_style">
            <h1>Toko Buku</h1>
            <p>Semua Buku ada Disini !!!</p>
        </div>
        <!-- Header End -->

        <!-- Nav Start -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="proses_login_customer.php?logout=true">
                        <?php echo $_SESSION["nama"]; ?> | Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        Cart(<?php echo count($_SESSION['cart']); ?>)
                    </a>
                </li>
            </ul>            
        </nav>
        <!-- Nav End -->
        
        <div class="container">

            <!-- Untuk Pencarian Buku -->
            <?php 
                if(isset($_POST["cari"])){
                    $cari = $_POST["cari"];
                    $sql = "select * from buku where penulis like '%$cari%' or judul like '$cari'";
                }else{
                    $sql = "select * from buku";
                }
                $query = mysqli_query($connect, $sql);
            ?>

            <!-- Untuk Menampilkan List Buku -->
            <div class="row">
                <?php foreach ($query as $buku): ?>
                    <div class="col-sm-4">
                        <div class="card-body">
                            <img src="image/<?php echo $buku["image"];?>" width="150">
                            <h5 class="text-success"><?php echo $buku["judul"]; ?></h5>
                            <h6 class="text-secondary">Rp <?php echo $buku["harga"];?></h6>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-info" onclick='Purchase(<?php echo json_encode($buku); ?>)' data-toggle="modal" data-target="#modal_purchase">
                                Purchase
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Modal Card Start -->
            <div class="modal" id="modal_purchase">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="text-white">Purchase Buku</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Untuk Gambar -->
                                    <img id="image" style="width: 100%; height: auto;">
                                </div>
                                <div class="col-6">
                                    <!-- Untuk Deskripsi -->
                                    <h4 id="judul"></h4>
                                    <h4 id="penulis"></h4>
                                    <h4 id="harga"></h4>
                                    <h4 id="stok"></h4>

                                    <form action="proses_cart.php" method="post">
                                        <input type="hidden" name="kode_buku" id="kode_buku">
                                        Jumlah Beli
                                        <input type="number" name="jumlah_beli" id="jumlah_beli" class="form-control" min="1">
                                        <button type="submit" name="add_to_cart" class="btn btn-success">
                                            Tambahkan ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Card End -->

        </div>
    </body>
</html>