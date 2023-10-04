<?php

use data\Content;
require_once('../../handler/data/Content.php');
require_once('../../db/Database.php');

$content = new Content();

$data = json_decode(file_get_contents("php://input"),true);

if(isset($data['select'])){
    $select = $data['select'];
    if(isset($data['search'])){
        $search = $data['search'];
        $result = $content->FindByTitle($search, $select);
    }else{
        $result = $content->FindAll($select);
    }
    
    echo json_encode($result);
}

if(isset($data['show'])){
    $result = $content->FindByTitle($search, $select);
    echo json_encode($result);
}
