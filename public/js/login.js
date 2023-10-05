
const validateInputEmail = (email) => {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
};


const checkEmail = () =>{
    const email = document.getElementById('emailinput').value;
    if (!validateInputEmail(email)) {
        document.getElementById('emailInvalid').innerHTML = 'Invalid email address';
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', "../../server/controller/auth/Login.php", true);
        xhttp.onload = function() {
            let response = this.response;
            const startIndex = response.indexOf('{');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            console.log(jsonObject.message);
            console.log(jsonObject.status);
            if(jsonObject.status=='ERROR'){
                document.getElementById('emailInvalid').innerHTML = jsonObject.message;
            }else{
                document.getElementById('emailInvalid').innerHTML = '';
            }
        }
        xhttp.send(JSON.stringify({email: email}));
    }
    validateButton();
}

const validateButton = () => {
    const email = document.getElementById('emailInvalid').textContent;
    console.log(email);
    if(email == ''){
        console.log('masuk');
        document.getElementById('login').disabled = false;
    }
}