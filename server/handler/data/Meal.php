<?php

namespace data;

use Database;

require_once "server/db/Database.php";

class Meal
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function Insert($title, $highlight, $description, $id_ingredients){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query_params($conn, "INSERT INTO 
                                    meals(title,highlight,description,id_ingerdients,created_at,updated_at)
                                    VALUES($1,$2,$3,$4,$5,%6)
                                    ", array($title,$highlight,$description,$id_ingredients,$curr,$curr));

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert meal')</script>";

        $this->db->Disconnect();
    }

    public function Update($id, $title, $highlight, $description, $id_ingredients){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query_params($conn, "UPDATE meals SET title = $2,
                                      highlight = $3, description = $4, id_ingredients = $5, updated_at = $6
                                      WHERE id = $1
                                      ", array($id,$title,$highlight,$description,$id_ingredients,$curr));

        if (!$update_data) die("failed to update values: ".pg_last_error());

        echo "<script>console.log('successfully update meals')</script>";

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data = pg_query_params($conn, "DELETE FROM meals WHERE id = $1", array($id));

        if (!$delete_data) die("failed to delete values: ".pg_last_error());

        echo "<script>console.log('successfully delete meal')</script>";

        $this->db->Disconnect();
    }

    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM meals ORDER BY updated_at");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindById($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT * FROM meals WHERE id = $1 ORDER BY updated_at", array($id));

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByTitle($title){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM meals WHERE title LIKE '%$title%' ORDER BY updated_at");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}