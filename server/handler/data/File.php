<?php

namespace data;

use Database;

require_once "server/db/Database.php";

class File
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function Insert($name, $path, $type_content){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query_params($conn, "INSERT INTO
                                file(name,path,type_content,created_at,updated_at)
                                VALUES ($1,$2,$3,$4,$5)",
                                array($name,$path,$type_content,$curr,$curr)
        );

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert file')</script>";

        $this->db->Disconnect();
    }

    public function Update($id, $name, $path, $type_content){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query_params($conn, "UPDATE file SET name = $2,
                                    path = $3, type_content = $4, updated_at = $5
                                    WHERE id = $1
                                    ", array($id,$name,$path,$type_content,$curr));

        if (!$update_data) die("failed to update values: ".pg_last_error());

        echo "<script>console.log('successfully update file')</script>";

        $this->db->Disconnect();
    }

    public function Delete($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $delete_data =  pg_query_params($conn, "DELETE FROM file WHERE id = $1", array($id));

        if (!$delete_data) die("failed to delete values: ".pg_last_error());

        echo "<script>console.log('successfully delete file')</script>";

        $this->db->Disconnect();
    }

    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM file ORDER BY created_at");
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'path' => $row['path'],
                'type_content' => $row['type_content'],
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

        $exec = pg_query_params($conn, "SELECT * FROM file WHERE id = $1 ORDER BY created_at",array($id));
        $result = array();

        while($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'path' => $row['path'],
                'type_content' => $row['type_content'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}