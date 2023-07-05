<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Quadrado extends Forma{

    private $idquadro;

    public function __construct($id, $lado, $cor, $un, $idquadro){
        parent::__construct($id, $lado, $cor, $un);
        $this->setIdQuadro($idquadro);
    }

    public function setIdQuadro($idquadro) {
        $this->idquadro = $idquadro;
    }

    public function getIdQuadro() {
        return $this->idquadro;
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO quadrado (lado, cor, un, idquadro)
                      VALUES (:lado, :cor, :un, :idquadro)';
        $params = array(
            ':lado'=>$this->getLado(),
            ':cor'=>$this->getCor() ,
            ':un'=>$this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM quadrado 
                  WHERE idquadrado = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE quadrado
                    SET lado = :lado,
                        cor  = :cor,
                        un   = :un,
                        idquadro = :idquadro
                  WHERE   idquadrado = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':lado'=> $this->getLado(),
            ':cor'=> $this->getCor(),
            ':un'=> $this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
        
    }
  
    public function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM quadrado';
        switch($tipo){
            case 1: $sql .= ' WHERE idquadrado = :info'; break;
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
                     height:{$this->getLado()}{$this->getUn()};
                     background-color:{$this->getCor()}'></div>";
        return $desenho;
    }

    public function calcularArea(){
      return $this->getLado()*$this->getLado();
    }

    public function calcularPerimetro(){
        return $this->getLado()*4;
    }

}

?>