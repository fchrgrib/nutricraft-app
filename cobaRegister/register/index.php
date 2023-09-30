<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../cobaRegister/auth/Register.php" method="POST">
<!-- <form action="../../server/handler/validation/Validation.php" method="POST"> -->
  <div class="container">
    <h1>Register</h1>
    <hr>

    <label for="uname"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="uname" id="uname" required><br>
    <!-- <?php if (isset($errors["name"])) { echo "<span class='error'>" . $errors["name"] . "</span>"; } ?> -->
    
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required><br>
    <!-- <?php if (isset($errors["email"])) { echo "<span class='error'>" . $errors["email"] . "</span>"; } ?> -->
    
    <label for="phoneNumber"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Phone Number" name="phoneNumber" id="phoneNumber" required><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required><br>

    <!-- <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required><br> -->
    <hr>

    <button type="submit" class="registerbtn">Register</button>
  </div>

</form>
</body>
</html>