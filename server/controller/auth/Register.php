
<?php 

use data\Users;

require_once('../../handler/data/Users.php');
require_once('../../db/Database.php');

$user = new Users();

if($user->isEmailExists($_POST['email'])){
    echo "<script>alert('email sudah terdaftar')</script>";
    echo "<script>location.href='/?home'</script>";
    die();
}

if($user->isPhoneNumberExists($_POST['phoneNumber'])){
    echo "<script>alert('nomor telepon sudah terdaftar')</script>";
    echo "<script>location.href='/?home'</script>";
    die();
}

if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['email']) && isset($_POST['phoneNumber'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $user->Insert($username, $email, $phoneNumber, $password,"user");
    $id = $user->FindIdByEmail($email);
    mkdir("../../../assets/user/$id",0777,true);
    echo "<script>alert('registrasi berhasil')</script>";
    echo "<script>location.href='/?home'</script>";
}

      
?>