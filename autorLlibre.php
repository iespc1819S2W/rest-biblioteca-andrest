<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
if (isset($_POST['id_aut']) && isset($_POST['id_llibre'])) {
    $res = $llibre->autorLlibre($_POST['id_aut'], $_POST['id_llibre']);
} else {
    $res = new Resposta();
    $res->SetCorrecta(false, "ID autor i ID llibre obligatori");
    
}

header('Content-type: application/json');
echo json_encode($res); 