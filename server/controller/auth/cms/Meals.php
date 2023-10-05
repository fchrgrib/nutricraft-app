<?php


use data\Meal;
require_once "../../../handler/data/Meal.php";
require_once('../../../db/Database.php');

$meal = new Meal();

$hasil = $meal->FindAll('created_at',0,1600);

echo json_encode($hasil);