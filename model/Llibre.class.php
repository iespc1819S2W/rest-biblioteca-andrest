<?php 

$base = __DIR__ . '/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");


class Llibre 
{

    // Propietats
    private $conn;
    private $resposta;
    

    // Constructor
    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();      
        $this->resposta = new Resposta();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM LLIBRES WHERE ID_LLIB = '$id'";
        echo($sql);
        $stm = $this->$conn->prepare($sql);
        // $stm->bindParam(1, $id);
        $stm->execute();
    }



}



