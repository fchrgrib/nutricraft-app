function loadMealsData() {
    const content = document.querySelector('.card-meal_content');

    xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let response = this.response;
        const startIndex = response.indexOf('[');
        const jsonStr = response.substring(startIndex);
        const jsonObject = JSON.parse(jsonStr);


        content.innerHTML = "<h1>Meals</h1>";

        jsonObject.forEach(meal => {
            const mealHTML = `
<form action="../../../server/controller/auth/cms/DeleteMealAndFact.php" method="POST" enctype="multipart/form-data">
                            <div class='cardmeal' id='meal-card'>
                                <div class='cardmealimage'>
                                    <img src=${meal.path_photo} alt=''>
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
                                <a href="/?editmeal&id=${meal.id}">
                                <input hidden="hidden" name="id_meals" value="${meal.id}">
                                <button type='button' class='editbtn'>Edit</button>
                                </a>
                                    <button type='button' class='deletebtn' name="deletebtn" value="${meal.id}" onclick='showConfirmation("${meal.id}")'>Delete</button>
                                </div>
                            </div>
</form>`;
            content.innerHTML += mealHTML;
        });
    };
    xhttp.open('GET', "../../../server/controller/auth/cms/Meals.php", true);
    xhttp.send();
}



function showConfirmation(id) {
    const confirmationBox = document.getElementById('confirmationBox');
    const content = document.getElementById('content');
    const confirmButton = document.getElementById('confirmButton');
    const valueConfirm = document.getElementById('confirmationId');
    const cancelButton = document.getElementById('cancelButton');
    const message = document.getElementById('message');

    message.innerHTML = "Are you sure you want to delete this meal?";
    confirmationBox.style.display = 'flex';
    content.style.filter = 'blur(3px)';
    confirmButton.addEventListener('click', function() {
        valueConfirm.value = `meals;${id}`;
        hideConfirmation();
    });
    
    cancelButton.addEventListener('click', function() {
        // Your code for handling the "Cancel" action here
        hideConfirmation();
    });
}

function hideConfirmation() {
    const confirmationBox = document.getElementById('confirmationBox');
    const content = document.getElementById('content');
    confirmationBox.style.display = 'none';
    content.style.filter = 'none';
}

// Trigger the confirmation box
// You can call showConfirmation() wherever you need to show the confirmation dialog
