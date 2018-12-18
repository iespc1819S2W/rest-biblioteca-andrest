<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
if (isset($_POST['id'])) {
    $dades = array(
        // "id_aut" => 6550, "nom_aut"=>"Campaner,
        "id" => $_POST['id'],
        "titol" => isset($_POST['titol'])?$_POST['titol'] : "";,
        "numedicio" => isset($_POST['numedicio'])?$_POST['numedicio'] : "";,
        "llocedicio" => isset($_POST['llocedicio'])?$_POST['llocedicio'] : "";,
        "anyedicio" => isset($_POST['anyedicio'])?$_POST['anyedicio'] : "";,
        "descripllib" => isset($_POST['descripllib'])?$_POST['descripllib'] : "";,
        "isbnLlib" => isset($_POST['isbnLlib'])?$_POST['isbnLlib'] : "";,
        "desplegalLlib" => isset($_POST['desplegalLlib'])?$_POST['desplegalLlib'] : "";,
        "signTopLlib" => isset($_POST['signTopLlib'])?$_POST['signTopLlib'] : "";,
        "datBaixLlib" => isset($_POST['datBaixLlib'])?$_POST['datBaixLlib'] : "";,
        "motiuBaixa" => isset($_POST['motiuBaixa'])?$_POST['motiuBaixa'] : "";,
        "fk_colleccioLlib" => isset($_POST['fk_colleccioLlib'])?$_POST['fk_colleccioLlib'] : "";,
        "fk_depertamentLlib" => isset($_POST['fk_depertamentLlib'])?$_POST['fk_depertamentLlib'] : "";,
        "fk_editLlib" => isset($_POST['fk_editLlib'])?$_POST['fk_editLlib'] : "";,
        "fk_llenguaLlib" => isset($_POST['fk_llenguaLlib'])?$_POST['fk_llenguaLlib'] : "";,
        "img_Llib" => isset($_POST['img_Llib'])?$_POST['img_Llib'] : "";
    );
    $res = $llibre->update($dades);
}

header('Content-type: application/json');
echo json_encode($res); 