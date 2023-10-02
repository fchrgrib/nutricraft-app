<?php

namespace data;

use Database;

require_once "server/db/Database.php";

class Content
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function Insert($title, $body, $id_file, $id_photo_highlight, $highlight){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query_params($conn, "INSERT INTO 
                                content(title,body,id_file,id_photo_highlight,highlight,created_at,updated_at)
                                VALUES($1,$2,$3,$4,$5,$6,$7)",array($title,$body,$id_file,$id_photo_highlight,$highlight,$curr,$curr));

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert content')</script>";

        $this->db->Disconnect();
    }

    public function Update($id,$title, $body, $id_file, $id_photo_highlight, $highlight){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query_params($conn, "UPDATE content
                                SET title = $2, body = $3, id_file = $4, id_photo_highlight = $5, highlight = $6, updated_at = $7
                                WHERE id = $1", array($id,$title, $body, $id_file, $id_photo_highlight, $highlight, $curr));

        if (!$update_data) die("failed to update values: ".pg_last_error());

        echo "<script>console.log('successfully update content')</script>";

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data = pg_query($conn, "DELETE FROM content WHERE id = $id");

        if (!$delete_data) die("failed to delete values: ".pg_last_error());

        echo "<script>console.log('successfully delete content')</script>";

        $this->db->Disconnect();
    }


    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM content ORDER BY created_at");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'id_file' => $row['id_file'],
                'body' => $row['body'],
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

        $exec = pg_query_params($conn, "SELECT * FROM content WHERE id = $1 ORDER BY updated_at",array($id));
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'id_file' => $row['id_file'],
                'body' => $row['body'],
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

        $result = array();
        $exec = pg_query($conn, "SELECT * FROM content WHERE title LIKE '%$title%' ORDER BY created_at");

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'id_file' => $row['id_file'],
                'body' => $row['body'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}