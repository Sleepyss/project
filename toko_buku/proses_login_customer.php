<?php 
    session_start();

    include "config.php";

    $username1 = $_POST["username1"];
    $password1 = $_POST["password1"];

    if(isset($_POST["login_customer"])){
        $sql = "select * from customer where username1 = '$username1' and password1 = '$password1'";
        $query = mysqli_query($connect, $sql);
        $jumlah = mysqli_num_rows($query);

        if($jumlah > 0){
            $customer = mysqli_fetch_array($query);
            $_SESSION["id_customer"] = $customer["id_customer"];
            $_SESSION["nama"] = $customer["nama"];
            $_SESSION["cart"] = array();

            header("location:Main_page.php");
        }else{
            header("location:login_customer.php");
        }
    }

    if(isset($_GET["logout"])){
        session_destroy();
        header("location:login_customer.php");
    }
?>