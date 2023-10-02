<?php

namespace data;

use Database;

require_once "server/db/Database.php";

/**TODO INSERT UPDATE FOREIGN KEY TO ID MEALS**/

class Ingredients
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function Insert($ingredient, $description){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $insert_data = pg_query_params($conn, "INSERT INTO
                                ingredients(ingredient,description)
                                VALUES ($1,$2)",
            array($ingredient, $description)
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

        $exec = pg_query($conn, "SELECT * FROM ingredients ORDER BY created_at");
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

        $exec = pg_query_params($conn, "SELECT * FROM ingredients WHERE id = $1 ORDER BY created_at", array($id));
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