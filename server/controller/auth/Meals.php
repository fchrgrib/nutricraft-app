<?php

use data\Meal;
require_once "../../handler/data/Meal.php";
require_once('../../db/Database.php');

$meal = new Meal();
// $data = json_decode(file_get_contents("php://input"),true);

// if(isset($_GET)){
$type = $_GET['typeMeals'];
$kiri = $_GET['lowRange'];
$kanan = $_GET['highRange'];
$sort = $_GET['sort'];
$page = $_GET['page'];
$show = $_GET['show'];


echo "<script>console.log($type, $kiri, $kanan, $sort)</script>";

if(isset($show)){
    if($type == "All"){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $result = $meal->FindAllSearchPaging($search, $sort, $kiri, $kanan, $page);
        }else{
            $result = $meal->FindAllPaging($sort, $kiri, $kanan, $page);
    
        }
    }else{
        if(isset($_GET['search'])){
            echo "<script>console.log('masuk')</script>";
            $search = $_GET['search'];
            $result = $meal->FindByTitleSearchPaging($search, $type, $sort, $kiri, $kanan, $page);
        }else{
            $result = $meal->FindByTypePaging($type, $sort, $kiri, $kanan, $page);
        }
    }
    echo json_encode($result);
}



if(isset($_GET['pageNumber'])){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $result = $meal->FindAllSearch($search, $sort, $kiri, $kanan);
    }else{
        $result = $meal->FindAll($sort, $kiri, $kanan);
    }
    echo json_encode($result);
}
// }





?>