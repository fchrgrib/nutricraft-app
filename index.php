<?php
if(!session_id()) session_start();

require_once 'app/init.php';
$app = new App;

use data\File;
use data\Users;

require_once 'server/db/Database.php';
require_once 'server/handler/data/File.php';
require_once 'server/handler/data/Users.php';
$db = new Database;
$db->Connect();
//$file = new File;
//if($file->FindById(1) == null){
//  $file->Insert("defaultPhoto","assets/user/defaultPhoto.png","www.poto.com","png");
//}

// $user = new Users;
// if($user->Login("ramadhan",1323)){
//   echo "<script>console.log('login berhasil')</script>";
// }else{
//   echo "<script>console.log('login gagal')</script>";
// }


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NutriCraft</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

</html>
