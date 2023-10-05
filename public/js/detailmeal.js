

function loadpage(id) {
    console.log(id);
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/DetailMeal.php", true);
    xhttp.onload = function() {
        let response = this.response;
        // console.log(response);
        const startIndex = response.indexOf('[');
        const title = document.getElementById('title');
        const type = document.getElementById('type');
        const descrition = document.getElementById('description');
        const jsonStr = response.substring(startIndex);
        const jsonObject = JSON.parse(jsonStr);
        console.log(jsonObject);

    
        const content = jsonObject;
        title.textContent = content[0]['title'];
        type.textContent = content[0]['type'];
        descrition.textContent = content[0]['description'];

        // console.log(content['title']);
    
    };
    
    xhttp.send(JSON.stringify({id : id}));
}
