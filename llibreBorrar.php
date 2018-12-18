<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
if (isset($_POST['id'])) {
    $res = $llibre->delete($_POST['id']);
}

header('Content-type: application/json');
echo json_encode($res); 
// 8203