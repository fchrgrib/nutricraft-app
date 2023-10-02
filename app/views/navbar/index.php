<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
    <script defer src="../../../public/js/navbar.js"></script>
    <title>NutriCraft</title>
</head>
<body>
    <div>
        <div id="navbar">
            <div id="buttons">
                <button class="hamburger" onclick="toggleMenu()">&#9776;</button>
                <img id="logo" src="../../../assets/NutriCraft.svg" alt="">
                <a href="/home">
                    <button type="button" class="home">Home</button>
                </a>
                <a href="/meals">
                    <button type="button" class="meals">Meals</button>
                </a>
                <a href="/fact">
                    <button type="button" class="fact">Fact</button>
                </a>
            </div>
            <div id="login">
                <?php
                    if (isset($_SESSION['email'])) {
                        echo '<a href="/logout">
                                <button type="button" class="logout">Logout</button>
                            </a>';
                    } else {
                        echo '<a href="/?login">
                                    <button type="button" class="login">Login</button>
                                </a>';
                    }
                ?>
            </div>
        </div>
        <div id="mobile-menu" class="hidden">
            <!-- Add your mobile menu items here -->
            <a href="/home">Home</a>
            <a href="/meals">Meals</a>
            <a href="/fact">Fact</a>
        </div>
    </div>
</body>
</html>
