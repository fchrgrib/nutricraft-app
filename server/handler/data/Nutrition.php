<?php

namespace data;

use Database;

require_once "server/db/Database.php";

class Nutrition
{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function Insert($calorie, $carbo, $protein, $fat, $sugar, $id_meals){
        $this->db->Connect();
        $conn = $this->db->getDb();


        $insert_data = pg_query_params($conn, "INSERT INTO nutrition(calorie,carbo,protein,fat,sugar,id_meals)
                                       VALUES($1,$2,$3,$4,$5,$6)
                                       ",array($calorie,$carbo,$protein,$fat,$sugar,$id_meals));

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        $id = pg_fetch_assoc($insert_data);

        echo "<script>console.log('successfully insert nutrition')</script>";

        $this->db->Disconnect();

        return $id['id'];
    }

    public function Update($id, $calorie, $carbo, $protein, $fat, $sugar, $id_meals){
        $this->db->Connect();
        $conn = $this->db->getDb();


        $update_data = pg_query_params($conn, "UPDATE nutrition SET calorie = $2, carbo = $3, protein = $4, fat = $5, sugar = $6, id_meals = $7 WHERE id = $1
                                       ",array($id,$calorie,$carbo,$protein,$fat,$sugar,$id_meals));

        if (!$update_data) die("failed to update values: ".pg_last_error());

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data = pg_query_params($conn, "DELETE FROM nutrition WHERE id = $1
                                       ",array($id));

        if (!$delete_data) die("failed to delete values: ".pg_last_error());

        $this->db->Disconnect();
    }

    public function FindByMeals($id_meals){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query_params($conn, "SELECT * FROM nutrtion  WHERE id_meals = $1 ORDER BY created_at", array($id_meals));
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'calorie' => $row['calorie'],
                'carbo' => $row['carbo'],
                'protein' => $row['protein'],
                'fat' => $row['fat'],
                'sugar' => $row['sugar']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}