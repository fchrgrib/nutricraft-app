function loadFactsData(data) {
    const content = document.querySelector('.card-meal_content');

    xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        let response = this.response;
        const startIndex = response.indexOf('[');
        const jsonStr = response.substring(startIndex);
        const jsonObject = JSON.parse(jsonStr);

        console.log(jsonObject);


        content.innerHTML = "<h1>Facts</h1>";

        jsonObject.forEach(fact => {
            const factHTML = `
                            <div class='cardmeal' id='meal-card'>
                                <div class='cardmealimage'>
                                    <img src=${fact.path_photo} alt=''>
                                </div>
                                <div class='card-meal__content'>
                                    <div class='card-meal__content__title'>
                                        <h3>${fact.title}</h3>
                                    </div>
                                    <div class='card-meal__content__description'>
                                        <p>${fact.highlight}</p>
                                    </div>
                                </div>
                                <div class='card-meal__content__edit'>
                                    <button type='button' class='editbtn'>Edit</button>
                                    <button type='button' class='deletebtn' onclick='showConfirmationfact()'>Delete</button>
                                </div>
                            </div>`;
            content.innerHTML += factHTML;
        });
    }
    xhttp.open('GET', "../../../server/controller/auth/cms/Fact.php", true);
    xhttp.send();
}

function showConfirmationfact() {
    const confirmationBox = document.getElementById('confirmationBox');
    const content = document.getElementById('content');
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    const message = document.getElementById('message');
    message.innerHTML = "Are you sure you want to delete this content?";
    confirmationBox.style.display = 'flex';
    content.style.filter = 'blur(3px)';
    confirmButton.addEventListener('click', function() {
        // Your code for handling the "Confirm" action here
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