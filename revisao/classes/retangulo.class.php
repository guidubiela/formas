<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    
class Retangulo extends Forma{

   private $lado2;
   private $idquadro;

   public function __construct($id, $lado, $lado2, $cor, $un, $idquadro){
      $this->setLado2($lado2);
      $this->setIdQuadro($idquadro);
      parent::__construct($id, $lado, $cor, $un, $idquadro);
   }

     
   public function setLado2($lado2){
      $this->lado2 = $lado2;
   }
   public function getLado2(){
      return $this->lado2;
   }

   public function setIdQuadro($idquadro) {
      $this->idquadro = $idquadro;
   }
   public function getIdQuadro() {
      return $this->idquadro;
   }

   public function inserir(){
      $conexao = Database::conectar();
      $sql = 'INSERT INTO retangulo (lado, lado2, cor, un, idquadro)
                    VALUES (:lado, :lado2, :cor, :un, :idquadro)';
      $params = array(
          ':lado'=>$this->getLado(),
          ':lado2'=>$this->getLado2(),
          ':cor'=>$this->getCor() ,
          ':un'=>$this->getUn(),
          ':idquadro'=>$this->getIdQuadro()
      );
      Database::preparar($conexao, $sql, $params);
      return Database::executar($sql, $params);
   }

   public function excluir(){
      $conexao = Database::conectar();
      $sql = 'DELETE FROM retangulo 
                WHERE idretangulo = :id';         
      $params = array(':id'=>$this->getId());
      Database::preparar($conexao, $sql, $params);       
      return Database::executar($sql, $params);
   }

   public function editar(){
      $conexao = Database::conectar();
      $sql = 'UPDATE retangulo
                  SET lado = :lado,
                      lado2 = :lado2,
                      cor  = :cor,
                      un   = :un,
                      idquadro = :idquadro
                WHERE   idretangulo = :id';
      $params = array(
          ':id'=>$this->getId(),
          ':lado'=> $this->getLado(),
          ':lado2'=> $this->getLado2(),
          ':cor'=> $this->getCor(),
          ':un'=> $this->getUn(),
          ':idquadro'=>$this->getIdQuadro()
      );
      Database::preparar($conexao, $sql, $params);
      return Database::executar($sql, $params);
   }

   public static function listar($tipo = 0, $info = ''){
      $sql = 'SELECT * FROM retangulo';
      switch($tipo){
          case 1: $sql .= ' WHERE idretangulo = :info'; break;
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