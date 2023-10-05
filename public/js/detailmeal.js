

function loadpage(id) {
    console.log(id);
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/DetailMeal.php", true);
    xhttp.onload = function() {
        let response = this.response;
        // console.log(response);
        const startIndex = response.indexOf('[');
        const image = document.getElementById('image');
        const title = document.getElementById('title');
        const type = document.getElementById('type');
        const descrition = document.getElementById('description');
        const calorie = document.getElementById('calorie');
        const carbs = document.getElementById('carbs');
        const protein = document.getElementById('protein');
        const fat = document.getElementById('fat');
        const sugar = document.getElementById('sugar');
        const jsonStr = response.substring(startIndex);
        // console.log(jsonStr);
        const jsonObject = JSON.parse(jsonStr);
        console.log(jsonObject);

    
        const content = jsonObject;
        image.src = content[0][0]['path_photo'];
        title.textContent = content[0][0]['title'];
        type.textContent = content[0][0]['type'];
        descrition.textContent = content[0][0]['description'];
        for (let i = 0; i < content[1].length; i++) {
            const ingredients = document.getElementById('ingredients');
            const li = document.createElement('li');
            const ingredient = content[1][i]['ingredient'];
            const description = content[1][i]['description'];

            // Concatenate ingredient and description with a delimiter (e.g., a space)
            const combinedText = `${ingredient} - ${description}`;
            li.textContent = combinedText;
            ingredients.appendChild(li);
        }

        calorie.textContent = content[0][0]['calorie'];
        carbs.textContent = content[2][0]['carbo']; 
        protein.textContent = content[3][0]['protein'];
        fat.textContent = content[4][0]['fat'];
        sugar.textContent = content[5][0]['sugar'];

        // console.log(content['title']);
    
    };
    
    xhttp.send(JSON.stringify({id : id}));
}
