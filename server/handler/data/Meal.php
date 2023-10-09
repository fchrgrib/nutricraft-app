<?php

namespace data;

use Database;

 require_once (__DIR__."/../../db/Database.php");



class Meal
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function Insert($title, $highlight, $description, $type, $calorie, $id_file){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query_params($conn, "INSERT INTO 
                                    meals(title,highlight,description,type,calorie,id_file,created_at,updated_at)
                                    VALUES($1,$2,$3,$4,$5,$6,$7,$8) RETURNING id
                                    ", array($title,$highlight,$description,$type,$calorie,$id_file,$curr,$curr));

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        $id = pg_fetch_assoc($insert_data);

        echo "<script>console.log('successfully insert meal')</script>";

        $this->db->Disconnect();

        return $id['id'];
    }

    public function Update($id, $title, $highlight, $description, $type, $calorie, $id_file){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query_params($conn, "UPDATE meals SET title = $2,
                                      highlight = $3, description = $4, type = $5, calorie = $6, id_file = $7, updated_at = $8
                                      WHERE id = $1
                                      ", array($id,$title,$highlight,$description,$type,$calorie,$id_file,$curr));

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

    public function FindAll($sort, $left, $right){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.title ASC");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie ASC");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie DESC");
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
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindAllPaging($sort, $left, $right, $page){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.title ASC
                                            LIMIT 2 OFFSET $page");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie ASC 
                                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie DESC
                                            LIMIT 2 OFFSET $page");
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
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindAllSearch($title, $sort, $left, $right, $type){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($type == 'All'){
            $tipe = ' ';
        }else{
            if($type=='Dinner'){
                $tipe = "AND m.type = 'Dinner'";
            }else if($type=='Breakfast'){
                $tipe = "AND m.type = 'Breakfast'";
            }else{
                $tipe = "AND m.type = 'Lunch'";
            }
        }

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' $tipe ORDER BY m.title ASC");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at 
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' $tipe ORDER BY m.calorie ASC");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' $tipe ORDER BY m.calorie DESC");
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
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindAllSearchPaging($title, $sort, $left, $right, $page){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.title ASC
                                            LIMIT 2 OFFSET $page");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at 
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie ASC
                                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE (m.title ILIKE '%$title%' OR m.highlight ILIKE '%$title%') AND m.calorie <= '$right' AND m.calorie >= '$left' ORDER BY m.calorie DESC
                                            LIMIT 2 OFFSET $page");
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
                'path_photo'=>$row['path_photo'],
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

        $exec = pg_query_params($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo, m.id_file as id_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.id = $1 ORDER BY m.updated_at", array($id));

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'path_photo'=>$row['path_photo'],
                'id_photo'=>$row['id_photo'],
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

        $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                        (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                        m.created_at created_at, m.updated_at updated_at
                                        FROM meals m WHERE m.title LIKE '%$title%' ORDER BY m.updated_at");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByTitleSearchPaging($title, $type, $sort, $left, $right, $page){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.title ILIKE '%$title%' AND m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.title ASC
                                            LIMIT 2 OFFSET $page");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.title ILIKE '%$title%' AND m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie ASC
                                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.title ILIKE '%$title%' AND m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie DESC
                                            LIMIT 2 OFFSET $page");
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
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByType($type, $sort, $left, $right){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.title ASC");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie ASC");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie DESC");
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
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByTypePaging($type, $sort, $left, $right){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($sort == "Alphabet"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.title ASC
                                            LIMIT 2 OFFSET $page");
        }else if($sort == "Calories: low to high"){
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie ASC
                                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                            (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                            m.created_at created_at, m.updated_at updated_at
                                            FROM meals m WHERE m.calorie <= '$right' AND m.calorie >= '$left' AND m.type = '$type' ORDER BY m.calorie DESC
                                            LIMIT 2 OFFSET $page");
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
                'path_photo'=>$row['path_photo'],
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

        $exec = pg_query($conn, "SELECT m.id id, m.title title, m.highlight highlight, m.description description, m.type type, m.calorie calorie,
                                        (SELECT path FROM file f WHERE f.id = m.id_file) as path_photo,
                                        m.created_at created_at, m.updated_at updated_at
                                        FROM meals m ORDER BY $sort $sdc");

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'highlight' => $row['highlight'],
                'description' => $row['description'],
                'type' => $row['type'],
                'calorie' => $row['calorie'],
                'path_photo'=>$row['path_photo'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}