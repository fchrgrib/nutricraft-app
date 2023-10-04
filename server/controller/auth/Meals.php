<?php

use data\Meal;
require_once "../../handler/data/Meal.php";
require_once('../../db/Database.php');

$meal = new Meal();
$data = json_decode(file_get_contents("php://input"),true);

if(isset($data)){
    $type = $data['typeMeals'];
    $kiri = $data['lowRange'];
    $kanan = $data['highRange'];
    $sort = $data['sort'];

    echo "<script>console.log($type, $kiri, $kanan, $sort)</script>";

    if($type == "All"){
        $result = $meal->FindAll($sort, $kiri, $kanan);
    }else{
        $result = $meal->FindByType($type, $sort, $kiri, $kanan);
    }
    
    echo json_encode($result);
}





?>