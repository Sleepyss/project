<?php
    if(isset($_POST["save_customer"])){
        $aksi = $_POST["aksi"];
        $id_customer = $_POST["id_customer"];
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $kontak = $_POST["kontak"];
        $username1 = $_POST["username1"];
        $password1 = $_POST["password1"];
        
        include "config.php";

        if($aksi == "isi"){
            $sql = "insert into customer values ('$id_customer','$nama','$alamat','$kontak','$username1','$password1')";
            mysqli_query($connect, $sql);
        }else if($aksi == "perbarui"){
            $sql = "select * from customer where id_customer='$id_customer'";
            $query = mysqli_query($connect,$sql);
            $hasil = mysqli_fetch_array($query);
            $sql = "update customer set nama='$nama',alamat='$alamat',kontak='$kontak',username1='$username1',password1='$password1' where id_customer='$id_customer'";
            mysqli_query($connect, $sql);
        }
        header("location:customer.php");
    }

    if(isset($_GET["hapus"])){
        include "config.php";
        $id_customer = $_GET["id_customer"];
        $sql = "select * from customer where id_customer='$id_customer'";
        $query = mysqli_query($connect, $sql);
        $hasil = mysqli_fetch_array($query);
        $sql = "delete from customer where id_customer ='$id_customer'";

    }

    mysqli_query($connect, $sql);
    header("location:customer.php");
?>