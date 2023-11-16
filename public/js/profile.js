
const enableName= () => {
    document.getElementById('editNama').disabled = false;
}

const enableEmail= () => {
    document.getElementById('email').disabled = false;
}

const enablePhoneNumber= () => {
    document.getElementById('phoneNumber').disabled = false;
}

const enablePassword= () => {
    document.getElementById('editPassword').disabled = false;
}

function updatePhoto() {
    const fileInput = document.getElementById("file");
    const photoProfile = document.getElementById("photoProfile");
    const file = fileInput.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
      photoProfile.src = e.target.result;
    }
    reader.readAsDataURL(file);
  }

  function showConfirmation() {
    const confirmationBox = document.getElementById('confirmationBox');
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    const message = document.getElementById('message');
    message.innerHTML = "Apply these changes?";
    confirmationBox.style.display = 'flex';
    confirmButton.type = 'submit';
    confirmButton.name = 'submit';
    cancelButton.type = 'button';
    cancelButton.name = 'cancel';
    confirmButton.addEventListener('click', function() {
        // Your code for handling the "Confirm" action here
        console.log('confirm');
        hideConfirmation();
    });
    
    cancelButton.addEventListener('click', function() {
        // Your code for handling the "Cancel" action here
        console.log('cancel');
        hideConfirmation();
    });
}

function hideConfirmation() {
    const confirmationBox = document.getElementById('confirmationBox');
    confirmationBox.style.display = 'none';
}

function showConfirmationdelete() {
    const confirmationBox = document.getElementById('confirmationBox');
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    const message = document.getElementById('message');
    message.innerHTML = "Are you sure you want to delte your account?";
    confirmationBox.style.display = 'flex';
    confirmButton.type = 'submit';
    confirmButton.name = 'delete';
    cancelButton.type = 'button';
    cancelButton.name = 'cancel';
    confirmButton.addEventListener('click', function() {
        // Your code for handling the "Confirm" action here
        console.log('confirm');
        hideConfirmation();
    });
    
    cancelButton.addEventListener('click', function() {
        // Your code for handling the "Cancel" action here
        console.log('cancel');
        hideConfirmation();
    });
}

function showExp(){
    const show = "exp";

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            let response = this.response;
            // const jsonObject = JSON.parse(response);
            console.log(response);
            
            const parentElement = document.getElementById("levelcirle");
            let html = "";
            const level = Math.floor(response/100);
            const exp = response%100;
            document.querySelector('ul.skills li.sk-cms').style.setProperty('--per', exp);

            html += `
                <p class="leveltext" id>${level}</p>
            `;
            
            parentElement.innerHTML = html;        
        }
    };  
    xhttp.open('GET', `../../server/controller/auth/Profile.php?show=${show}`, true);
    xhttp.send();
}