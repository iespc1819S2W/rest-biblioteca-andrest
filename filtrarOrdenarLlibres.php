<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();

$where = '';
$orderby ='';
if(isset($_GET['where'])){
    $where = "where ".$_GET['where'];
}

if(isset($_GET['orderby'])){
    $orderby = "orderby ".$_GET['orderby'];
}



    $res = $llibre->filtrarOrdenarLlibres($where,$orderby);



header('Content-type: application/json');
echo json_encode($res);