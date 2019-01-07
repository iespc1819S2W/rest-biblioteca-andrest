<?php

$base = __DIR__ . '/..';
require_once "$base/lib/resposta.class.php";
require_once "$base/lib/database.class.php";


class Llibre
{

    private $conn;
    private $resposta;


    // Constructor
    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }


    // Funcions
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
    
    public function llegirLlibrePK($id)
    {
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

    public function autorLlibre($id_autor, $id_llibre)
    {
        try {
            $sql = "INSERT INTO `lli_aut` (`FK_IDLLIB`, `FK_IDAUT`) VALUES (:id_autor, :id_llibre)";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':id_autor', $id_autor);
            $stm->bindValue(':id_llibre', $id_llibre);
            $stm->execute();

            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, 'Error en autorLlibre' . $e->getMessage());
            return $this->resposta;
        }
    }

    public function baixaAutorLlibre($id_llibre, $id_autor)
    {
        try {
            $sql = "DELETE FROM lli_aut WHERE FK_IDLLIB = :fk_llibre AND FK_IDAUT = :fk_idaut";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':fk_llibre', $id_llibre);
            $stm->bindValue(':fk_idaut', $id_autor);
            $stm->execute();

            $this->resposta->SetCorrecta(true);
            return $this->resposta;

        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, "Error en la baixa del autor-llibre: " . $e->getMessage());
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

    public function update($data)
    {
        try 
		{
                $fk_colleccioLlib=$data['fk_colleccioLlib'];
                $fk_depertamentLlib=$data['fk_depertamentLlib'];
                $fk_editLlib=$data['fk_editLlib'];
                $fk_llenguaLlib=$data['fk_llenguaLlib'];
                $sql = "UPDATE llibres SET 
                    titol =:titolLlib, 
                    numEdicio =:numEdicio,
                    llocEdicio =:llocEdicio,
                    anyEdicio =:anyEdicio,
                    descrip_Llib =:descripLlib,
                    isbn =:isbnLlib,
                    deplegal =:deplegalLlib,
                    signTop =:signTopLlib,
                    datBaixa_llib =:datBaixLlib,
                    motiuBaixa =:motiuBaixa,
                    fk_colleccio =:fk_colleccioLlib,
                    fk_departament =:fk_depertamentLlib,
                    fk_idedit =:fk_editLlib,
                    fk_llengua =:fk_llenguaLlib,
                    img_Llib =:img_Llib;

                    WHERE id_llib =:id_llib";
                $stm=$this->conn->prepare($sql);
                $stm->bindValue(':id_llib',$data['id']);
                $stm->bindValue(':titolLlib',$data['titol']);
                $stm->bindValue(':numEdicio',$data['numedicio']);
                $stm->bindValue(':llocEdicio',$data['llocedicio']);
                $stm->bindValue(':anyEdicio',$data['anyedicio']);
                $stm->bindValue(':descripLlib',$data['descripllib']);
                $stm->bindValue(':isbnLlib',$data['isbnLlib']);
                $stm->bindValue(':deplegalLlib',$data['desplegalLlib']);
                $stm->bindValue(':signTopLlib',$data['signTopLlib']);
                $stm->bindValue(':datBaixLlib',$data['datBaixLlib']);
                $stm->bindValue(':motiuBaixa',$data['motiuBaixa']);
                $stm->bindValue(':fk_colleccioLlib',!empty($fk_colleccioLlib)?$fk_colleccioLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_depertamentLlib',!empty($fk_depertamentLlib)?$fk_depertamentLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_editLlib',!empty($fk_editLlib)?$fk_editLlib:NULL,PDO::PARAM_INT);
                $stm->bindValue(':fk_llenguaLlib',!empty($fk_llenguaLlib)?$fk_llenguaLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':img_Llib',$data['img_Llib']);
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

    public function filtrarOrdenarLlibres($where,$orderby)
    {
        try{
            
            $sql = "SELECT * from LLIBRES $where $orderby ";

            $stm = $this->conn->prepare($sql);
            
            
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

    public function llegirAutorsLlibre($id_llibre)
    {
        try {
            // $sql = SELECT FK_IDLLIB, FK_IDAUT, FK_ROLAUT, NOM_AUT 
            //     FROM lli_aut INNER JOIN autors ON lli_aut.fk_idaut = autors.id_aut 
            //     WHERE FK_IDLLIB = 1
            $sql = "SELECT FK_IDLLIB, FK_IDAUT, FK_ROLAUT, NOM_AUT 
                    FROM lli_aut INNER JOIN autors ON lli_aut.fk_idaut = autors.id_aut 
                    WHERE FK_IDLLIB = :fk_llibre";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':fk_llibre', $id_llibre);
            $stm->execute();
            $tuples = $stm->fetchAll();

            $this->resposta->SetDades($tuples);
            $this->resposta->SetCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->SetCorrecta(false, 'Error en llegirAutorsLlibre' . $e->getMessage());
            return $this->resposta;
        }
    }

    public function altaLlibre($data)
    {
		try 
		{
                $sql = "SELECT max(id_llib) as N from llibres";
                $uno=$this->conn->prepare($sql);
                $uno->execute();
                $row=$uno->fetch();
                $id_llib=$row["N"]+1;

                $insertar = "INSERT INTO llibres (id_llib,titol,numedicio,llocedicio,anyedicio,descrip_llib,isbn,deplegal,signtop,datbaixa_llib,motiubaixa,fk_colleccio,fk_departament,fk_idedit,fk_llengua,img_llib)
                VALUES (:id,:nom,:nedi,:ledi,:aedi,:descrip,:isbn,:desple,:signt,:dbaixa,:mbaixa,:colleccioLlib,:depertamentLlib,:edit,:llenguaLlib,:img_llib)";
                /*INSERT INTO llibres(id_llib,titol,numedicio,llocedicio,anyedicio,descrip_llib,isbn,deplegal,signtop,datbaixa_llib,motiubaixa,fk_colleccio,fk_departament,fk_idedit,fk_llengua,img_llib)VALUES (8203,'Joselito Prueba',1,'BARCELONA',2005,'24 CM, 262 PAG.',978-84-7827-391-1,NULL,'INF-BRA-NEC',NULL,NULL,NULL,NULL,133,NULL,NULL);
                */
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
                $stm->bindValue(':desple',!empty($desplegalLlib)?$desplegalLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':signt',!empty($signTopLlib)?$signTopLlib:NULL,PDO::PARAM_STR);

                $stm->bindValue(':dbaixa',!empty($datBaixLlib)?$datBaixLlib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':mbaixa',!empty($motiuBaixa)?$motiuBaixa:NULL,PDO::PARAM_STR);

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
