<?php

use data\Content;
require_once('../../handler/data/Content.php');
require_once('../../db/Database.php');

$content = new Content();


if(isset($_GET['select'])){
    $select = $_GET['select'];
    $page = $_GET['page'];
    $page = ($page-1)*10;
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $result = $content->FindByTitle($search, $select, $page);
    }else{
        $result = $content->FindAllPaging($select, $page);
    }
    
    echo json_encode($result);
}

if(isset($_GET['show'])){
    $page = $_GET['page'];
    $page = ($page-1)*2;
    $select = $_GET['Select'];
    $result = $content->FindAllPaging($select, $page);
    echo json_encode($result);
}

if(isset($_GET['pageNumber'])){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $result = $content->FindAllSearch($search);
    }else{
        $result = $content->FindAll($search);
    }
    echo json_encode($result);
}