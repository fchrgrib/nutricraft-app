<?php

namespace data;

use Database;

// require_once "server/db/Database.php";

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


    public function FindAll($select){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($select == 'Alphabet'){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.title ASC");
        }else if($select){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.created_at DESC");
        }else{
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.created_at ASC");
        }

        // $exec = pg_query($conn, "SELECT * FROM content ORDER BY created_at");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'highlight'=> $row['highlight'],
                'path_photo'=>$row['path_photo'],
                'path_file'=>$row['path_file'],
                'type_file' =>$row['type_file'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindAllSearch($title){
        $this->db->Connect();
        $conn = $this->db->getDb();

        $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                        (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                        (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                        (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                        c.created_at as created_at,
                        c.updated_at as updated_at
                        FROM content c 
                        WHERE c.title ILIKE '%$title%'");
        

        // $exec = pg_query($conn, "SELECT * FROM content ORDER BY created_at");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'highlight'=> $row['highlight'],
                'path_photo'=>$row['path_photo'],
                'path_file'=>$row['path_file'],
                'type_file' =>$row['type_file'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindAllPaging($select, $page){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($select == 'Alphabet'){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.title ASC
                            LIMIT 2 OFFSET $page");
        }else if($select){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.created_at DESC
                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c ORDER BY c.created_at ASC
                            LIMIT 2 OFFSET $page");
        }

        // $exec = pg_query($conn, "SELECT * FROM content ORDER BY created_at");
        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'highlight'=> $row['highlight'],
                'path_photo'=>$row['path_photo'],
                'path_file'=>$row['path_file'],
                'type_file' =>$row['type_file'],
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

        $exec = pg_query_params($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c WHERE c.id = $1 ORDER BY c.updated_at",array($id));

        $result = array();

        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'highlight'=> $row['highlight'],
                'path_photo'=>$row['path_photo'],
                'path_file'=>$row['path_file'],
                'type_file' =>$row['type_file'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }

    public function FindByTitle($title, $select, $page){
        $this->db->Connect();
        $conn = $this->db->getDb();

        if($select == 'Alphabet'){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c WHERE c.title ILIKE '%$title%' ORDER BY c.title ASC
                            LIMIT 2 OFFSET $page");
        }else if($select == 'Newest'){
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c WHERE c.title ILIKE '%$title%' ORDER BY c.created_at DESC
                            LIMIT 2 OFFSET $page");
        }else{
            $exec = pg_query($conn, "SELECT c.id id,c.title title,c.highlight highlight,c.body body,
                            (SELECT p.path FROM file p WHERE c.id_photo_highlight = p.id) as path_photo,
                            (SELECT p.path FROM file p WHERE c.id_file = p.id) as path_file,
                            (SELECT p.type_content FROM file p WHERE c.id_file = p.id) as type_file,
                            c.created_at as created_at,
                            c.updated_at as updated_at
                            FROM content c WHERE c.title ILIKE '%$title%' ORDER BY c.created_at ASC
                            LIMIT 2 OFFSET $page");
        }

        $result = array();


        while ($row = pg_fetch_assoc($exec)){
            $result[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'highlight'=> $row['highlight'],
                'path_photo'=>$row['path_photo'],
                'path_file'=>$row['path_file'],
                'type_file' =>$row['type_file'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }

        $this->db->Disconnect();

        return $result;
    }
}