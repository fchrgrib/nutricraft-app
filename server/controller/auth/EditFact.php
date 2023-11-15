<?php

use  data\Content ;
require_once "../../handler/data/Content.php";
require_once('../../db/Database.php');

$fact = new Content();
$data = json_decode(file_get_contents("php://input"),true);

if(isset($data)){
    $id = $data['id'];
    echo "<script>console.log($id)</script>";
    $result = $fact -> FindById($id);
    
    echo json_encode($result);
}





?>