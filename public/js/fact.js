
function toggleVideo(card) {
    var content = card.querySelector('.video-content'); // Use card parameter to find .video-content within the clicked card
    // console.log(content)
    if (content && content.style.maxHeight) { // Check if content is not null
        content.style.maxHeight = null;
    } else if (content) { // Check if content is not null
        content.style.maxHeight = "50vw";
    }
}

let Page = 1;
let TotalPage;

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
    const pageNumber = "pageNumber";
    const search = document.getElementById('searchinput').value;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            let response = this.response;
            const startIndex = response.indexOf('[');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            
            const numberpage = document.getElementById('numberpage');
            TotalPage=Math.ceil(jsonObject.length / 2);
            let html = "";
            for (let i = 1; i <= Math.ceil(jsonObject.length / 2); i++) {
                if(i == 1){
                    html += `<button type='button' class="page" value=${i} id='selected' onclick='selectPage(); getPage(${i});' ">${i}</button>`;
                }else{
                    html += `<button type='button' class="page" value=${i} onclick='selectPage(); getPage(${i});' ">${i}</button>`;
                }
            }
            numberpage.innerHTML = html;
        }
    };
    xhttp.open('GET', `../../server/controller/auth/Fact.php?pageNumber=${pageNumber}&search=${search}`, true);
    xhttp.send();
}


// pagination();
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
            
            // console.log(jsonStr);


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
                    <div class="video-content">
                    <video src="${content.path_file}" controls></video>
                    </div>
                    </div>
                    `;
                }
                
                parentElement.innerHTML = html;
            }
            
            
            pagination();
        };
        xhttp.open('GET', `../../server/controller/auth/Fact.php?search=${search}&select=${select}&page=${Page}`, true);
        xhttp.send(JSON.stringify({search: search, select: select}));

}

const showAll = () => {
    const show = "all";
    const select = document.getElementById('pet-select').value;
    // console.log(Page);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            let response = this.response;
            const startIndex = response.indexOf('[');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            // console.log(jsonStr);
            
            
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
            <div class="video-content">
                    <video src="${content.path_file}" controls></video>
                    </div>
            </div>
            `;
        }
        {/* <div class="video-content">
        <iframe src="https://www.youtube.com/embed/l970HoJ7g7o?si=61k4a2ioQf4YfpFF" frameborder="0" allowfullscreen></iframe>
    </div> */}
            parentElement.innerHTML = html;        
            pagination();
        }
    };  
    xhttp.open('GET', `../../server/controller/auth/Fact.php?show=${show}&Select=${select}&page=${Page}`, true);
    xhttp.send();

}

const selectpagination = () => {
    const show = "all";
    const select = document.getElementById('pet-select').value;
    // console.log(Page);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            let response = this.response;
            const startIndex = response.indexOf('[');
            const jsonStr = response.substring(startIndex);
            const jsonObject = JSON.parse(jsonStr);
            // console.log(jsonStr);
            
            
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
            <div class="video-content">
                    <video src="${content.path_file}" controls></video>
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
    xhttp.send();

}


const prevPage = () =>{
    const search = document.getElementById('searchinput').value;
    if(Page>1){
        Page-=1
        if(search==''){
            selectpagination();
        }else{
            Search();
        }
    }
}

const nextPage = () =>{
    const search = document.getElementById('searchinput').value;
    if(Page<TotalPage){
        Page+=1
        // console.log(Page);
        // console.log("HAI");
        if(search==''){
            showAll();
        }else{
            Search();
        }
    }
}

function getPage(pa){
    Page = pa;
    // console.log(Page);
}


function debounce(func, timeout = 500){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

function selectPage (){
    const buttons = document.querySelectorAll('#numberpage button');
    // console.log(buttons);
    // Add click event listeners to each button
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove the 'selected' id from the currently selected button
            const currentlySelectedButton = document.querySelector('#selected');
            currentlySelectedButton.removeAttribute('id');

            // Add the 'selected' id to the clicked button
            button.id = 'selected';

            // Optionally, you can add a CSS class to style the selected button
            buttons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        });
    });
}


document.getElementById('numberpage').addEventListener('click',()=>{
    const search = document.getElementById('searchinput').value;
    if(search==''){
        console.log("HAI");
        selectpagination();
    }else{
        Search();
    }
})


const searchDebounce = debounce(() => Search());