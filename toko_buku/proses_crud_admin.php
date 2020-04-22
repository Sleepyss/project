<?php
    include "config.php";

    if(isset($_POST["save_admin"])){
        $act = $_POST["act"];
        $id_admin = $_POST["id_admin"];
        $nama = $_POST["nama"];
        $kontak = $_POST["kontak"];
        $username2 = $_POST["username2"];
        $password2 = $_POST["password2"];

        if($act == "plus"){
            $sql = "insert into admin values ('$id_admin','$nama','$kontak','$username2','$password2')";
            mysqli_query($connect,$sql);
        }else if($act == "update"){
            $sql = "select * from admin where id_admin='$id_admin'";
            $query = mysqli_query($connect,$sql);
            $hasil = mysqli_fetch_array($query);
            $sql = "update admin set nama='$nama', kontak='$kontak', username2='$username2', password2='$password2' where id_admin='$id_admin'";
            mysqli_query($connect,$sql);
        }
        header("location:admin.php");
    }

    if(isset($_GET["hapus"])){
        $id_admin = $_GET["id_admin"];
        $sql = "select * from admin where id_admin='$id_admin'";
        $query = mysqli_query($connect, $sql);
        $hasil = mysqli_fetch_array($query);
        $sql = "delete from admin where id_admin = '$id_admin'";
    }

    mysqli_query($connect, $sql);
    header("location:admin.php");
?>