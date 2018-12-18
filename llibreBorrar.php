<?php
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");

$llibre = new Llibre();
$llibre->delete(8203);
