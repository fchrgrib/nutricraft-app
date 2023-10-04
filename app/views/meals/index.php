<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/meals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="../../../public/js/meals.js"></script>
    <title>NutriCraft</title>
</head>

<body>
    <div>
        <div class="content">
            <div class="header">
                <h1>Meals</h1>
                <div class="filtersearch">
                    <button type="button" class="filterbutton" id="toggleSidebar">
                        <img src="../../../assets/filter.png" alt="">
                        <h3>Filter</h3>
                    </button>
                    <div class="searchcontainer">
                        <i class="fas fa-search"></i>
                        <input class="searchinput" type="text" placeholder="Search">
                    </div>
                </div>
                <div class="buttons" onclick=type()>
                    <button type="button" class="all" id="selected">All</button>
                    <button type="button" class="breakfast">Breakfast</button>
                    <button type="button" class="lunch">Lunch</button>
                    <button type="button" class="dinner">Dinner</button>
                </div>
                <script>
                // Get all the buttons
                const buttons = document.querySelectorAll('.buttons button');

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
                </script>
            </div>
            <div id="mealsContent" class="content"></div>

                
        </div>
    </div>
    <div class="filtersort">
        <div class="headerclose">
            <button type="button" class="close" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
            <h1>Filter & Sort</h1>
        </div>
        <div class="sort">
            <div class="sortheader">
                <img src="../../../assets/sort.png" alt="">
                <h3>Sort</h3>
            </div>
            <div class="sortmenus">
                <div class="selectcontainer">
                    <label for="sorttitle">Sort By</label>
                </div>
                <select name="sortby" id="pet-select" onclick=type()>
                    <option value="Alphabet" class="alpha">Alphabet</option>
                    <option value="Calories: low to high">Calories: low to high</option>
                    <option value="Calories: high to low">Calories: high to low</option>
                </select>
            </div>
        </div>
        <div class="filter">
            <div class="filterheader">
                <img src="../../../assets/filter.png" alt="">
                <h3>Filter</h3>
            </div>
            <div class="range_container" >
                <div class="range_container__title">Calories</div>
                <div class="sliders_control" >
                    <input id="fromSlider" type="range" value="10" min="0" max="1600" onclick=type()/>
                    <input id="toSlider" type="range" value="10000" min="0" max="1600" onclick=type()/>
                </div>
                <div class="form_control">
                    <div class="form_control_container">
                        <div class="form_control_container__time">Min</div>
                        <input class="form_control_container__time__input" type="number" id="fromInput" value="10"
                            min="0" max="1600" onclick=type()/>
                    </div>
                    <div class="form_control_container">
                        <div class="form_control_container__time">Max</div>
                        <input class="form_control_container__time__input" type="number" id="toInput" value="1600"
                            min="0" max="1600" onclick=type()/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>