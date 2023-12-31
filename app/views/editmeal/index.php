<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
    <link rel="stylesheet" href="../../../public/css/editmeal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="../../../public/js/editmeal.js"></script>
    <title>Document</title>
    <?php
        $id = $_GET['id'];
    ?>
    <script>
        window.onload = function() {loadpage(<?php echo $id; ?>);};

    </script>
</head>
<body>
    <form action="../../../server/controller/auth/cms/EditMeal.php" method="POST" enctype="multipart/form-data">
        <input hidden="hidden" value=<?php echo $id ?>; name="test">
        <div class="content">
            <div class="imagecontainer">
                <img src="../../../assets/Nopict.png" alt="defaultProfPic" class="photoProfile" id="image">
                <div class="editPhotoButton">
                    <label for="file" class="labelFile">Upload Photo</label>
                    <input type="file" name="file" id="file" class="file" accept="image/*">
                </div>
            </div>
            <div class="editcontainer">
                <div class="mealinformation">
                    <h2 class="mealtitle">Meal Information</h2>
                    <div class="nametype">
                        <div class="name-container">
                            <div class="mealname">
                                <p class="labelname">Meal Name</p>
                                <input type="text" placeholder="Meal Name" class="inputname" id="title" name="mealname">
                            </div>
                        </div>
                        <div class="mealtype">
                            <p class="labeltype">Meal Type</p>
                            <select name="mealtype" class="inputtype">
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                            </select>
                        </div>
                    </div>
                    <div class="mealhighlight">
                        <p class="labeldescription">Meal Highlight</p>
                        <input name="mealdescription" id="highlight"class="inputhighlight" placeholder="Highlight"></textarea>
                    </div>
                    <div class="mealdescription">
                        <p class="labeldescription">Meal Description</p>
                        <textarea name="mealdescription" id="description"class="inputdescription" placeholder="Description"></textarea>
                    </div>
                    <div class="mealingredients">
                        <p class="labelingredients">Meal Ingredients</p>
                        <ul id="ingredientList">
                            <!-- Existing list items go here -->
                        </ul>
                        <button type="button" class="addbutton" id="addIngredientBtn">Add</button>
                    </div>
                </div>
                <div class="mealnutrition">
                    <h2 class="mealtitle">Meal Nutrition</h2>
                    <div class="nutritioncontainer">
                        <div class="calcabs">
                            <div class="nutrition">
                                <p class="labelnutrition">Calories</p>
                                <input type="text" placeholder="Calories" class="inputnutrition" id="editCalories" name="calories">
                            </div>
                            <div class="nutrition">
                                <p class="labelnutrition">Carbohydrates</p>
                                <input type="text" placeholder="Carbohydrates" class="inputnutrition" id="editCarbohydrates" name="carbohydrates">
                            </div>
                        </div>
                        <div class="profat">
                            <div class="nutrition">
                                <p class="labelnutrition">Protein</p>
                                <input type="text" placeholder="Protein" class="inputnutrition" id="editProtein" name="protein">
                            </div>
                            <div class="nutrition">
                                <p class="labelnutrition">Fat</p>
                                <input type="text" placeholder="Fat" class="inputnutrition" id="editFat" name="fat">
                            </div>
                        </div>
                        <div class="nutrition">
                                <p class="labelnutrition">Sugar</p>
                                <input type="text" placeholder="Sugar" class="inputnutrition" id="editsugar" name="sugar">
                            </div>
                    </div>


                <button type="submit" class="submitButton" name="submit">Save Change</button>
            </div>
    </form>
</body>
</html>