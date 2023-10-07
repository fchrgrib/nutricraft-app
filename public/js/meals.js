function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#BA540B', controlSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromSlider.value = from;
    }
}
    
function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#BA540B', controlSlider);
    setToggleAccessible(toInput);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
    }
}

function controlFromSlider(fromSlider, toSlider, fromInput) {
  const [from, to] = getParsed(fromSlider, toSlider);
  fillSlider(fromSlider, toSlider, '#C6C6C6', '#BA540B', toSlider);
  if (from > to) {
    fromSlider.value = to;
    fromInput.value = to;
  } else {
    fromInput.value = from;
  }
}

function controlToSlider(fromSlider, toSlider, toInput) {
  const [from, to] = getParsed(fromSlider, toSlider);
  fillSlider(fromSlider, toSlider, '#C6C6C6', '#BA540B', toSlider);
  setToggleAccessible(toSlider);
  if (from <= to) {
    toSlider.value = to;
    toInput.value = to;
  } else {
    toInput.value = from;
    toSlider.value = from;
  }
}

function getParsed(currentFrom, currentTo) {
  const from = parseInt(currentFrom.value, 10);
  const to = parseInt(currentTo.value, 10);
  return [from, to];
}

function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
    const rangeDistance = to.max-to.min;
    const fromPosition = from.value - to.min;
    const toPosition = to.value - to.min;
    controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
      ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
      ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} 100%)`;
}

function setToggleAccessible(currentTarget) {
  const toSlider = document.querySelector('#toSlider');
  if (Number(currentTarget.value) <= 0 ) {
    toSlider.style.zIndex = 2;
  } else {
    toSlider.style.zIndex = 0;
  }
}

const fromSlider = document.querySelector('#fromSlider');
const toSlider = document.querySelector('#toSlider');
const fromInput = document.querySelector('#fromInput');
const toInput = document.querySelector('#toInput');
fillSlider(fromSlider, toSlider, '#C6C6C6', '#BA540B', toSlider);
setToggleAccessible(toSlider);

fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);


// const mealCard = document.getElementById("meal-card");

// // Add a click event listener to the cardmeal div
// mealCard.addEventListener("click", function() {
//     // Handle the click event here
//     // For example, you can perform an action when the card is clicked
//     window.location.href = "/?detailmeal";
// });

// Get the button and sidebar elements
const toggleButton = document.getElementById('toggleSidebar');
const filtersort = document.querySelector('.filtersort');

// Function to toggle the sidebar
toggleButton.addEventListener('click', () => {
  // Get the current value of the sidebar's left property
  const currentLeft = parseInt(window.getComputedStyle(filtersort).getPropertyValue('left'));
  
  // Check if the sidebar is currently hidden or partially hidden
  if (currentLeft < 0) {
      filtersort.style.left = '0px'; // Show the filtersort
  } else {
      filtersort.style.left = '-300px'; // Hide the filtersort
  }
});

const closeButton = document.getElementById('closeSidebar');
closeButton.addEventListener('click', () => {
  filtersort.style.left = '-300px';
});




const type = () =>{
  const typeMeals = document.querySelectorAll('#selected')[0].textContent;
  const lowRange = fromInput.value;
  const highRange = toInput.value;
  const sort = document.getElementById('pet-select').value;
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4){
      let response = this.response;
      // console.log(response);
      const startIndex = response.indexOf('[');
      const jsonStr = response.substring(startIndex);
      const jsonObject = JSON.parse(jsonStr);
      console.log(jsonObject);
  
      const parentElement = document.getElementById("mealsContent");
      let http = '';
      for (let i = 0; i < jsonObject.length; i++) {
      const content = jsonObject[i];
      http+=`
      <div class='cardmeal' id='meal-card'>
      <div class='cardmealimage'>
      <img src="${content['path_photo']}" alt=''>
      </div>
      <a href="/?detailmeal&id=${content['id']}">
          <div class='card-meal__content'>
              <div class='card-meal__content__title'>
                  <h3>${content['title']}</h3>
              </div>
              <div class='card-meal__content__description'>
                  <p>${content['highlight']}</p>
              </div>
              <div class='card-meal__content__calories'>
                  <p>Calories: ${content['calorie']}</p>
              </div>
          </div>
          </a>
        </div>`;
      }
  
      parentElement.innerHTML = http;
    }
  };
  xhttp.open('GET', `../../server/controller/auth/Meals.php?typeMeals=${typeMeals}&lowRange=${lowRange}&highRange=${highRange}&sort=${sort}`, true);
  xhttp.send();
}

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
  xhttp.open('GET', `../../server/controller/auth/Meals.php?pageNumber=${pageNumber}&search=${search}`, true);
  xhttp.send();
}

const search = () =>{
  const typeMeals = document.querySelectorAll('#selected')[0].textContent;
  const lowRange = fromInput.value;
  const highRange = toInput.value;
  const sort = document.getElementById('pet-select').value;
  const search = document.getElementById('searchinput').value;
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4){
      let response = this.response;
      // console.log(response);
      const startIndex = response.indexOf('[');
      const jsonStr = response.substring(startIndex);
      const jsonObject = JSON.parse(jsonStr);
      console.log(jsonObject);
  
      const parentElement = document.getElementById("mealsContent");
      let http = '';
      for (let i = 0; i < jsonObject.length; i++) {
      const content = jsonObject[i];
      http+=`
      <div class='cardmeal' id='meal-card'>
      <div class='cardmealimage'>
      <img src="${content['path_photo']}" alt=''>
      </div>
      <a href="/?detailmeal&id=${content['id']}">
          <div class='card-meal__content'>
              <div class='card-meal__content__title'>
                  <h3>${content['title']}</h3>
              </div>
              <div class='card-meal__content__description'>
                  <p>${content['highlight']}</p>
              </div>
              <div class='card-meal__content__calories'>
                  <p>Calories: ${content['calorie']}</p>
              </div>
          </div>
          </a>
        </div>`;
      }
  
      parentElement.innerHTML = http;
    }
  };
  xhttp.open('GET', `../../server/controller/auth/Meals.php?typeMeals=${typeMeals}&lowRange=${lowRange}&highRange=${highRange}&sort=${sort}&search=${search}`, true);
  xhttp.send();
}


document.getElementById('pet-select').addEventListener('change', function(){
  if(document.getElementById('searchinput').value == ""){
    type();
  }else{
    search();
  }
});

document.getElementById('toInput').addEventListener('change', function(){
  if(document.getElementById('searchinput').value == ""){
    type();
  }else{
    search();
  }
});

document.getElementById('fromInput').addEventListener('change', function(){
  if(document.getElementById('searchinput').value == ""){
    type();
  }else{
    search();
  }
});

function debounce(func, timeout = 500){
  let timer;
  return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
  };
}


const searchDebounce = debounce(() => search());