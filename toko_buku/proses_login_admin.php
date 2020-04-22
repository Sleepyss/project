<?php 
    session_start();
    // session start() digunakan sebagai tanda kalau kita akan menggunakan session pada halaman ini
    // session start() harus diletakkan pada baris pertama.

    include "config.php";

    // tampung data username dan password nya
    $username2 = $_POST["username2"];
    $password2 = $_POST["password2"];

    if(isset($_POST["login_admin"])){
        $sql = "select * from admin where username2 = '$username2' and password2 = '$password2'";
        // eksekusi query
        $query = mysqli_query($connect, $sql);
        $jumlah = mysqli_num_rows($query);
        // mysqli_num_rows digunakan untuk menghitung jumlah data hasil dari query

        if($jumlah > 0){
            // jika jumlahnya lebih dari nol, artinya terdapat data admin yang sesuai dengan username dan password diinputkan
            // ini blok kode jika login berhasil 
            // kita ubah hasil query ke array
            $admin = mysqli_fetch_array($query);

            // membuat session
            $_SESSION["id_admin"] = $admin["id_admin"];
            $_SESSION["nama"] = $admin["nama"];

            header("location:buku.php");
        }else{
            //jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan username dan password yang diinputkan
            // ini blok kode jika loginnya gagal / salah
            header("location:login_admin.php");
        }
    }

    if(isset($_GET["logout"])){
        // proses logout

        session_destroy();
        // menghapus data session yang telah dibuat
        header("location:login_admin.php");
    }
?>