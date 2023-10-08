<?php
require_once "../../../../server/handler/data/Meal.php";
require_once "../../../../server/handler/data/Content.php";
require_once "../../../../server/handler/data/File.php";
use data\File;
use data\Meal;
use data\Content;

if (isset($_POST['confirmButton'])){
    $value = $_POST['confirmationId'];
    $split = explode(";",$value);
    $id = $split[1];
    if ($split[0]=="meals") {
        $meals = new Meal();
        $file = new File();

        $get_meal = $meals->FindById($id)[0];
        $meals->Delete($id);
        $file->Delete($get_meal['id_photo']);
    }
    if ($split[0]=="fact"){
        $fact = new Content();
        $file = new File();

        $get_fact = $fact->FindById($id)[0];
        $fact->Delete($id);
        $file->Delete($get_fact['id_file']);
        $file->Delete($get_fact['id_photo']);
    }

    echo "<script>window.location.href='/?cms'</script>";
}
if (isset($_POST['cancelButton'])){
    echo "<script>window.location.href='/?cms'</script>";
}
