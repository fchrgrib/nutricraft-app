function loadpage(id) {
    console.log(id);
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/DetailFact.php", true);
    xhttp.onload = function() {
        let response = this.response;
        // console.log(response);
        const startIndex = response.indexOf('[');
        const image = document.getElementById('imagevideo');
        const title = document.getElementById('edittitle');
        const description = document.getElementById('editdescription');
        const highlight = document.getElementById('edithighlight');
        const jsonStr = response.substring(startIndex);
        // console.log(jsonStr);
        const jsonObject = JSON.parse(jsonStr);
        console.log(jsonObject);
        // console.log(image);
        
        
        const content = jsonObject;
        image.src = content[0]['path_photo'];
        title.value = content[0].title;
        description.value = content[0]['body'];
        highlight.value = content[0].highlight;

    };
    xhttp.send(JSON.stringify({id : id}));
}

const submitbtn = document.getElementById('submitbtn');

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



