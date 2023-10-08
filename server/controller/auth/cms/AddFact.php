<?php

require_once "../../../../server/handler/data/File.php";


use data\File;



if(isset($_POST['submit'])) {
    $file = new File();

    $targetDirectory = "../../../../assets/content/";

    $writeDirectory = "../../../../assets/content/";

    if (!empty($_FILES['file']['name'])) {

        $t = $_FILES['file']['name'];
        echo "<script>console.log('$t')</script>";
//        $file_name = $_FILES['file']['name'];
//        $tmp_name = $_FILES['file']['tmp_name'];
//        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
//        $file_up_name = time() . "." . $extension;
//        move_uploaded_file($tmp_name, $targetDirectory . $file_up_name);
//
//        $id_file_photo = $file->Insert($file_name,'../../assets/content/'.$file_up_name,'photo');
    }

    if (!empty($_FILES['videofile']['name'])) {
        if (!empty($_FILES['videofile'])){
            $t = $_FILES['videofile']['name'];

            echo "<script>console.log('$t')</script>";
        }

//        $file_name = $_FILES['file']['name'];
//        $tmp_name = $_FILES['file']['tmp_name'];
//        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
//        $file_up_name = time() . "." . $extension;
//        move_uploaded_file($tmp_name, $targetDirectory . $file_up_name);
//
//        $id_file_photo = $file->Insert($file_name,'../../assets/content/'.$file_up_name,'photo');
    }



//    echo "<script>window.location.href='/?cms'</script>";


}
