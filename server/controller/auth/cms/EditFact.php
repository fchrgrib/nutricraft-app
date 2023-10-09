<?php


require_once "../../../../server/handler/data/File.php";
require_once "../../../../server/handler/data/Content.php";

use data\File;
use data\Content;


if (isset($_POST['submit'])){
    $file = new File();
    $content = new Content();
    $a = explode(";",$_POST['id_fact']);
    $id = $a[0];
    $get_content = $content->FindById($id)[0];

    $targetDirectory = "../../../../assets/content/";
    if (!empty($_FILES['file']['name'])){
        $fileCount = count($_FILES['file']['name']);
        if ($fileCount==2){
            for ($i = 0; $i < $fileCount; $i++) {
                $fileType = explode("/",$_FILES['file']['type'][$i]);
                if ($fileType[0]=="image"){
                    $file_name = $_FILES['file']['name'][$i];
                    $tmp_name = $_FILES['file']['tmp_name'][$i];
                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_up_name = time() . "." . $extension;
                    move_uploaded_file($tmp_name, $targetDirectory . $file_up_name);
                    $file->Update($get_content['id_photo'],$file_name,'../../assets/content/'.$file_up_name,'photo');
                }else{
                    $file_video = $_FILES['file']['name'][$i];
                    $tmp_video = $_FILES['file']['tmp_name'][$i];
                    $extension = pathinfo($file_video, PATHINFO_EXTENSION);
                    $file_up_video = time() . "." . $extension;
                    move_uploaded_file($tmp_video, $targetDirectory . $file_up_video);
                    $file->Update($get_content['id_file'],$file_video,'../../assets/content/'.$file_up_video,'video');
                }
            }
        }
    }

    if (isset($_POST['facttitle'])){
        $get_content['title'] = $_POST['facttitle'];
    }
    if (isset($_POST['facthighlight'])){
        $get_content['highlight'] = $_POST['facthighlight'];
    }
    if (isset($_POST['factdescription'])){
        $get_content['body'] = $_POST['factdescription'];
    }

    echo "<script>console.log('masukk')</script>";

    $content->Update($get_content['id'],$get_content['title'],$get_content['body'],$get_content['id_file'],$get_content['id_photo'],$get_content['highlight']);
    echo "<script>window.location.href='/?cms'</script>";
}