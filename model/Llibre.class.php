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

    public function update($data)
    {
        try 
		{
                $id_llib=$data['id_llib'];
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

                $sql = "UPDATE llibres SET 
                    titolLlib =:titolLlib, 
                    numEdicio =:numEdicio,
                    llocEdicio =:llocEdicio,
                    anyEdicio =:anyEdicio,
                    descripLlib =:descripLlib,
                    isbnLlib =:isbnLlib,
                    desplegalLlib =:desplegalLlib,
                    signTopLlib =:signTopLlib,
                    datBaixLlib =:datBaixLlib,
                    motiuBaixa =:motiuBaixa,
                    fk_colleccioLlib =:fk_colleccioLlib,
                    fk_depertamentLlib =:fk_depertamentLlib,
                    fk_editLlib =:fk_editLlib,
                    fk_llenguaLlib =:fk_llenguaLlib,
                    img_Llib =:img_Llib;

                    WHERE id_aut =:id_aut";

                // UPDATE `autors` SET `NOM_AUT` = '$valorGuardar', `FK_NACIONALITAT` = null WHERE `ID_AUT` = $idguardar";
                
                $stm=$this->conn->prepare($sql);
                $stm->bindValue(':id_aut',$id_aut);
                $stm->bindValue(':titolLlib',$titolLlib);
                $stm->bindValue(':numEdicio',$numEdicio);
                $stm->bindValue(':llocEdicio',$llocEdicio);
                $stm->bindValue(':anyEdicio',$anyEdicio);
                $stm->bindValue(':descripLlib',$descripLlib);
                $stm->bindValue(':isbnLlib',$isbnLlib);
                $stm->bindValue(':desplegalLlib',$desplegalLlib);
                $stm->bindValue(':signTopLlib',$signTopLlib);
                $stm->bindValue(':datBaixLlib',$datBaixLlib);
                $stm->bindValue(':motiuBaixa',$motiuBaixa);
                $stm->bindValue(':fk_colleccioLlib',!empty($fk_colleccioLlib)?$fk_colleccioLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_depertamentLlib',!empty($fk_depertamentLlib)?$fk_depertamentLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_editLlib',!empty($fk_editLlib)?$fk_editLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_llenguaLlib',!empty($fk_llenguaLlib)?$fk_llenguaLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':img_Llib',$img_Llib);
                $stm->execute();
            
       	        $this->resposta->setCorrecta(true);
                return $this->resposta;
        }
        catch (Exception $e) 
		{
                $this->resposta->setCorrecta(false, "Error actualitzant: ".$e->getMessage());
                return $this->resposta;
		}
    }

}



