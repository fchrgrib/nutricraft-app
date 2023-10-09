<?php

require_once "../../../../server/handler/data/File.php";


use data\File;

$test = array();


if(isset($_POST['submit'])) {
    $file = new File();

    $targetDirectory = "../../../../assets/content/";

    $writeDirectory = "../../../../assets/content/";





}
//if (!empty($_FILES['facts_file']['name'])){
//
////    $fileCount = count($_FILES['facts_file']['name']);
//    $test[] = $_FILES['facts_file'];
//
//    $j = json_encode($_FILES);
//    echo "<script>console.log('$j')</script>";
//
////        for ($i = 0; $i < $fileCount; $i++) {
////            $fileName = $_FILES['file']['name'][$i];
////            $fileTmpName = $_FILES['file']['tmp_name'][$i];
////            $fileType = $_FILES['file']['type'][$i];
////            $fileSize = $_FILES['file']['size'][$i];
////            $fileError = $_FILES['file']['error'][$i];
////
////            // You can process the uploaded file(s) here
////            // For example, move them to a specific directory
////            $uploadDir = 'your_upload_directory/';
////            $targetFilePath = $uploadDir . $fileName;
////
////            echo "<script>console.log('$fileName')</script>";
////        }
//}
//if (!empty($_FILES['fact_file']['name'])){
//
//    $test[] = $_FILES['fact_file'];
////    $fileCount = count($_FILES['fact_file']['name']);
//
//    $j = json_encode($_FILES);
//    echo "<script>console.log('$j')</script>";
//
////        for ($i = 0; $i < $fileCount; $i++) {
////            $fileName = $_FILES['file']['name'][$i];
////            $fileTmpName = $_FILES['file']['tmp_name'][$i];
////            $fileType = $_FILES['file']['type'][$i];
////            $fileSize = $_FILES['file']['size'][$i];
////            $fileError = $_FILES['file']['error'][$i];
////
////            // You can process the uploaded file(s) here
////            // For example, move them to a specific directory
////            $uploadDir = 'your_upload_directory/';
////            $targetFilePath = $uploadDir . $fileName;
////
////            echo "<script>console.log('$fileName')</script>";
////        }
//}
