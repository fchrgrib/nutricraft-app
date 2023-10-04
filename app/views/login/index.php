<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login: account NutriCraft</title>
</head>
<body>
    <div class="back">
        <div class="logincontainer">
            <div class="header">
                <img src="../../../assets/NutriCraft.svg" alt="">
                <h2>Login</h2>
                <h5>Don't have an account? <a href="/?register">Register</a></h5>
            </div>
            <div class="forms">
            <form action="../../../server/controller/auth/Login.php" method="POST">
            <h4>Email</h4>
            <div class="emailcontainer">
                <i class="fas fa-envelope"></i>
                <input class="emailinput" type="text" placeholder="Email" name="emailLog" required>
            </div>
            <h4>Password</h4>
            <div class="passwordcontainer">
                <i class="fas fa-lock"></i>
                <input class="passwordinput" type="password" placeholder="Password" name="passLog" required>
            </div>
        </div> 
        <button type="submit" class="login">Login</button>
        </form>
    </div>
</body>
</html>