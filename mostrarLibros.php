<?php
// get Libro
 $base = __DIR__;
 require_once("$base/model/Llibre.class.php");
 $llibre = new Llibre();
 $res=$llibre->mostrarTodos();
 header('Content-type: application/json');
 echo json_encode($res);
 ?>