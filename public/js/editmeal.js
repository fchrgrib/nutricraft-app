    // Get references to the HTML elements
    const ingredientList = document.getElementById("ingredientList");
    const addIngredientBtn = document.getElementById("addIngredientBtn");

    // Function to create a new list item with input fields and a delete button
    function createListItem() {
        // Create a new list item and input elements
        const listItem = document.createElement("li");
        const inputIngredients = document.createElement("input");
        const inputInformation = document.createElement("input");
        const deleteBtn = document.createElement("button");

        // Set attributes and placeholders for the input elements
        inputIngredients.type = "text";
        inputIngredients.placeholder = "Ingredients";
        inputIngredients.class = "form-control";
        inputInformation.type = "text";
        inputInformation.placeholder = "Information";

        // Set text and type for the delete button
        deleteBtn.textContent = "X";
        deleteBtn.type = "button";

        // Add a click event listener to the delete button
        deleteBtn.addEventListener("click", () => {
            // Remove the parent list item when the delete button is clicked
            listItem.remove();
        });

        // Append the input elements and delete button to the list item
        listItem.appendChild(inputIngredients);
        listItem.appendChild(inputInformation);
        listItem.appendChild(deleteBtn);

        // Append the list item to the ingredientList (ul)
        ingredientList.appendChild(listItem);
    }

    // Add a click event listener to the "Add Ingredients" button
    addIngredientBtn.addEventListener("click", createListItem);

    document.querySelector('.editPhotoButton').addEventListener('click', function() {
        document.getElementById('file').click();
    });
    
    function loadpage(id) {
        console.log(id);
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', "../../server/controller/auth/DetailMeal.php", true);
        xhttp.onload = function() {
            let response = this.response;
            // console.log(response);
            const startIndex = response.indexOf('[');
            const image = document.getElementById('image');
            const type = document.getElementById('type');
            const descrition = document.getElementById('description');
            const calorie = document.getElementById('editCalories');
            const carbs = document.getElementById('editCarbohydrates');
            const protein = document.getElementById('editProtein');
            const fat = document.getElementById('editFat');
            const sugar = document.getElementById('editsugar');
            const jsonStr = response.substring(startIndex);
            // console.log(jsonStr);
            const jsonObject = JSON.parse(jsonStr);
            console.log(jsonObject);
    
        
            const content = jsonObject;
            image.src = content[0][0]['path_photo'];
            const titleInput = document.getElementById("title"); // Get the input element by its id
            titleInput.value = content[0][0]['title']; // Set the value
            descrition.value = content[0][0]['description'];

            for (let i = 0; i < content[1].length; i++) {
                const ingredients = document.getElementById('ingredientList');
                const li = document.createElement('li');
                const inputIngredients = document.createElement("input");
                const inputInformation = document.createElement("input");
                const ingredient = content[1][i]['ingredient'];
                const description = content[1][i]['description'];
                inputIngredients.type = "text";
                inputIngredients.placeholder = "Ingredients";
                inputIngredients.class = "form-control";
                inputIngredients.value = ingredient;
                inputInformation.type = "text";
                inputInformation.placeholder = "Information";
                inputInformation.value = description;
                li.appendChild(inputIngredients);
                li.appendChild(inputInformation);
                // Concatenate ingredient and description with a delimiter (e.g., a space)
                const combinedText = `${ingredient} - ${description}`;
                ingredients.appendChild(li);
            }
    
            calorie.value = content[0][0]['calorie'];
            carbs.value = content[2][0]['carbo'];
            protein.value = content[2][0]['protein'];
            fat.value = content[2][0]['fat'];
            sugar.value = content[2][0]['sugar'];
    
            // console.log(content['title']);
        
        };
        
        xhttp.send(JSON.stringify({id : id}));
    }