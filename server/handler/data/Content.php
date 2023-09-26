<?php

namespace data;

use Database;

class Content
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function Insert($title, $body, $type_content, $path){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query($conn, "INSERT INTO 
                                content(title,body,type_content,path,createdAt,updateAt)
                                VALUES($title,$body,$type_content,$path,$curr,$curr)");

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert content')</script>";

        $this->db->Disconnect();
    }

    public function Update($id, $title, $body, $type_content, $path){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query($conn, "UPDATE content
                                SET title = $title, body = $body, type_content = $type_content, path = $path, updatedAt = $curr
                                WHERE id = $id");

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
}