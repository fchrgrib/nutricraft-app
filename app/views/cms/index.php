<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/cms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="../../../public/js/cms/meals.js"></script>
    <script src="../../../public/js/cms/fact.js"></script>
    <script>window.onload = function() {loadMealsData();};</script>
    <title>NutriCraft</title>
</head>
<body>
    <div class="overlay" id="confirmationBox">
        <div class="confirmation-dialog">
            <p>Are you sure you want to continue?</p>
            <div class="confirmbtn">
            <button id="confirmButton">Confirm</button>
            <button id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>    
<div>
        <div class="content" id="content">
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
                // loadMealsData();
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
                            loadMealsData();
                            addBtn.textContent = "Add Meal";
                            addHref.href = "/?addmeal";
                        } else if (button.classList.contains('factsbtn')) {
                            // Handle Facts button click
                            loadFactsData();
                            addBtn.textContent = "Add Fact";
                            addHref.href = "/?addfact";
                        }
                    });
                });

            </script>

</body>
</html>