<?php


use data\File;
use data\Users;
require_once('../../handler/data/File.php');
require_once('../../handler/data/Users.php');
require_once('../../db/Database.php');
$user = new Users();
$file = new File();

if(isset($_COOKIE['user'])){
    $userCookie = $_COOKIE['user'];
    $userData = json_decode($userCookie);
    if ($userData !== null && is_array($userData) && count($userData) > 0) {
        $id = $userData[0]->id;
        $fullName = $userData[0]->full_name;
        $email = $userData[0]->email;
        $phone = $userData[0]->phone_number;
        $pathPhoto = $userData[0]->photo_profile;
        $idPhoto = $userData[0]->id_photo_profile;
    }
}

if(isset($_POST['submit'])){
    if(!empty($_FILES['file']['name'])){
        echo "<script>console.log('masuk')</script>";
        $targetDirectory = "../../../assets/user/$id/";
        if(is_dir($targetDirectory) == false){
            mkdir($targetDirectory,0777,true);    
        }

        // DELETE OLD PROF PIC
        $files = glob($targetDirectory . "*");
        foreach($files as $f){
            if(is_file($f)) 
                unlink($f); 
        }


        $writeDirectory = "../../assets/user/$id/";
        $file_name =  $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_up_name = time().".".$extension;
        move_uploaded_file($tmp_name, $targetDirectory.$file_up_name);
        
        if($idPhoto == 1 && $id!=1){
            //INSERT FOR USERS
            $idPhoto = $file->Insert($file_name, $writeDirectory.$file_up_name, 'photo');
        }else if($idPhoto == 1 && $id==1){
            //UPDATE FOR ADMIN
            $file->Update($idPhoto, $file_name, $writeDirectory.$file_up_name, 'photo');
        }else{
            //UPDATE FOR USERS
            echo "<script>console.log('masuk',$id,$idPhoto)</script>";
            $file->Update($idPhoto, $file_name, $writeDirectory.$file_up_name, 'photo');
        }

        echo "<script>console.log('$file_name')</script>";
        echo "<script>console.log('$tmp_name')</script>";
        echo "<script>console.log('$file_up_name')</script>";
        echo "<script>console.log('$extension')</script>";
    }
    if(isset($_POST['fullName'])){
        $fullName = $_POST['fullName'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
    }

    echo "<script>console.log('$id, $fullName, $email, $phone')</script>";

    if(isset($_POST['password'])){
        $password = $_POST['password'];
        $user->UpdateWithPassword($id, $fullName, $email, $phone, $password, $idPhoto);
    }else{
        $user->UpdateUsers($id, $fullName, $email, $phone, $idPhoto);
    }

    $temp = $user->FindById($id);
    $ini = json_encode($temp);

    echo "<script>
                var date = new Date()
                date.setTime(date.getTime() + (24*60*60*1000));
                var expires = '; expires=' + date.toUTCString();
                document.cookie = 'user=$ini'+ expires + '; path=/';
                </script>";

    echo "<script>alert('Profil berhasil di update')</script>";
    // header('Location: ../../../app/views/profile/index.php');
    echo "<script>window.location.href='/?profile'</script>";
}

// if(isset($_POST['submit'])){
//     if(isset($_POST['fullName'])){
//         $fullName = $_POST['fullName'];
//     }
//     if(isset($_POST['email'])){
//         $email = $_POST['email'];
//     }
//     if(isset($_POST['phone'])){
//         $phone = $_POST['phone'];
//     }

//     echo "<script>console.log('$id, $fullName, $email, $phone')</script>";

//     if(isset($_POST['password'])){
//         $password = $_POST['password'];
//         $user->UpdateWithPassword($id, $fullName, $email, $phone, $password);
//     }else{
//         $user->UpdateUsers($id, $fullName, $email, $phone);
//     }

//     $temp = $user->FindById($id);
//     $ini = json_encode($temp);

//     echo "<script>
//               var date = new Date()
//               date.setTime(date.getTime() + (24*60*60*1000));
//               var expires = '; expires=' + date.toUTCString();
//               document.cookie = 'user=$ini'+ expires + '; path=/';
//                 </script>";

//     echo "<script>alert('Profil berhasil di update')</script>";
//     // header('Location: ../../../app/views/profile/index.php');
//     echo "<script>window.location.href='/?profile'</script>";
// }