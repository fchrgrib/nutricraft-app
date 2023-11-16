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
                <a href="/content">
                    <button type="button" class="contentnav">Content</button>
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
        $picture = $userData[0]->photo_profile;
        $roles = $userData[0]->roles;

        // Display the full name
        echo '<div class="dropdown">
                <button class="dropbtn">' . $fullName .'</button>
                <div class="dropdown-content">
                    <a href="/?profile">Profile</a>';
    
    // Check if the user has an "admin" role
    if ($roles === "admin") {
        echo '<a href="/?cms">CMS</a>'; // Add the CMS link for admin users
    }
    
    echo '<a href="/home" id="logoutbtn">Logout</a>
                </div>
            </div>
            <img id="profile" src="' . $picture . '" alt="">';
    } else {
        // Handle the case where the cookie doesn't contain valid JSON or is empty
        echo '<span>Invalid user data</span>';
    }
} else {
    // Handle the case where the "user" cookie is not set
    echo '<a href ="/?login"><button type="button" class="login">Login</button></a>';
}
?>


            </div>
        </div>
        <div id="mobile-menu" class="hidden">
            <!-- Add your mobile menu items here -->
            <a href="/home">Home</a>
            <a href="/meals">Meals</a>
            <a href="/fact">Fact</a>
            <a href="/content">Content</a>
        </div>
    </div>
</body>
</html>
