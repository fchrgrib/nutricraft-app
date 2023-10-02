<?php

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
                                        path VARCHAR(225), type_content VARCHAR(225), created_at TIME, updated_at TIME)");

        if (!$create_table_file){
            die("failed to create table file: " . pg_last_error());
        }else{
            echo "<script>console.log('table file successfully created')</script>";
        }

        $create_table_user = pg_query($this->db, "CREATE TABLE IF NOT EXISTS 
                                      users(id SERIAL PRIMARY KEY, full_name VARCHAR(225), password VARCHAR(225),id_photo_profile SERIAL,
                                      phone_number VARCHAR(225), roles VARCHAR(10), email VARCHAR(225),
                                      created_at TIME, updated_at TIME,
                                      FOREIGN KEY (id_photo_profile) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                      ");
        if(!$create_table_user) {
            die("failed to create table user: " . pg_last_error());
        } else {
            echo "<script>console.log('table user successfully created')</script>";
        }
        $create_table_content = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        content(id SERIAL PRIMARY KEY, title VARCHAR(225), id_file SERIAL,
                                        body VARCHAR(5000),created_at TIME, updated_at TIME,
                                        FOREIGN KEY (id_file) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                        ");
        if(!$create_table_content) {
            die("failed to create table content: " . pg_last_error());
        } else {
            echo "<script>console.log('table content successfully created')</script>";
        }


        $create_table_ingredients = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                      ingredients(id SERIAL PRIMARY KEY, ingredient VARCHAR(225), description VARCHAR(225))
                                      ");

        if (!$create_table_ingredients){
            die("failed to create table ingredients: " . pg_last_error());
        } else {
            echo "<script>console.log('table ingredients successfully created')</script>";
        }

        $create_table_meals = pg_query($this->db,"CREATE TABLE IF NOT EXISTS
                                      meals(id SERIAL PRIMARY KEY, title VARCHAR(225), highlight VARCHAR(1000),
                                      description VARCHAR(5000), type VARCHAR(225), id_ingredients SERIAL, created_at TIME, updated_at TIME,
                                      FOREIGN KEY (id_ingredients) REFERENCES ingredients(id) ON UPDATE CASCADE ON DELETE SET NULL)
        ");

        if (!$create_table_meals){
            die("failed to create table meals: " . pg_last_error());
        } else {
            echo "<script>console.log('table meals successfully created')</script>";
        }


        $check_file = pg_query($this->db, "SELECT * FROM file WHERE name = 'default' AND type_content = 'photo'");
        if (pg_num_rows($check_file) == 0){
            $curr = date('Y-m-d H:i:s');
            $insert_data = pg_query($this->db, "INSERT INTO file VALUES(DEFAULT,'default','../../assets/user/default/default.svg','photo','$curr','$curr')");
            if (!$insert_data){
                die("failed to init photo profile");
            }else{
                echo "<script>console.log('successfully init photo profile')</script>";
            }
        }

        //Check if admin exist
        $check_admin = pg_query($this->db, "SELECT * FROM users WHERE roles = 'admin'");
        if(pg_num_rows($check_admin) == 0){
            echo "<script>console.log('admin not exist')</script>";

            //Create admin if not exist
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

