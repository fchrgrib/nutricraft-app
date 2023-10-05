<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/detailmeal.css">
    <script defer src="../../../public/js/detailmeal.js"></script>
    <title>NutriCraft</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
    ?>
    <script>
        window.onload = function() {loadpage(<?php echo $id; ?>);};

    </script>
    <div class="back">
        <div class="content">
            <div class="foodimage">
                <img src="../../../assets/meal.jpg" alt="" id="image">
                <div class="nutritionfacts">
                    <h3>Nutrition Facts</h3>
                    <div class="calories">
                        <h5 id="calorie">300 cal</h5>
                        <p>Calories</p>
                    </div>
                    <div class="carbs">
                        <h5 id="carbs">20g</h5>
                        <p>Carbs</p>
                    </div>
                    <div class="protein">
                        <h5 id="protein">20g</h5>
                        <p>Protein</p>
                    </div>
                    <div class="fat">
                        <h5 id="fat">5g</h5>
                        <p>Fat</p>
                    </div>
                    <div class="sugar">
                        <h5 id="sugar">1g</h5>
                        <p>Sugar</p>
                    </div>
                </div>
            </div>
            <div class="foodcontent">
                <div class="foodtitle" id="foodtitle">
                    <h1 id="title"></h1>
                    <h3 id="type"></h3>
                </div>
                <div class="fooddescription">
                    <p id="description"></p>
                </div>
                <div class="ingredients">
                    <h3>Ingredients</h3>
                    <ul id="ingredients">
                        <!-- Add more ingredients as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>