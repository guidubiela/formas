<?php
require_once 'database.class.php';

class Quadro{
    private $id;
    private $nome;
    private $formas;
    
    public function __construct($id, $nome){
        $this->setId($id);
        $this->setNome($nome);
        $this->formas = array();
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
  
    public function listar($tipo = 0, $info = ''){
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

    public function formasQuadro(){
        $conexao = Database::conectar();
        $sql = 'SELECT idquadrado, idretangulo, idtriangulo, idcirculo FROM quadro 
                NATURAL JOIN quadrado NATURAL JOIN retangulo NATURAL JOIN triangulo NATURAL JOIN circulo;';
        $comando = Database::preparar($conexao, $sql, $params);
        if ($comando->execute()) {
            return $comando->fetch(PDO::FETCH_ASSOC);
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