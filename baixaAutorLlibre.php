<?php

$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();

if (isset($_POST['id_llib']) && isset($_POST['id_aut'])) {
    $res = $llibre->baixaAutorLlibre($_POST['id_llib'], $_POST['id_aut']);
} else {
    $res = new Resposta();
    $res->SetCorrecta(false, "ID llibre i ID autor obligatori");

}

header('Content-type: application/json');
echo json_encode($res);


