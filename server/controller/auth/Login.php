<?php

use data\Users;

require_once('../../handler/data/Users.php');
require_once('../../db/Database.php');
$user = new Users();


if(isset($_POST['emailLog']) && isset($_POST['passLog'])){
    $email = $_POST['emailLog'];
    $password = $_POST['passLog'];
    echo "<script>console.log('$email, $password')</script>";
    $temp = $user->FindById($user->FindIdByEmail($email));
    $ini = json_encode($temp[0]);
    
    if($user->Login($email, $password)){
        $temp = $user->FindById($user->FindIdByEmail($email));
        echo "<script>
              var date = new Date()
              date.setTime(date.getTime() + (24*60*60*1000));
              var expires = '; expires=' + date.toUTCString();
              document.cookie = 'user=$ini'+ expires + '; path=/';
                </script>";

        echo "<script>alert('login berhasil')</script>";
        echo "<script>location.href='/?home'</script>";
    }else{
        if($user->isEmailExists($email)){
            echo "<script>alert('password salah')</script>";
            echo "<script>location.href='/?home'</script>";
        }else{
            echo "<script>alert('email tidak terdaftar')</script>";
            echo "<script>location.href='/?home'</script>";
        }
    }
}
