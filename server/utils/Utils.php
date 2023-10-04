<?php


use di\InitialData;


// require_once "server/handler/data/Content.php";
// require_once "server/handler/data/File.php";
// require_once "server/handler/data/Ingredients.php";
// require_once "server/handler/data/Meal.php";
// require_once "server/handler/data/Nutrition.php";
require_once (__DIR__."/../di/InitialData.php");

// use data\Content;
// use data\File;
// use data\Ingredients;
// use data\Meal;
// use data\Nutrition;

function check_init_database($conn,$is_file, $is_content, $is_meals, $is_ingredients, $is_nutrition)
{

    $init = new InitialData();

    if (pg_num_rows($is_file)==0){
        $files = $init->getFile();
        foreach ($files as $file){
            $insert_data = pg_query_params($conn, "INSERT INTO
                                file(name,path,type_content,created_at,updated_at)
                                VALUES ($1,$2,$3,$4,$5)",
                array($file['name'],$file['path'],$file['type_content'],$file['created_at'],$file['updated_at'])
            );

            if (!$insert_data) die("failed to insert values: ".pg_last_error());
        }
    }

    if (pg_num_rows($is_content)==0){
        $contents = $init->getContent();
        foreach ($contents as $content){
            $insert_data = pg_query_params($conn, "INSERT INTO 
                                content(title,body,id_file,id_photo_highlight,highlight,created_at,updated_at)
                                VALUES($1,$2,$3,$4,$5,$6,$7)",array($content['title'],$content['body'],$content['id_file'],$content['id_photo_highlight'],$content['highlight'],$content['created_at'],$contents['updated_at']));

            if (!$insert_data) die("failed to insert values: ".pg_last_error());

            echo "<script>console.log('successfully insert content')</script>";
        }
    }

    if (pg_num_rows($is_meals)==0){
        $meals = $init->getMeals();
        foreach ($meals as $meal){
            $insert_data = pg_query_params($conn, "INSERT INTO 
                                    meals(title,highlight,description,type,calorie,created_at,updated_at)
                                    VALUES($1,$2,$3,$4,$5,$6,$7)
                                    ", array($meal['title'],$meal['highlight'],$meal['description'],$meal['type'],$meal['calorie'],$meal['created_at'],$meal['updated_at']));

            if (!$insert_data) die("failed to insert values: ".pg_last_error());
        }
    }

    if (pg_num_rows($is_ingredients)==0){
        $ingredients = $init->getIngredients();
        foreach ($ingredients as $ingredient){
            $insert_data = pg_query_params($conn, "INSERT INTO
                                ingredients(ingredient,description,id_meals)
                                VALUES ($1,$2,$3)",
                array($ingredient['ingredient'],$ingredient['description'],$ingredient['id_meals'])
            );

            if (!$insert_data) die("failed to insert values: ".pg_last_error());
        }
    }

    if (pg_num_rows($is_nutrition)==0){
        $nutritions = $init->getNutritionFact();
        foreach ($nutritions as $nutrition) {
            $insert_data = pg_query_params($conn, "INSERT INTO nutrition(calorie,carbo,protein,fat,sugar,id_meals)
                                       VALUES($1,$2,$3,$4,$5,$6)
                                       ",array($nutrition['calorie'],$nutrition['carbo'],$nutrition['protein'],$nutrition['fat'],$nutrition['sugar'],$nutrition['id_meals']));

            if (!$insert_data) die("failed to insert values: ".pg_last_error());
        }
    }

    echo "<script>console.log('successfully init data')</script>";
}