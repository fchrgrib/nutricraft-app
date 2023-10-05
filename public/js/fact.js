function toggleVideo(card) {
    var content = card.querySelector('.video-content'); // Use card parameter to find .video-content within the clicked card
    console.log(content)
    if (content && content.style.maxHeight) { // Check if content is not null
        content.style.maxHeight = null;
    } else if (content) { // Check if content is not null
        content.style.maxHeight = "50vw";
    }
}

let Page = 1;

// Add a click event listener to a parent container (e.g., isicontent)
document.getElementById("isicontent").addEventListener("click", function(event) {
    const target = event.target;

    // Check if the clicked element has the class .video-card
    if (target.classList.contains("video-card")) {
        toggleVideo(target);
    }
});


function capitalizeWords(str) {
    return str.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
  }

  
  // masi salah
const pagination = () => {
    const show = "all";
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', "../../server/controller/auth/Fact.php", true);
    xhttp.onload = function() {
        let response = this.response;
        const startIndex = response.indexOf('[');
        const jsonStr = response.substring(startIndex);
        const jsonObject = JSON.parse(jsonStr);
        console.log(jsonObject);
        
        const numberpage = document.getElementById('numberpage');
        let html = "";
        for (let i = 0; i < Math.ceil(jsonObject.length / 2); i++) {
            html += `<button class="page" onclick="showPage(this)">${i}</button>`;
        }
        numberpage.innerHTML = html;
    };
    xhttp.send({show : show});
}


const Search = () => {
    const search = capitalizeWords(document.getElementById('searchinput').value);
    const select = document.getElementById('pet-select').value;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            
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
                        <img src="${content.path_photo}" alt="">
                        <div class="card-title">
                            <h3>${content.title}</h3>
                            <p>${content.highlight}</p>
                        </div>
                    </div>
                    
                    </div>
                    `;
                }
                    // <div class="video-content">
                    // <iframe src="https://www.youtube.com/embed/KpcbvgwfUwQ&ab" frameborder="0" allowfullscreen></iframe>
                    // </div>
                
                parentElement.innerHTML = html;
        }
            
            
        };
        xhttp.open('GET', `../../server/controller/auth/Fact.php?search=${search}&select=${select}&page=${Page}`, true);
        xhttp.send(JSON.stringify({search: search, select: select}));

}

const showAll = () => {
    const show = "all";
    const select = document.getElementById('pet-select').value;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
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
                        <img src="${content.path_photo}" alt="">
                        <div class="card-title">
                            <h3>${content.title}</h3>
                            <p>${content.highlight}</p>
                        </div>
                    </div>
                    
                    </div>
                    `;
                }
                {/* <div class="video-content">
                    <iframe src="https://www.youtube.com/embed/l970HoJ7g7o?si=61k4a2ioQf4YfpFF" frameborder="0" allowfullscreen></iframe>
                </div> */}
            parentElement.innerHTML = html;        

        }
    };  
    xhttp.open('GET', `../../server/controller/auth/Fact.php?show=${show}&Select=${select}&page=${Page}`, true);
    xhttp.send(JSON.stringify({show : show}));

}


const prevPage = () =>{
    Page = 1;
    showAll();
}

const nextPage = () =>{
    Page = 2;
    showAll();
}


function debounce(func, timeout = 500){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}


const searchDebounce = debounce(() => Search());