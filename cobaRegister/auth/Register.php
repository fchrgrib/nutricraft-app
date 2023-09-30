
<?php 

use data\Users;


// require_once ('../../server/db/Database.php');

// echo "Hello World<br>";
// session_start();
require_once ('../../server/handler/data/Users.php');
require_once ('../../server/db/Database.php');
require_once ('../../server/handler/validation/Validation.php');
$user = new Users();


//INI HARUSNYA MASUK KE VALIDATION DI SERVER SIDE
// $userName = $user->isUnameExists($_POST['uname']);
// if ($userName == null) {
//     // echo "<script>console.log('siap register')</script>";
// } else {
//     // echo "<script>console.log('uname ada')</script>";
// }

// $email = $user->isEmailExists($_POST['email']);
//     if ($email == null) {
//         // echo "<script>console.log('siap register')</script>";
//     } else {
//         // echo "<script>console.log('email ada')</script>";
//     }


if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['email']) && isset($_POST['phoneNumber'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    // echo "$username,  $password,  $email, $phoneNumber";
    $user->Insert($username, $email, $phoneNumber, $password);
    echo "Sukses";
}

      
?>