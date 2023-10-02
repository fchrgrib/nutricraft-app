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
// Check if the "user" cookie is set
if (isset($_COOKIE['user'])) {
    // Get the "user" cookie value
    $userCookie = $_COOKIE['user'];

    // Attempt to decode the JSON data from the cookie
    $userData = json_decode($userCookie);

    // Check if the JSON decoding was successful and if it's an array
    if ($userData !== null && is_array($userData) && count($userData) > 0) {
        // Access the "full_name" field from the decoded JSON
        $fullName = $userData[0]->full_name;

        // Display the full name
        echo '<span>Welcome, ' . $fullName . '</span>
        <img s';
    } else {
        // Handle the case where the cookie doesn't contain valid JSON or is empty
        echo '<span>Invalid user data</span>';
    }
} else {
    // Handle the case where the "user" cookie is not set
    echo '<span>User not logged in</span>';
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
