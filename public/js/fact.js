function toggleVideo(card) {
    var content = card.querySelector('.video-content');
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight =  "50vw";
    }
}

function capitalizeWords(str) {
    return str.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
  }

const Search = () => {
    const search = capitalizeWords(document.getElementById('searchinput').value);
    const select = document.getElementById('pet-select').value;
    xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/Fact.php", true);
    xhttp.onload = function() {
        let response = this.response;
        const startIndex = response.indexOf('[');
        const jsonStr = response.substring(startIndex);
        const jsonObject = JSON.parse(jsonStr);

        console.log(jsonStr);


        const parentElement = document.getElementById("isicontent");

        let html = "";
        for (let i = 0; i < jsonObject.length; i++) {
        const content = jsonObject[i];
        html += `
            <div class="video-card" onclick="toggleVideo(this)">
            <div class="cardcontent">
                <img src="../../../assets/thumbnail.png" alt="">
                <div class="card-title">
                <h3>${content.title}</h3>
                <p>${content.highlight}</p>
                </div>
            </div>
            </div>
        `;
        }

        parentElement.innerHTML = html;

        
    };
    xhttp.send(JSON.stringify({search: search, select: select}));

}

const showAll = () => {
    const show = "all";
    xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/Fact.php", true);
    xhttp.onload = function() {
        let response = this.response;
        const startIndex = response.indexOf('[');
        const jsonStr = response.substring(startIndex);
        // const jsonObject = JSON.parse(jsonStr);
        console.log(jsonStr);


        // const parentElement = document.getElementById("isicontent");

        // let html = "";
        // for (let i = 0; i < jsonObject.length; i++) {
        // const content = jsonObject[i];
        // html += `
        //     <div class="video-card" onclick="toggleVideo(this)">
        //     <div class="cardcontent">
        //         <img src="../../../assets/thumbnail.png" alt="">
        //         <div class="card-title">
        //         <h3>${content.title}</h3>
        //         <p>${content.highlight}</p>
        //         </div>
        //     </div>
        //     </div>
        // `;
        // }
        // parentElement.innerHTML = html;        
    };  
    xhttp.send(JSON.stringify({show : show}));

}


function debounce(func, timeout = 500){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}


const searchDebounce = debounce(() => Search());