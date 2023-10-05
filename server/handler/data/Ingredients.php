<?php

namespace data;

use Database;



class Ingredients
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function Insert($ingredient, $description, $id_meals){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $insert_data = pg_query_params($conn, "INSERT INTO
                                ingredients(id,ingredient,description,id_meals)
                                VALUES (DEFAULT,$1,$2,$3)",
            array($ingredient, $description, $id_meals)
        );

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert ingredients')</script>";

        $this->db->Disconnect();
    }

    public function Update($id, $ingredient, $description){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $insert_data = pg_query_params($conn, "UPDATE FROM ingredients SET
                                       ingredient = $2, description = $3 WHERE id = $1",
            array($id,$ingredient, $description)
        );

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert ingredients')</script>";

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data =  pg_query_params($conn, "DELETE FROM ingredients WHERE id = $1", array($id));

        if (!$delete_data) die("failed to delete values: ".pg_last_error());

        echo "<script>console.log('successfully delete ingredients')</script>";

        $this->db->Disconnect();
    }

    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM ingredients ");
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'ingredient' => $row['ingredient'],
                'description' => $row['description']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindById($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT * FROM ingredients WHERE id = $1 ", array($id));
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'ingredient' => $row['ingredient'],
                'description' => $row['description']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByMeals($idMeals){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT * FROM ingredients WHERE id_meals = $1 ", array($idMeals));
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'ingredient' => $row['ingredient'],
                'description' => $row['description']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}