
<?php 

use data\File;
use data\Users;

require_once('../../handler/data/Users.php');
require_once('../../handler/data/File.php');
require_once('../../db/Database.php');

$data = json_decode(file_get_contents("php://input"),true);
$user = new Users();
$file = new File();

if(isset($data['email'])){
    if($user->isEmailExists($data['email'])){
        echo json_encode(array('status'=>'ERROR','message' => 'Email sudah terdaftar'));
    }else{
        echo json_encode(array('status'=>'OK','message' => 'Email tersedia'));
    }
}

if(isset($data['phoneNumber'])){
    if($user->isPhoneNumberExists($data['phoneNumber'])){
        echo json_encode(array('status'=>'ERROR','message' => 'Nomer telepon sudah terdaftar'));
    }else{
        echo json_encode(array('status'=>'OK','message' => 'Nomor telepon tersedia'));
    }
}


if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['email']) && isset($_POST['phoneNumber'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $user->Insert($username, $email, $phoneNumber, $password, "user");
    $id = $user->FindIdByEmail($email);
    if(is_dir("../../../assets/user/$id" == false)){
        echo "<script>('create folder')</script>";
        mkdir("../../../assets/user/$id",0777,true);    
    }
    //create default photo profile
    // $file->Insert("default.png", "../../assets/user/default/default.png", "photo");

    echo "<script>alert('registrasi berhasil')</script>";
    echo "<script>location.href='/?home'</script>";
}

      
?>