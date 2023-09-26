<?php

require_once('server/db/Database.php');

$db = new Database();

$db->Connect();
$check = $db->getDb();

if ($check) echo "success";
