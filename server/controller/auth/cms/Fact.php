<?php


use data\Content;

require_once "../../../handler/data/Content.php";
require_once('../../../db/Database.php');

$fact = new Content();

$hasil = $fact->FindAll('created_at');

echo json_encode($hasil);