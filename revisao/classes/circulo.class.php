<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Circulo extends Forma{

    private $raio;
    private $idquadro;

    public function __construct($id, $raio, $cor, $un, $idquadro){
        parent::__construct($id, $raio, $cor, $un, $idquadro);
        $this->setRaio($raio);
        $this->setIdQuadro($idquadro);
    }

    public function setRaio($raio){
        $this->raio = $raio;
    }
    public function getRaio(){
        return $this->raio;
    }

    public function setIdQuadro($idquadro) {
        $this->idquadro = $idquadro;
    }

    public function getIdQuadro() {
        return $this->idquadro;
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO circulo (raio, cor, un, idquadro)
                      VALUES (:raio, :cor, :un, :idquadro)';
        $params = array(
            ':raio'=>$this->getRaio(),
            ':cor'=>$this->getCor() ,
            ':un'=>$this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM circulo 
                  WHERE idcirculo = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE circulo
                    SET raio = :raio,
                        cor  = :cor,
                        un   = :un,
                        idquadro = :idquadro
                  WHERE   idcirculo = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':raio'=> $this->getRaio(),
            ':cor'=> $this->getCor(),
            ':un'=> $this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
        
    }
  
    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM circulo';
        switch($tipo){
            case 1: $sql .= ' WHERE idcirculo = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

    public function diametro(){
        return $this->getRaio()*2;
    }

     public function desenhar(){
        $desenho = "<div draggable='true' class='desenho' 
                    style='width:{$this->diametro()}{$this->getUn()};
                     height:{$this->diametro()}{$this->getUn()};
                     border-radius: 50%;
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