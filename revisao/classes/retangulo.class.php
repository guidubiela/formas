<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Retangulo extends Forma{

    private $lado2;

     public function __construct($id, $lado, $lado2, $cor, $un){
        $this->setLado2($lado2);
        parent::__construct($id, $lado, $cor, $un);
     }

     
     public function setLado2($lado2){
        $this->lado2 = $lado2;
     }
     public function getLado2(){
        return $this->lado2;
     }


     public function inserir(){
        $sql = 'INSERT INTO retangulo (lado, lado2, cor, un)
                      VALUES (:lado, :lado2, :cor, :un)';
        $params = array(
            ':lado'=>$this->getLado(),
            ':lado2'=>$this->getLado2(),
            ':cor'=>$this->getCor() ,
            ':un'=>$this->getUn()
        );
        
        return Database::executar($sql, $params);
     }

     public function excluir(){
         $sql = 'DELETE FROM retangulo 
                  WHERE id = :id';         
         $params = array(':id'=>$this->getId());         
         return Database::executar($sql, $params);
     }

     public function editar(){
         $sql = 'UPDATE retangulo
                    SET lado = :lado,
                        lado2  = :lado2,
                        cor  = :cor,
                        un   = :un
                  WHERE   id = :id';
        $params = array(
            ':id' => $this->getId(),
            ':lado'=> $this->getLado(),
            ':lado2'=> $this->getLado2(),
            ':cor'=> $this->getCor() ,
            ':un'=> $this->getUn()
        );
        return Database::executar($sql, $params);
        
     }
  
     public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM retangulo';
        switch($tipo){
            case 1: $sql .= ' WHERE id = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
     }

     public function desenhar(){
        $desenho = "<div draggable='true' class='desenho' 
                    style='width:{$this->getLado()}{$this->getUn()};
                     height:{$this->getLado2()}{$this->getUn()};
                     background-color:{$this->getCor()}'></div>";
        return $desenho;
     }

     public function calcularArea(){
        return $this->getLado() * $this->getLado2();
     }

     public function calcularPerimetro(){
        return ($this->getLado() * 2) * ($this->getLado2() * 2);
     }

}

?>