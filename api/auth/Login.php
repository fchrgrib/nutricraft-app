<?php

use data\Users;

require_once ('../../server/handler/data/Users.php');
require_once ('../../server/db/Database.php');
$user = new Users();


if(isset($_POST['emailLog']) && isset($_POST['passLog'])){
    $email = $_POST['emailLog'];
    $password = $_POST['passLog'];
    echo "<script>console.log('$email, $password')</script>";
    
    if($user->Login($email, $password)){
        echo "<script>alert('login berhasil')</script>";
        echo "<script>location.href='../../index.php'</script>";
    }else{
        if($user->isEmailExists($email)){
            echo "<script>alert('password salah')</script>";
            echo "<script>location.href='../../app/views/login/index.php'</script>";
        }else{
            echo "<script>alert('email tidak terdaftar')</script>";
            echo "<script>location.href='../../app/views/login/index.php'</script>";
        }
    }
}
