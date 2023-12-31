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
        inputIngredients.name = "ingredients";
        inputInformation.type = "text";
        inputInformation.placeholder = "Information";
        inputInformation.name = "information";

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
    
    document.querySelector("form").addEventListener("submit", function(event) {
        const listItems = document.querySelectorAll("#ingredientList li");
        listItems.forEach(function(li, index) {
            const ingredients = li.querySelector('input[name^="ingredients"]');
            const information = li.querySelector('input[name^="information"]');

            // Set POST variables dynamically using JavaScript
            ingredients.name = `item[${index}][ingredients]`;
            information.name = `item[${index}][information]`;
        });
    });