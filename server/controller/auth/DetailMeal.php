<?php

use data\Meal;
use data\Ingredients;
use data\Nutrition;
require_once "../../handler/data/Meal.php";
require_once('../../db/Database.php');
require_once(__DIR__.'/../../handler/data/Ingredients.php');
require_once(__DIR__.'/../../handler/data/Nutrition.php');

$meal = new Meal();
$ingredients = new Ingredients();
$nutrition = new Nutrition();
$data = json_decode(file_get_contents("php://input"),true);

if(isset($data)){
    $id = $data['id'];
    echo "<script>console.log($id)</script>";
    $result = array();
    $result[0] = $meal->FindById($id);
    $result[1] = $ingredients->FindByMeals($id);
    $result[2] = $nutrition->FindByMeals($id);
    
    echo json_encode($result);
}



?>