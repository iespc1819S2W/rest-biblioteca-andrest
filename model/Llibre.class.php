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
        try {
            $sql = "DELETE FROM LLIBRES WHERE ID_LLIB = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':id', $id);
            echo($sql);
            $stm->execute();

            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, 'Error eliminant: ' . $e->getMessage());
            return $this->resposta;
        }
    }



}



