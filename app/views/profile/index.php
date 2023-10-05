<?php
if(isset($_COOKIE['user'])){
    $userCookie = $_COOKIE['user'];
    $userData = json_decode($userCookie);
    if ($userData !== null && is_array($userData) && count($userData) > 0) {
        $id = $userData[0]->id;
        $fullName = $userData[0]->full_name;
        $email = $userData[0]->email;
        $phone = $userData[0]->phone_number;
        $photo = $userData[0]->photo_profile;
    }
}

echo "<script>console.log('$id, $fullName, $email, $phone')</script>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="NutriCraft" content="width=device-width, initial-scale=1.0">
    <!-- include css -->
    <link rel="stylesheet" href="../../../public/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- include js -->
    <script src="../../../public/js/profile.js"></script>
    <title>NutriCraft</title>
</head>
<body>
   
    <form action="../../../server/controller/auth/Profile.php" method="POST" enctype="multipart/form-data">
        <div class="profileContainer">
            <div class="boxKiri">
                <div class="photoContainer">
                    <img src=<?php echo $photo?> alt="photoProfile" class="photoProfile" id="photoProfile">
                    <div class="editPhotoButton">
                        <label for="file" class="fileLabel">Choose a Photo</label>
                        <input type="file" name="file" id="file" class="file" accept="image/*" onchange="updatePhoto()">
                    </div>
                </div>
            </div>
            <div class="boxKanan">
                <p class="labelProfile">Name</p>
                <div>
                    <input type="text" placeholder=<?php echo $fullName ?> class="textField" id="editNama" name="fullName" disabled>
                    <i class="fas fa-edit editIcon" onclick=enableName() ></i>
                </div>
                <hr>
                <p class="labelProfile">Email</p>
                <div>
                    <input type="email" placeholder=<?php echo $email ?> class="textField" id="editEmail" name="email" disabled>
                    <i class="fas fa-edit editIcon" onclick=enableEmail() ></i>
                </div>
                <hr>
                <p class="labelProfile">Phone Number</p>
                <div>
                    <input type="text" placeholder=<?php echo $phone ?> class="textField" id="editPhone" name="phone" disabled>
                    <i class="fas fa-edit editIcon" onclick=enablePhoneNumber()></i>
                </div>
                <hr>
                <p class="labelProfile">Password</p>
                <div>
                    <input type="password" placeholder="" class="textField" id="editPassword"  name="password" disabled>
                    <i class="fas fa-edit editIcon" onclick= enablePassword()></i>
                </div>
                <hr>
                <button type="submit" class="submitButton" name="submit">Save Change</button>
            </div>
        </div>
    </form>
</body>
</html>