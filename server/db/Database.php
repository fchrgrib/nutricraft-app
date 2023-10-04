<?php


require_once (__DIR__."/../utils/Utils.php");

class Database
{
    public $db;

    public function getDb()
    {
        return $this->db;
    }

    public function Connect(){
        $dbHost = $_ENV["DB_HOST"];
        $dbUser = $_ENV["DB_USER"];
        $dbPassword = $_ENV["DB_PASSWORD"];
        $dbName =  $_ENV["DB_NAME"];
        $dbPort = $_ENV["DB_PORT"];


        $this->db = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword");

        if (!$this->db) die("Connection Failed: ". pg_last_error());

        $create_table_file = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        file(id SERIAL PRIMARY KEY, name VARCHAR(225),
                                        path VARCHAR(225), type_content VARCHAR(225), created_at TIMESTAMP, updated_at TIMESTAMP)");

        if (!$create_table_file){
            die("failed to create table file: " . pg_last_error());
        }else{
            echo "<script>console.log('table file successfully created')</script>";
        }

        $create_table_user = pg_query($this->db, "CREATE TABLE IF NOT EXISTS 
                                      users(id SERIAL PRIMARY KEY, full_name VARCHAR(225), password VARCHAR(225),id_photo_profile SERIAL,
                                      phone_number VARCHAR(225), roles VARCHAR(10), email VARCHAR(225),
                                      created_at TIMESTAMP, updated_at TIMESTAMP,
                                      FOREIGN KEY (id_photo_profile) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                      ");
        if(!$create_table_user) {
            die("failed to create table user: " . pg_last_error());
        } else {
            echo "<script>console.log('table user successfully created')</script>";
        }
        $create_table_content = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        content(id SERIAL PRIMARY KEY, title VARCHAR(225), id_file SERIAL, id_photo_highlight SERIAL,
                                        body VARCHAR(5000),highlight VARCHAR(2000),created_at TIMESTAMP, updated_at TIMESTAMP,
                                        FOREIGN KEY (id_file) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE,
                                        FOREIGN KEY (id_photo_highlight) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                        ");
        if(!$create_table_content) {
            die("failed to create table content: " . pg_last_error());
        } else {
            echo "<script>console.log('table content successfully created')</script>";
        }



        $create_table_meals = pg_query($this->db,"CREATE TABLE IF NOT EXISTS
                                      meals(id SERIAL PRIMARY KEY, title VARCHAR(225), highlight VARCHAR(1000),
                                      description VARCHAR(5000), type VARCHAR(225),calorie int, created_at TIMESTAMP, updated_at TIMESTAMP)
        ");

        if (!$create_table_meals){
            die("failed to create table meals: " . pg_last_error());
        } else {
            echo "<script>console.log('table meals successfully created')</script>";
        }

        $create_table_ingredients = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                      ingredients(id SERIAL PRIMARY KEY, ingredient VARCHAR(225), description VARCHAR(225), id_meals SERIAL,
                                      FOREIGN KEY (id_meals) REFERENCES meals(id) ON UPDATE CASCADE ON DELETE CASCADE)
                                      ");

        if (!$create_table_ingredients){
            die("failed to create table ingredients: " . pg_last_error());
        } else {
            echo "<script>console.log('table ingredients successfully created')</script>";
        }

        $create_table_nutrition = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        nutrition(id SERIAL PRIMARY KEY, calorie VARCHAR(225), carbo VARCHAR(225), protein VARCHAR(225), fat VARCHAR(225), sugar VARCHAR(225), id_meals SERIAL,
                                        FOREIGN KEY (id_meals) REFERENCES meals(id) ON UPDATE CASCADE ON DELETE CASCADE)
                                        ");

        if (!$create_table_nutrition){
            die("failed to create table nutrition: " . pg_last_error());
        } else {
            echo "<script>console.log('table nutrition successfully created')</script>";
        }

        $is_file = pg_query($this->db, "SELECT * FROM file");
        $is_content = pg_query($this->db, "SELECT * FROM content");
        $is_meals = pg_query($this->db, "SELECT * FROM meals");
        $is_ingredients = pg_query($this->db, "SELECT * FROM ingredients");
        $is_nutrition = pg_query($this->db, "SELECT * FROM nutrition");
        $is_admin = pg_query($this->db, "SELECT * FROM users WHERE roles = 'admin'");


        check_init_database($this->db,$is_file,$is_content,$is_meals,$is_ingredients,$is_nutrition);


        if(pg_num_rows($is_admin) == 0){
            echo "<script>console.log('admin not exist')</script>";

            $curr = date('Y-m-d H:i:s');
            $insert_data = pg_query($this->db, "INSERT INTO 
                                    users(full_name,password,id_photo_profile,phone_number,roles,email,created_at)
                                    VALUES('admin','123',1,'111','admin','admin@gmail.com','$curr')");
    
            if (!$insert_data){
                die("failed to insert admin: ".pg_last_error());
            } else{
                echo "<script>console.log('successfully insert user')</script>";
            }
        }else{
            echo "<script>console.log('admin exist')</script>";
        }



    }

    public function Disconnect(){
        pg_close($this->db);
    }
}

