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
    
    //llegir un llibre a partir de la clau primària (GET)
    public function llegirLlibrePK($id){
        try{
            $sql = "SELECT * FROM LLIBRES where ID_LLIB = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':id' , $id);
            $stm->execute();

            $tuples=$stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
			$this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;

            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        }catch (Exception $e){
            $this->resposta->setCorrecta(false,'No s\'ha trobat' . $e->getMessage());
            return $this->resposta;
        }
    }

    //llegir un llibre amb filtres i ordenació (GET)
    public function ordenacioLlibres($id,$anyedicio){
        try{
            $orderby='ID_LLIBRES ASC';
            $sql = "SELECT * from LLIBRES where ID_LLIBRES = :id and ANYEDICIO = :anyedicio ORDERBY $orderby";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':id' , $id);
            $stm->bindValue(':anyedicio', $anyedicio);
            $stm->execute();
            $tuples=$stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
			$this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;

            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        }catch (Exception $e){
            $this->resposta->setCorrecta(false,'No s\'ha trobat' . $e->getMessage());
            return $this->resposta;
        }
    }

}



