<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
if (isset($_GET['id'])) {
    $res = $llibre->ordenacioLlibres($_GET['id'],['anyedicio']);
    // $res->SetCorrecta(true, "Aqui tens");
}else{
    $res = new Resposta();
    $res->SetCorrecta(false,"ID obligatori");
}

header('Content-type: application/json');
echo json_encode($res);