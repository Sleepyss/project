<?php
    include "config.php";

    if(isset($_POST["save_buku"])){
        $action = $_POST["action"];
        $kode_buku = $_POST["kode_buku"];
        $judul = $_POST["judul"];
        $penulis = $_POST["penulis"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];

        if(!empty($_FILES["image"]["name"])){
            $path = pathinfo($_FILES["image"]["name"]);
            $extension = $path["extension"];
            $filename = $kode_buku."-".rand(1,1000).".".$extension;
        }

        if($action == "insert"){
            $sql = "insert into buku values ('$kode_buku','$judul','$penulis','$harga','$stok','$filename')";
            move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
            mysqli_query($connect,$sql);
        }else if($action == "update"){
            if(!empty($_FILES["image"]["name"])){
                $path = pathinfo($_FILES["image"]["name"]);
                $extension = $path["extension"];
                $filename = $kode_buku."-".rand(1,1000).".".$extension;
                $sql = "select * from buku where kode_buku='$kode_buku'";
                $query = mysqli_query($connect,$sql);
                $hasil = mysqli_fetch_array($query);

                if(file_exists("image/".$hasil["image"])){
                    unlink("image/".$hasil["image"]);
                }

                move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
                $sql = "update buku set judul='$judul',penulis='$penulis',harga='$harga',stok='$stok',image='$filename' where kode_buku='$kode_buku'";
            }else{
                $sql = "update buku set judul='$judul',penulis='$penulis',harga='$harga',stok='$stok' where kode_buku='$kode_buku'";
            }
            mysqli_query($connect,$sql);
        }
        header("location:buku.php");
    }

    if(isset($_GET["hapus"])){
        $kode_buku = $_GET["kode_buku"];
        $sql = "select * from buku where kode_buku = '$kode_buku'";
        $query = mysqli_query($connect,$sql);
        $hasil = mysqli_fetch_array($query);
        if(file_exists("image/".$hasil["image"])){
            unlink("image/".$hasil["image"]);
        }
        $sql = "delete from buku where kode_buku = '$kode_buku'";
        mysqli_query($connect,$sql);
        header("location:buku.php");
    }
?>