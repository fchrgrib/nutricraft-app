<?php

require_once "../../../../server/handler/data/File.php";
require_once "../../../../server/handler/data/Content.php";

use data\File;
use data\Content;

$test = array();


if(isset($_POST['submit'])) {
    $file = new File();
    $content = new Content();

    $targetDirectory = "../../../../assets/content/";

    $writeDirectory = "../../../../assets/content/";

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
                    move_uploaded_file($tmp_name, $targetDirectory . $file_name);
                    $id_photo = $file->Insert($file_name,'../../assets/content/'.$file_up_name,'photo');
                    $t = json_encode($_FILES);
                    echo "<script>console.log('$file_name')</script>";
                }else{
                    $file_video = $_FILES['file']['name'][$i];
                    $tmp_video = $_FILES['file']['tmp_name'][$i];
                    $extension = pathinfo($file_video, PATHINFO_EXTENSION);
                    $file_up_video = time() . "." . $extension;
                    move_uploaded_file($tmp_video, $targetDirectory . $file_video);
                    $id_video = $file->Insert($file_video,'../../assets/content/'.$file_up_video,'video');
                    echo "<script>console.log('$file_video')</script>";
                }
            }
        }
    }

    if (isset($_POST['facttitle'])){
        $title = $_POST['facttitle'];
    }
    if (isset($_POST['facthighlight'])){
        $highlight = $_POST['facthighlight'];
    }
    if (isset($_POST['factdescription'])){
        $description = $_POST['factdescription'];
    }

    $content->Insert($title,$description,$id_video,$id_photo,$highlight);
//    echo "<script>window.location.href='/?cms'</script>";
}

