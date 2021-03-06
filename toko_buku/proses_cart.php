<?php 
    session_start();
    include "config.php";

    // Add
    if(isset($_POST["add_to_cart"])){
        $kode_buku = $_POST["kode_buku"];
        $jumlah_beli = $_POST["jumlah_beli"];

        $sql = "select * from buku where kode_buku ='$kode_buku'";
        $query = mysqli_query($connect,$sql);
        $buku = mysqli_fetch_array($query);

        $item = [
            "kode_buku" => $buku["kode_buku"],
            "judul" => $buku["judul"],
            "image" => $buku["image"],
            "harga" => $buku["harga"],
            "jumlah_beli" => $jumlah_beli
        ];
        
        array_push($_SESSION['cart'], $item);

        header("location:cart.php");
    }

    // Delete
    if(isset($_GET["hapus"])){
        $kode_buku = $_GET["kode_buku"];

        $index = array_search(
            $kode_buku, array_column(
                $_SESSION["cart"], "kode_buku"
            )
        );

        array_splice($_SESSION["cart"], $index, 1);
    }

    // Checkout
    if(isset($_GET["checkout"])){
        $id_transaksi = "ID".rand(1,10000);
        $tgl = date("Y-m-d H:i:s");
        $id_customer = $_SESSION["id_customer"];

        $sql = "insert into transaksi values ('$id_transaksi','$tgl','$id_customer')";
        mysqli_query($connect, $sql);

        $sql2 = "update buku set stok = stok - $jumlah where kode_buku='$kode_buku'";
        mysqli_query($connect, $sql2);

        foreach ($_SESSION["cart"] as $cart){
            $kode_buku = $cart["kode_buku"];
            $jumlah = $cart["jumlah_beli"];
            $harga = $cart["harga"];

            $sql = "insert into detail_transaksi values ('$id_transaksi','$kode_buku','$jumlah','$harga_beli')";
            
            mysqli_query($connect, $sql);
        }
        $_SESSION["cart"] = array();
        header("location:transaksi.php");
    }
?>

