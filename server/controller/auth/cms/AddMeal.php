<?php

require_once "../../../../server/handler/data/File.php";
require_once "../../../../server/handler/data/Nutrition.php";
require_once "../../../../server/handler/data/Meal.php";
require_once "../../../../server/handler/data/Ingredients.php";


use data\File;
use data\Meal;
use data\Nutrition;
use data\Ingredients;


if(isset($_POST['submit'])) {
    $meals = new Meal();
    $file = new File();
    $nutrition = new Nutrition();
    $ingredients = new Ingredients();

    if (!empty($_FILES['file']['name'])) {
        $targetDirectory = "../../../../assets/meals/";

        $writeDirectory = "../../../../assets/meals/";
        $file_name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_up_name = time() . "." . $extension;
        move_uploaded_file($tmp_name, $targetDirectory . $file_up_name);

        $id_file = $file->Insert($file_name,'../../assets/meals/'.$file_up_name,'photo');
    }

    if (
        isset($_POST['mealname'])&&isset($_POST['mealdescription'])&&
        isset($_POST['mealtype'])&&isset($_POST['calories'])&&
        isset($_POST['carbohydrates'])&&isset($_POST['protein'])&&
        isset($_POST['fat'])&&isset($_POST['sugar'])&&
        isset($_POST['mealhighlight'])
    ){
        $title = $_POST['mealname'];
        $description = $_POST['mealdescription'];
        $highlight = $_POST['mealhighlight'];
        $type = $_POST['mealtype'];
        $calorie = $_POST['calories'];
        $carbo = $_POST['carbohydrates'];
        $protein = $_POST['protein'];
        $fat = $_POST['fat'];
        $sugar = $_POST['sugar'];


        $id_meals = $meals->Insert($title,$highlight,$description,$type,$calorie,$id_file);
        $nutrition->Insert($calorie,$carbo,$protein,$fat,$sugar,$id_meals);
    }

    if(isset($_POST['item'])){
        $items = $_POST['item'];
        foreach ($items as $index => $itemData) {
            $ing = $itemData['ingredients'];
            $info = $itemData['information'];
            $ingredients->Insert($ing,$info,$id_meals);
        }
    }

//    echo "<script>window.location.href='/?cms'</script>";


}
