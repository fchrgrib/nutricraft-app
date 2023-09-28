<?php


namespace data;
// require_once ('db/Database.php');

use Database;

class Users
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getUsers(){
        return $this->db;
    }

    public function Insert($name, $email, $phoneNumber, $password){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');
        $rolessss = 'user';

        $insert_data = pg_query($conn, "INSERT INTO 
                                users(full_name,password,id_photo_profile,phone_number,roles,email,created_at)
                                VALUES('$name','$password',1,'$phoneNumber','$rolessss','$email','$curr')");

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert user')</script>";

        $this->db->Disconnect();
    }

    // public function Update($id, $name, $email, $phoneNumber){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();
    //     $curr = date('Y-m-d H:i:s');

    //     $update_data = pg_query($conn, "UPDATE users
    //                             SET full_name = $name, phone_number = $phoneNumber, email = $email
    //                             WHERE id = $id");

    //     if (!$update_data) die("failed to update values: ".pg_last_error());

    //     echo "<script>console.log('successfully update users')</script>";

    //     $this->db->Disconnect();
    // }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data = pg_query($conn, "DELETE FROM users WHERE id = $id");

        if (!$delete_data) die("failed to delete values users: ".pg_last_error());

        echo "<script>console.log('successfully delete users')</script>";

        $this->db->Disconnect();
    }

    // public function getUnamebyId($id){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT full_name FROM users WHERE id = $id");

    //     if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

    // public function getIdbyUname($uname){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT id FROM users WHERE full_name = '$uname'");

    //     if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

    // public function getAllUserNames(){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT fullName FROM users");

    //     if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

    // public function getAllUserEmails(){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT email FROM users");

    //     if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

    // public function isEmailExists($email){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT email FROM users WHERE email = '$email'");

    //     // if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

    // public function isUnameExists($uname){
    //     $this->db->Connect();
    //     $conn = $this->db->getDb();

    //     $get_data = pg_query($conn, "SELECT full_name FROM users WHERE full_name = '$uname'");

    //     // if (!$get_data) die("failed to get values users: ".pg_last_error());

    //     $this->db->Disconnect();

    //     return $get_data;
    // }

}