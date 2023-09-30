<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Register: create account NutriCraft</title>
</head>
<body>
    <div class="back">
        <div class="registercontainer">
            <div class="header">
                <img src="../../../assets/NutriCraft.svg" alt="">
                <h2>Register</h2>
                <h5>Already have an account? <a href="/?login">Login</a></h5>
            </div>
            <div class="forms">
            <form action="../../../api/auth/Register.php" method="POST">
            <h4>Name</h4>
            <div class="namecontainer">
                <i class="fas fa-user"></i>
                <input class="nameinput" type="text" placeholder="Name" name="uname" required>
            </div>
            <h4>Email</h4>
            <div class="emailcontainer">
                <i class="fas fa-envelope"></i>
                <input class="emailinput" type="text" placeholder="Email" name="email"required>
            </div>
            <h4>Phone Number</h4>
            <div class="phonenumbercontainer">
                <i class="fas fa-phone"></i>
                <input class="phonenumberinput" type="text" placeholder="Phone Number" name="phoneNumber" required>
            </div>
            <h4>Password</h4>
            <div class="passwordcontainer">
                <i class="fas fa-lock"></i>
                <input class="passwordinput" type="password" placeholder="Password" name="psw" required>
            </div>
            <button type="submit" class="register">Register</button>
            </form>
            </div>
        </div> 
    </div>
</body>
</html>