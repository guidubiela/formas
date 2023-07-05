<?php
require_once 'database.class.php';
require_once 'quadrado.class.php';
require_once 'retangulo.class.php';
require_once 'triangulo.class.php';
require_once 'circulo.class.php';

class Quadro{
    private $id;
    private $nome;
    private $formas;
    
    public function __construct($id, $nome){
        $this->setId($id);
        $this->setNome($nome);
        $this->formas = array();
        $this->getFormas();
    }
    public function setId($id){ $this->id = $id;}
    public function setNome($nome){ $this->nome = $nome; }
    public function getNome(){return $this->nome;}
    public function getId(){return $this->id;}

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO quadro (nome)
                      VALUES (:nome)';
        $params = array(
            ':nome'=>$this->getNome()
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
        Database::executar($sql, $params);

        $sql = 'DELETE FROM retangulo 
                  WHERE idretangulo = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        Database::executar($sql, $params);

        $sql = 'DELETE FROM triangulo 
                  WHERE idtriangulo = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        Database::executar($sql, $params);

        $sql = 'DELETE FROM circulo 
                  WHERE idcirculo = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        Database::executar($sql, $params);

        $sql = 'DELETE FROM quadro 
                  WHERE id = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE quadro
                    SET nome = :nome
                  WHERE   id = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':nome'=> $this->getNome()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
        
    }
  
    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM quadro';
        switch($tipo){
            case 1: $sql .= ' WHERE id = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

    private function getFormas(){
        $sql = 'SELECT * FROM quadrado 
                WHERE idquadro = :id';
        $params = array(':id'=>$this->getId());     
        $resultado = Database::listar($sql, $params);
        foreach($resultado as $item){
            $q = new Quadrado($item['idquadrado'], $item['lado'], $item['cor'], $item['un'], $item['idquadro']);
            $this->addForma($q);
        }

        $sql = 'SELECT * FROM retangulo 
                WHERE idquadro = :id';
        $params = array(':id'=>$this->getId());     
        $resultado = Database::listar($sql, $params);
        foreach($resultado as $item){
            $r = new Retangulo($item['idretangulo'], $item['lado'], $item['lado2'], $item['cor'], $item['un'], $item['idquadro']);
            $this->addForma($r);
        }

        $sql = 'SELECT * FROM triangulo 
                WHERE idquadro = :id';
        $params = array(':id'=>$this->getId());     
        $resultado = Database::listar($sql, $params);
        foreach($resultado as $item){
            $t = new Triangulo($item['idtriangulo'], $item['lado'], $item['lado2'], $item['lado3'], $item['cor'], $item['un'], $item['idquadro']);
            $this->addForma($t);
        }

        $sql = 'SELECT * FROM circulo 
                WHERE idquadro = :id';
        $params = array(':id'=>$this->getId());     
        $resultado = Database::listar($sql, $params);
        foreach($resultado as $item){
            $c = new Circulo($item['idcirculo'], $item['raio'], $item['cor'], $item['un'], $item['idquadro']);
            $this->addForma($c);
        }
    }

    public function addForma(Forma $forma){
        $this->formas[] = $forma;
    }

    public function listarFormas(){
        foreach($this->formas as $forma){
            echo $forma->desenhar();
        }
    }
}
?>