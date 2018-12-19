<?php

$base = __DIR__ . '/..';
require_once "$base/lib/resposta.class.php";
require_once "$base/lib/database.class.php";

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
            echo ($sql);
            $stm->execute();

            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, 'Error eliminant: ' . $e->getMessage());
            return $this->resposta;
        }
    }
    /*Mostrar todos los Libros*/
    public function mostrarTodos()
    {
        try {
                                 
			$stm = $this->conn->prepare("SELECT id_llib,titol,isbn FROM llibres  ORDER BY id_llib");
			$stm->execute();
            $tuples=$stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
			$this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;

        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, 'Error mostrant Llibres: ' . $e->getMessage());
            return $this->resposta;
        }
    }

    /*Dar Alta a un libro*/


    public function altaLlibre($data)
    {
		try 
		{
                $sql = "SELECT max(id_llib) as N from llibres";
                $stm=$this->conn->prepare($sql);
                $stm->execute();
                $row=$stm->fetch();
                $id_llib=$row["N"]+1;

                $insertar = "INSERT INTO llibres
                            (id_llib,titol,numedicio,llocedicio,anyedicio,descrip_llib,isbn,deplegal,signtop,datbaixa_llib,motiubaixa,fk_colleccio,fk_departament,fk_idedit,fk_llengua,img_llib)
                            VALUES (:id,:nom,:nedi,:ledi,:aedi,:descrip,:isbn,:desple,:signt,:dbaixa,:mbaixa,:colleccioLlib,:depertamentLlib,:edit,:llenguaLlib,:img_llib)";
                
                $stm=$this->conn->prepare($insertar);
                
                $titolLlib=$data['titol'];
                $numEdicio=$data['numedicio'];
                $llocEdicio=$data['llocedicio'];
                $anyEdicio=$data['anyedicio'];
                $descripLlib=$data['descripllib'];
                $isbnLlib=$data['isbn'];
                $desplegalLlib=$data['desplegal'];
                $signTopLlib=$data['signtop'];
                $datBaixLlib=$data['datbaix_llib'];
                $motiuBaixa=$data['motiubaixa'];
                $fk_colleccioLlib=$data['fk_colleccio'];
                $fk_depertamentLlib=$data['fk_depertament'];
                $fk_editLlib=$data['fk_edit'];
                $fk_llenguaLlib=$data['fk_llengua'];
                $img_Llib=$data['img_Llib'];

                /*Id se calcula automaticamente*/
                $stm->bindValue(':id',$id_llib);
                /*Datos obligatorios*/
                $stm->bindValue(':nom',$titolLlib);
                $stm->bindValue(':nedi',$numEdicio);
                $stm->bindValue(':ledi',$llocEdicio);
                $stm->bindValue(':aedi',$anyEdicio);
                $stm->bindValue(':descrip',$descripLlib);
                $stm->bindValue(':isbn',$isbnLlib);
                $stm->bindValue(':desple',$desplegalLlib);
                $stm->bindValue(':signt',$signTopLlib);
                $stm->bindValue(':dbaixa',$datBaixLlib);
                $stm->bindValue(':mbaixa',$motiuBaixa);

                /*Campos opcionales con posibilidad de valor null*/
                $stm->bindValue(':colleccioLlib',!empty($fk_colleccioLlib)?$fk_colleccioLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':depertamentLlib',!empty($fk_depertamentLlib)?$fk_depertamentLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_edit',!empty($fk_editLlib)?$fk_editLlib:NULL,PDO::PARAM_INT);
                $stm->bindValue(':llenguaLlib',!empty($fk_llenguaLlib)?$fk_llenguaLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':img_llib',!empty($img_Llib)?$img_Llib:NULL,PDO::PARAM_STR);
                $stm->execute();
            
       	        $this->resposta->setCorrecta(true);
                return $this->resposta;
        }
        catch (Exception $e) 
		{
                $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
                return $this->resposta;
		}
    }   


}
