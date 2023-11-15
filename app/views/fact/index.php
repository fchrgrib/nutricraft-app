<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/fact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="../../../public/js/fact.js"></script>
    <script>window.onload = function() {showAll();};</script>
    <title>NutriCraft</title>
</head>
<body>
    <div>
        <div class="content">
            <h1>NutriFacts</h1>
            <div class="searchsort">
                <div class="searchcontainer">
                    <i class="fas fa-search"></i>
                    <input class="searchinput" id="searchinput" type="text" placeholder="Search" onkeyup=searchDebounce()>
                </div>
                <!-- <div class="sortcontainer">
                    <img src="../../../assets/sort.png" alt="">
                    <select name="sortby" id="pet-select" onclick=Search()>
                        <option value="Alphabet" class="alpha">Alphabet</option>
                        <option value="Newest">Newest</option>
                        <option value="Oldest">Oldest</option>
                    </select>
                </div> -->
            </div>
            <div class="buttons">
                <button type="button" class="all" id="selected" onclick=Search()>All</button>
                <button type="button" class="subscribed" onclick=Search()>Subscribed</button>
            </div>
            <script>
                const buttons = document.querySelectorAll('.buttons button');
                console.log(buttons);
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const currentlySelectedButton = document.querySelector('#selected');
                        currentlySelectedButton.removeAttribute('id');
                        button.id = 'selected';
                        buttons.forEach(btn => btn.classList.remove('selected'));
                        button.classList.add('selected');
                    });
                });
            </script>
            <div id="factContent" class="factcontent">
                <a href="/?detailfact">
                <div class="factcard">
                    <img src="../../../assets/thumbnail.png" alt="">
                        <div class="facttext">
                            <h2>judul</h2>
                            <p>lorem ipsum dolor sit amet lorem ipsum </p>
                            <h4>Author</h4>
                        </div>
                    </div>
                </a>
                <a href="/?detailfact">
                <div class="factcard">
                    <img src="../../../assets/thumbnail.png" alt="">
                        <div class="facttext">
                            <h2>judul</h2>
                            <p>lorem ipsum dolor sit amet lorem ipsum </p>
                            <h4>Author</h4>
                        </div>
                    </div>
                </a>
                <a href="/?detailfact">
                <div class="factcard">
                    <img src="../../../assets/thumbnail.png" alt="">
                        <div class="facttext">
                            <h2>judul</h2>
                            <p>lorem ipsum dolor sit amet lorem ipsum </p>
                            <h4>Author</h4>
                        </div>
                    </div>
                </a>
            </div>
            <!-- <div id="pagination" class="pagination">
                <button class="prev" onclick=prevPage()>&laquo;</button>
                <div id="numberpage" class="buttons">
                </div>
                
                <button class="next" onclick=nextPage() >&raquo;</button>
        </div> -->
    </div>
</body>
</html>