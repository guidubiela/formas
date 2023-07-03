<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Circulo extends Forma{

    private $raio;

    public function __construct($id, $raio, $cor, $un){
        parent::__construct($id, $lado, $cor, $un);
        $this->setRaio($raio);
    }

    public function setRaio($raio){
        $this->raio = $raio;
    }
    public function getRaio(){
        return $this->raio;
    }

    public function inserir(){
        $sql = 'INSERT INTO circulo (raio, cor, un)
                    VALUES (:raio, :cor, :un)';
        $params = array(':raio'=>$this->getRaio(),
                         ':cor'=>$this->getCor() ,
                         ':un'=>$this->getUn());
        
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM circulo 
                WHERE id = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
     
    }
     
    public function editar(){
        $sql = 'UPDATE circulo
                    SET raio = :raio,
                        cor  = :cor,
                        un   = :un
                WHERE   id = :id';
        $params = array(':id'=>$this->getId(),
                         ':raio'=> $this->getRaio(),
                         ':cor'=> $this->getCor(),
                         ':un'=> $this->getUn());
        return Database::executar($sql, $params);
        
     }
  
     public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM circulo';
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
                    style='width:{$this->getRaio()}{$this->getUn()};
                     height:{$this->getRaio()}{$this->getUn()};
                     background-color:{$this->getCor()}'></div>";
        return $desenho;
     }

     public function calcularArea(){
      return pi()*pow($this->getRaio(), 2);
     }

     public function calcularPerimetro(){
        return 2*pi()*$this->getRaio();
     }

}

?>