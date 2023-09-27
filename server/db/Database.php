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

        $create_table_photo = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        file(id SERIAL PRIMARY KEY, name VARCHAR(225),
                                        path VARCHAR(225), url VARCHAR(225), type_content VARCHAR(225))");

        if (!$create_table_photo){
            die("failed to create table file: " . pg_last_error());
        }else{
            echo "<script>console.log('table file successfully created')</script>";
        }

        $create_table_user = pg_query($this->db, "CREATE TABLE IF NOT EXISTS 
                                      users(id SERIAL PRIMARY KEY, full_name VARCHAR(225),id_photo_profile SERIAL,
                                      phone_number VARCHAR(225), roles VARCHAR(10), email VARCHAR(225),
                                      createdAt TIME,
                                      FOREIGN KEY (id_photo_profile) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                      ");
        if(!$create_table_user) {
            die("failed to create table user: " . pg_last_error());
        } else {
            echo "<script>console.log('table user successfully created')</script>";
        }
        $create_table_content = pg_query($this->db, "CREATE TABLE IF NOT EXISTS
                                        content(id SERIAL PRIMARY KEY, title VARCHAR(225), id_file SERIAL,
                                        body VARCHAR(5000),createdAt TIME, updateAt TIME,
                                        FOREIGN KEY (id_file) REFERENCES file(id) ON DELETE SET NULL ON UPDATE CASCADE)
                                        ");
        if(!$create_table_content) {
            die("failed to create table content: " . pg_last_error());
        } else {
            echo "<script>console.log('table content successfully created')</script>";
        }


    }

    public function Disconnect(){
        pg_close($this->db);
    }
}

