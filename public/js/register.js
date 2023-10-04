const validateInputEmail = (email) => {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
};

const validateInputPhoneNumber = (phoneNumber) => {
    const re = /^\d{10}$/;
    return re.test(phoneNumber);
};

const validateEmail = () => {
    const email = document.getElementById('email').value;
    if (!validateInputEmail(email)) {
        document.getElementById('emailcontainer').style.borderColor = 'red';
        document.getElementById('emailInvalid').innerHTML = 'Invalid email address';
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', "../../server/controller/auth/Register.php", true);
        xhttp.onload = function() {
            let response = this.response;
            const startIndex = response.indexOf('{');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            console.log(jsonObject.message);
            console.log(jsonObject.status);
            if(jsonObject.status=='ERROR'){
                document.getElementById('emailcontainer').style.borderColor = 'red';
                document.getElementById('emailInvalid').innerHTML = jsonObject.message;
            }else{
                document.getElementById('emailcontainer').style.borderColor = 'black';
                document.getElementById('emailInvalid').innerHTML = '';
            }
        }
        xhttp.send(JSON.stringify({email: email}));
    }
    validateAll();
};

const validatePhoneNumber = () => {
    const phoneNumber = document.getElementById('phoneNumber').value;
    if (phoneNumber.length !== 10) {
        document.getElementById('phonenumbercontainer').style.borderColor = 'red';
        document.getElementById('phoneNumberInvalid').innerHTML = 'Phone number must be 10 digits';
    }else if (!validateInputPhoneNumber(phoneNumber)) {
        document.getElementById('phonenumbercontainer').style.borderColor = 'red';
        document.getElementById('phoneNumberInvalid').innerHTML = 'Invalid phone number';
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', "../../server/controller/auth/Register.php", true);
        xhttp.onload = function() {
            let response = this.response;
            const startIndex = response.indexOf('{');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            console.log(jsonObject.message);
            console.log(jsonObject.status);
            if(jsonObject.status=='ERROR'){
                document.getElementById('phonenumbercontainer').style.borderColor = 'red';
                document.getElementById('phoneNumberInvalid').innerHTML = jsonObject.message;
            }else{
                document.getElementById('phonenumbercontainer').style.borderColor = 'black';
                document.getElementById('phoneNumberInvalid').innerHTML = '';
            }
        }
        xhttp.send(JSON.stringify({phoneNumber: phoneNumber}));
    }
    validateAll();
}

// const validateUname = () => {
//     const uname = document.getElementById('uname').value;
//     if (uname.length < 3) {
//         document.getElementById('unamecontainer').style.borderColor = 'black';
//         document.getElementById('unameInvalid').innerHTML = '';
//     } else {
//         document.getElementById('unamecontainer').style.borderColor = 'red';
//         document.getElementById('unameInvalid').innerHTML = 'Invalid username';
//     }
//     validateAll();
// };


const validateAll = () => {
    const email = document.getElementById('emailcontainer').style.borderColor=='black';
    const phoneNumber = document.getElementById('phonenumbercontainer').style.borderColor!='red';
    // const uname = document.getElementById('unamecontainer').style.borderColor=='black';
    console.log(email);
    console.log(phoneNumber);

    if(email && phoneNumber){
        document.getElementById('registerButton').disabled = false;
        console.log('enabled register button');
    }else{
        document.getElementById('registerButton').disabled = true;
    }
};