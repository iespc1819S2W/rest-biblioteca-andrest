<?php
//
 $base = __DIR__;
 require_once("$base/model/Llibre.class.php");
 $llibre = new Llibre();
 $estado = "sense dades";
 if (isset($_POST['titol'])) {
    $estado = "executando";
    $dades = array(
        "titol" => (isset($_POST['titol'])?$_POST['titol'] : ""),
        "numedicio" => (isset($_POST['numedicio'])?$_POST['numedicio'] : ""),
        "llocedicio" => (isset($_POST['llocedicio'])?$_POST['llocedicio'] : ""),
        "anyedicio" => (isset($_POST['anyedicio'])?$_POST['anyedicio'] : ""),
        "descripllib" => (isset($_POST['descripllib'])?$_POST['descripllib'] : ""),
        "isbn" => (isset($_POST['isbnLlib'])?$_POST['isbnLlib'] : ""),
        "desplegal" => (isset($_POST['desplegalLlib'])?$_POST['desplegalLlib'] : ""),
        "signtop" => (isset($_POST['signTopLlib'])?$_POST['signTopLlib'] : ""),
        "datbaix_llib" => (isset($_POST['datBaixLlib'])?$_POST['datBaixLlib'] : ""),
        "motiubaixa" => (isset($_POST['motiuBaixa'])?$_POST['motiuBaixa'] : ""),
        "fk_colleccio" => (isset($_POST['fk_colleccioLlib'])?$_POST['fk_colleccioLlib'] : ""),
        "fk_depertament" => (isset($_POST['fk_depertamentLlib'])?$_POST['fk_depertamentLlib'] : ""),
        "fk_edit" => (isset($_POST['fk_editLlib'])?$_POST['fk_editLlib'] : ""),
        "fk_llengua" => (isset($_POST['fk_llenguaLlib'])?$_POST['fk_llenguaLlib'] : ""),
        "img_Llib" => (isset($_POST['img_Llib'])?$_POST['img_Llib'] : "")
    );
     $res = $llibre->altaLlibre($dades);
    if(!$res->correcta){
        $estado = "Error insertant Llibre: ".$res->missatge;
    } else {
        $estado = "ok";
    }

 }        header('Content-type: application/json');

 echo json_encode($estado); 