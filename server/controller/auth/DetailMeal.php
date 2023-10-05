<?php

use data\Meal;
require_once "../../handler/data/Meal.php";
require_once('../../db/Database.php');

$meal = new Meal();
$data = json_decode(file_get_contents("php://input"),true);

if(isset($data)){
    $id = $data['id'];
    echo "<script>console.log($id)</script>";
    
    $result = $meal->FindById($id);
    
    echo json_encode($result);
}



?>