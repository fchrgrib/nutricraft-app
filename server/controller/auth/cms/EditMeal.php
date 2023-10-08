<?php

require_once "../../../../server/handler/data/File.php";
require_once "../../../../server/handler/data/Nutrition.php";
require_once "../../../../server/handler/data/Meal.php";
require_once "../../../../server/handler/data/Ingredients.php";


use data\File;
use data\Meal;
use data\Nutrition;
use data\Ingredients;

if (isset($_POST['submit'])){
    $a = explode(";",$_POST['test']);
    $id = $a[0];
    $meal = new Meal();
    $file = new File();
    $nutrition = new Nutrition();
    $ingredients = new Ingredients();

    $get_meals = $meal->FindById($id)[0];
    $get_ingredients = $ingredients->FindByMeals($id);
    $get_nutrition = $ingredients->FindByMeals($id);
    $get_file = $file->FindById($get_meals['id_photo']);

    if (!empty($_FILES['file']['name'])){
        $targetDirectory = "../../../../assets/meals/";

        $writeDirectory = "../../../../assets/meals/";
        $file_name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_up_name = time() . "." . $extension;
        move_uploaded_file($tmp_name, $targetDirectory . $file_up_name);

        $file->Update($file->FindById($get_meals['id_photo']),$file_name,'../../assets/meals/'.$file_up_name,'photo');
    }
    if (isset($_POST['mealname'])){
        $get_meals['title'] = $_POST['mealname'];
    }
    if (isset($_POST['mealhighlight'])){
        $get_meals['highlight'] = $_POST['mealhighlight'];
    }
    if (isset($_POST['mealtype'])){
        $get_meals['type'] = $_POST['mealtype'];
    }
    if (isset($_POST['calories'])){
        $get_meals['calorie'] = $_POST['calories'];
        $get_nutrition['calorie'] = $_POST['calories'];
    }
    if (isset($_POST['carbohydrates'])){
        $get_nutrition['carbo'] = $_POST['carbohydrates'];
    }
    if (isset($_POST['protein'])){
        $get_nutrition['protein'] = $_POST['protein'];
    }
    if (isset($_POST['sugar'])){
        $get_nutrition['sugar'] = $_POST['sugar'];
    }
    if (isset($_POST['fat'])){
        $get_nutrition['fat'] = $_POST['fat'];
    }

    if(isset($_POST['item'])) {
        $ingredients->DeleteByIdMeals($id);
        $items = $_POST['item'];
        foreach ($items as $index => $itemData) {
            $ing = $itemData['ingredients'];
            $info = $itemData['information'];
            $ingredients->Insert($ing,$info,$id);
        }
    }

    $c = json_encode($get_meals);

    echo "<script>console.log('$c')</script>";


    $meal->Update($get_meals['id'],$get_meals['title'],$get_meals['highlight'],$get_meals['description'],$get_meals['type'],$get_meals['calorie'],$get_meals['id_photo']);

    echo "<script>window.location.href='/?cms'</script>";
}
