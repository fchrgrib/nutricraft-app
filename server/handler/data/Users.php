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

    public function Insert($name, $email, $phoneNumber, $password, $roles){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query($conn, "INSERT INTO 
                                users(full_name,password,id_photo_profile,phone_number,roles,email,created_at)
                                VALUES('$name','$password',1,'$phoneNumber','$roles','$email','$curr')");

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert user')</script>";

        $this->db->Disconnect();
    }

    public function UpdateUsers($id, $name, $email, $phoneNumber){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query($conn, "UPDATE users
                                SET full_name = '$name', phone_number = '$phoneNumber', id_photo_profile='$id', email = '$email', updated_at = '$curr'
                                WHERE id = $id");

        if (!$update_data) die("failed to update values: ".pg_last_error());

        echo "<script>console.log('successfully update users')</script>";

        $this->db->Disconnect();
    }
    public function UpdateWithPassword($id, $name, $email, $phoneNumber, $password){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query($conn, "UPDATE users
                                SET full_name = '$name', phone_number = '$phoneNumber', email = '$email', id_photo_profile='$id', password='$password' ,updated_at = '$curr'
                                WHERE id = $id");

        if (!$update_data) die("failed to update values: ".pg_last_error());

        echo "<script>console.log('successfully update users')</script>";

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data = pg_query($conn, "DELETE FROM users WHERE id = $id");

        if (!$delete_data) die("failed to delete values users: ".pg_last_error());

        echo "<script>console.log('successfully delete users')</script>";

        $this->db->Disconnect();
    }

    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM users");
        $result = array();
        while ($row = pg_fetch_assoc($exec)) {
            $result[] = array(
                'id' => $row['id'],
                'full_name' => $row['full_name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'roles' => $row['roles'],
                'created_at' => $row['created_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindById($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT
                                u.id as user_id, u.full_name as full_name, u.email as email,
                                u.phone_number as phone_number, u.roles as roles, f.path as photo_profile, u.created_at as created_at
                                FROM users u JOIN file f ON f.id = u.id_photo_profile WHERE u.id = $1 ORDER BY u.created_at", array($id));
        $result = array();
        while ($row = pg_fetch_assoc($exec)) {
            $result[] = array(
                'id' => $row['user_id'],
                'full_name' => $row['full_name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'roles' => $row['roles'],
                'photo_profile' =>$row['photo_profile'],
                'created_at' => $row['created_at']
            );
        }
        $this->db->Disconnect();
        return $result;
    }

    

    public function FindIdByEmail($email){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT id FROM users WHERE email = $1 ORDER BY created_at", array($email));
        $result = pg_fetch_assoc($exec);

        $this->db->Disconnect();

        return $result['id'];
    }

    public function FindRoleByEmail($email){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT roles FROM users WHERE email = $1 ORDER BY created_at", array($email));
        $result = pg_fetch_assoc($exec);

        $this->db->Disconnect();

        return $result['roles'];
    }

    public function FindUnamebyId($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT full_name FROM users WHERE id = $1 ORDER BY created_at", array($id));
        $result = array();
        while ($row = pg_fetch_assoc($exec)) {
            $result[] = array(
                'full_name' => $row['full_name'],
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function Login($email, $password){
        $this->db->Connect();
        $conn = $this->db->getDb();
        echo "<script>console.log('$email $password')</script>";

        $exec = pg_query_params($conn, "SELECT * FROM users WHERE email = $1 AND password = $2", array($email, $password));
        if(pg_num_rows($exec) > 0){
            $this->db->Disconnect();
            return true;
        }
        $this->db->Disconnect();
        return false;
    }


    public function isEmailExists($email){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $get_data = pg_query($conn, "SELECT email FROM users WHERE email = '$email'");

        if(pg_num_rows($get_data) > 0){
            $this->db->Disconnect();
            return true;
        }
        
        $this->db->Disconnect();
        echo "<script>console.log(false)</script>";
        return false;
    }

    public function isPhoneNumberExists($phoneNumber){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $get_data = pg_query($conn, "SELECT phone_number FROM users WHERE phone_number = '$phoneNumber'");

        if(pg_num_rows($get_data) > 0){
            $this->db->Disconnect();
            return true;
        }
        
        $this->db->Disconnect();
        echo "<script>console.log(false)</script>";
        return false;
    }


}