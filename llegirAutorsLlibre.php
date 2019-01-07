<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
if (isset($_GET['id_llibre'])) {
    $res = $llibre->llegirAutorsLlibre($_GET['id_llibre']);
} else {
    $res = new Resposta();
    $res->SetCorrecta(false, "ID llibre obligatori");
    
}

header('Content-type: application/json');
echo json_encode($res);