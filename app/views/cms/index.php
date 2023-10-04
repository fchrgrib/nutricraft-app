<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/cms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>NutriCraft</title>
</head>
<body>
<div>
        <div class="content">
            <div class="header">
                <h1>CMS Admin</h1>
                <div class="buttons">
                    <button type="button" class="mealsbtn" id="selected">Meals</button>
                    <button type="button" class="factsbtn">Facts</button>
                </div>
                
                <div class="searchadd">  
                    <div class="searchcontainer">
                        <i class="fas fa-search"></i>
                        <input class="searchinput" type="text" placeholder="Search">
                    </div>
                    <a href="/?addmeal" class="addhref">
                    <button type="button" class="addbtn">Add Meal</button>
                    </a>
                </div>
            </div>
            <div class="card-meal_content">
                <!-- This is where the content will be displayed -->
            </div>

            <script>
                loadMealsData(<?php echo json_encode($data['meals']); ?>);
                // Get all the buttons
                const buttons = document.querySelectorAll('.buttons button');
                const addBtn = document.querySelector('.addbtn');
                const addHref = document.querySelector('.addhref');

                // Add click event listeners to each button
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Remove the 'selected' class from all buttons
                        const currentlySelectedButton = document.querySelector('#selected');
                        currentlySelectedButton.removeAttribute('id');

                        // Add the 'selected' id to the clicked button
                        button.id = 'selected';

                        // Optionally, you can add a CSS class to style the selected button
                        buttons.forEach(btn => btn.classList.remove('selected'));
                        button.classList.add('selected');

                        // Determine which button is selected and call the appropriate function
                        if (button.classList.contains('mealsbtn')) {
                            // Handle Meals button click
                            loadMealsData(<?php echo json_encode($data['meals']); ?>);
                            addBtn.textContent = "Add Meal";
                            addHref.href = "/?addmeal";
                        } else if (button.classList.contains('factsbtn')) {
                            // Handle Facts button click
                            loadFactsData(<?php echo json_encode($data['facts']); ?>);
                            addBtn.textContent = "Add Fact";
                            addHref.href = "/?addfact";
                        }
                    });
                });

                // Function to load Meals data
                function loadMealsData(data) {
                    const content = document.querySelector('.card-meal_content');
                    content.innerHTML = "<h1>Meals</h1>";

                    data.forEach(meal => {
                        const mealHTML = `
                            <div class='cardmeal' id='meal-card'>
                                <div class='cardmealimage'>
                                    <img src='../../../assets/meal.jpg' alt=''>
                                </div>
                                <div class='card-meal__content'>
                                    <div class='card-meal__content__title'>
                                        <h3>${meal.title}</h3>
                                    </div>
                                    <div class='card-meal__content__description'>
                                        <p>${meal.highlight}</p>
                                    </div>
                                    <div class='card-meal__content__calories'>
                                        <p>Calories: ${meal.calorie}</p>
                                    </div>
                                </div>
                                <div class='card-meal__content__edit'>
                                    <button type='button' class='editbtn'>Edit</button>
                                    <button type='button' class='deletebtn'>Delete</button>
                                </div>
                            </div>`;
                        content.innerHTML += mealHTML;
                    });
                }

                // Function to load Facts data
                function loadFactsData(data) {
                    const content = document.querySelector('.card-meal_content');
                    content.innerHTML = "<h1>Facts</h1>";

                    data.forEach(fact => {
                        const factHTML = `
                            <div class='cardmeal' id='meal-card'>
                                <div class='cardmealimage'>
                                    <img src='../../../assets/meal.jpg' alt=''>
                                </div>
                                <div class='card-meal__content'>
                                    <div class='card-meal__content__title'>
                                        <h3>${fact.title}</h3>
                                    </div>
                                    <div class='card-meal__content__description'>
                                        <p>${fact.content}</p>
                                    </div>
                                </div>
                                <div class='card-meal__content__edit'>
                                    <button type='button' class='editbtn'>Edit</button>
                                    <button type='button' class='deletebtn'>Delete</button>
                                </div>
                            </div>`;
                        content.innerHTML += factHTML;
                    });
                }
            </script>
</body>
</html>