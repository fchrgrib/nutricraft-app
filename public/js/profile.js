
const enableName= () => {
    document.getElementById('editNama').disabled = false;
}

const enableEmail= () => {
    document.getElementById('editEmail').disabled = false;
}

const enablePhoneNumber= () => {
    document.getElementById('editPhone').disabled = false;
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