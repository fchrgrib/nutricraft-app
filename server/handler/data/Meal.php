<?php

namespace data;

use Database;

// require_once "server/db/Database.php";



class Meal
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function Insert($title, $highlight, $description, $type, $calorie){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query_params($conn, "INSERT INTO 
                                    meals(title,highlight,description,type,calorie,created_at,updated_at)
                                    VALUES($1,$2,$3,$4,$5,$6,$7) RETURNING id
                                    ", array($title,$highlight,$description,$type,$calorie,$curr,$curr));

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        $id = pg_fetch_assoc($insert_data);

        echo "<script>console.log('successfully insert meal')</script>";

        $this->db->Disconnect();

        return $id['id'];
    }

    public function Update($id, $title, $highlight, $description, $type, $calorie){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query_params($conn, "UPDATE meals SET title = $2,
                                      highlight = $3, description = $4, type = $5, calorie = $6, updated_at = $7
                                      WHERE id = $1
                                      ", array($id,$title,$highlight,$description,$type,$calorie,$curr));

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

    public function FindAll($sort, $kiri, $kanan){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' ORDER BY title ASC");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' ORDER BY calorie ASC");
        }else{
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' ORDER BY calorie DESC");
        }
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
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
                'type' => $row['type'],
                'calorie' => $row['calorie'],
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
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByType($type){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' AND type = '$type' ORDER BY title ASC");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' AND type = '$type' ORDER BY calorie ASC");
        }else{
            $exec = pg_query($conn, "SELECT * FROM meals WHERE calorie <= '$kanan' AND calorie >= '$kiri' AND type = '$type' ORDER BY calorie DESC");
        }$exec = pg_query($conn, "SELECT * FROM meals WHERE type = '%$type%' ORDER BY updated_at");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function SortBy($sort){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if ($sort == "alphabetical"){
            $sort = "title";
            $sdc = "ASC";
        }else if ($sort == "caloriehl"){
            $sort = "calorie";
            $sdc = "DESC";
        }else if ($sort == "calorielh"){
            $sort = "calorie";
            $sdc = "ASC";
        }

        $exec = pg_query($conn, "SELECT * FROM meals ORDER BY $sort $sdc");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}