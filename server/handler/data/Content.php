<?php

namespace data;

use Database;

class Content
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function Insert($title, $body, $id_file){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $insert_data = pg_query($conn, "INSERT INTO 
                                content(title,body,id_file,createdAt,updateAt)
                                VALUES($title,$body,$id_file,$curr,$curr)");

        if (!$insert_data) die("failed to insert values: ".pg_last_error());

        echo "<script>console.log('successfully insert content')</script>";

        $this->db->Disconnect();
    }

    public function Update($id,$title, $body, $id_file){
        $this->db->Connect();
        $conn = $this->db->getDb();
        $curr = date('Y-m-d H:i:s');

        $update_data = pg_query($conn, "UPDATE content
                                SET title = $title, body = $body, id_file = $id_file, updatedAt = $curr
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


    public function FindAll(){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM content ORDER BY id");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                id => $row['id'],
                title => $row['title'],
                id_file => $row['id_file'],
                body => $row['body'],
                createdAt => $row['createdAt'],
                updateAt => $row['updateAt']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindById($id){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM content WHERE id = $id ORDER BY id");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                id => $row['id'],
                title => $row['title'],
                id_file => $row['id_file'],
                body => $row['body'],
                createdAt => $row['createdAt'],
                updateAt => $row['updateAt']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByTitle($title){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT * FROM content WHERE title LIKE '$title%' ORDER BY id");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                id => $row['id'],
                title => $row['title'],
                id_file => $row['id_file'],
                body => $row['body'],
                createdAt => $row['createdAt'],
                updateAt => $row['updateAt']
            );
        }

        $exec = pg_query($conn, "SELECT * FROM content WHERE title LIKE '%$title%' ORDER BY id");

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                id => $row['id'],
                title => $row['title'],
                id_file => $row['id_file'],
                body => $row['body'],
                createdAt => $row['createdAt'],
                updateAt => $row['updateAt']
            );
        }

        $exec = pg_query($conn, "SELECT * FROM content WHERE title LIKE '$title%' ORDER BY id");

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                id => $row['id'],
                title => $row['title'],
                id_file => $row['id_file'],
                body => $row['body'],
                createdAt => $row['createdAt'],
                updateAt => $row['updateAt']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}