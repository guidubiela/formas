<?php
require_once('../classes/forma.class.php');
require_once ('../classes/database.class.php');

class Triangulo extends Forma{
    
    private $lado2;
    private $lado3;
    private $idquadro;

    public function __construct($id, $lado, $lado2, $lado3, $cor, $un, $idquadro){
        parent::__construct($id, $lado, $cor, $un, $idquadro);
        $this->setIdQuadro($idquadro);
        $this->setLado2($lado2);
        $this->setLado3($lado3);
    }

    public function setLado2($lado2){
        if ($lado2 > 0){
            $this->lado2 = $lado2;
        }else
            throw new Exception('Valor para o lado 2 inválido.');
    }

    public function setLado3($lado3){
        if ($lado3 > 0){
            $this->lado3 = $lado3;
        }else
            throw new Exception('Valor para o lado 3 inválido.');
    }

    public function getLado2(){
        return $this->lado2;
    }

    public function getLado3(){
        return $this->lado3;
    }

    public function setIdQuadro($idquadro) {
        $this->idquadro = $idquadro;
    }

    public function getIdQuadro() {
        return $this->idquadro;
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO triangulo (lado, lado2, lado3, cor, un, idquadro)
                      VALUES (:lado, :lado2, :lado3, :cor, :un, :idquadro)';
        $params = array(
            ':lado'=>$this->getLado(),
            ':lado2'=>$this->getLado2(),
            ':lado3'=>$this->getLado3(),
            ':cor'=>$this->getCor() ,
            ':un'=>$this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM triangulo 
                  WHERE idtriangulo = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE triangulo
                    SET lado = :lado,
                        lado2 = :lado2,
                        lado3 = :lado3,
                        cor  = :cor,
                        un   = :un,
                        idquadro = :idquadro
                  WHERE   idtriangulo = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':lado'=> $this->getLado(),
            ':lado2'=> $this->getLado2(),
            ':lado3'=> $this->getLado3(),
            ':cor'=> $this->getCor(),
            ':un'=> $this->getUn(),
            ':idquadro'=>$this->getIdQuadro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
        
    }
  
    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM triangulo';
        switch($tipo){
            case 1: $sql .= ' WHERE idtriangulo = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

    public function desenhar(){
        $desenho = "<div draggable='true' class='desenho' 
                    style='width:0;height:0;
                    border-bottom:{$this->getLado()}{$this->getUn()} solid{$this->getCor()};
                    border-left:{$this->getLado2()}{$this->getUn()} solid transparent;
                    border-right:{$this->getLado3()}{$this->getUn()} solid transparent;'></div>";
        return $desenho;
    }

    public function calcularArea(){
        if ($this->getLado1 == $this->getLado2 && $this->getLado1 == $this->getLado3 && $this->getLado2 == $this->getLado3){
            $lado = $this->getLado();
            $base = $this->getLado2();
            $altura = (pow($lado) * sqrt(3)) / 4;
            $area = $base * $altura / 2;
        }
        else if ($this->getLado1 == $this->getLado2 || $this->getLado1 == $this->getLado3 || $this->getLado2 == $this->getLado3){
            $lado = max($this->getLado(), $this->getLado2(), $this->getLado3());
            $base = min($this->getLado(), $this->getLado2(), $this->getLado3());

            $altura = pow($lado,  2) - pow($base, 2);
            $area = $base *  $altura / 2;
        }
        else{
            $p = $this->calcularPerimetro() / 2;
            $area = sqrt($p * ($p - $this->getLado()) * ($p - $this->getLado2()) * ($p - $thisd->getLado3()));
        }

        return $area;
    }

    public function calcularPerimetro(){
        $perimetro = $this->getLado() +  $this->getLado2() + $this->getLado3();
        return $perimetro;  
    }
}
/* 
Triângulo Equilátero
Possui todos os lados e ângulos internos com a mesma medida
Validar o tipo comparando medidas

a = (l² * raiz(3))/4
a = altura, l = lado
=============================================================
Triângulo Isósceles
Possui dois lados e dois ângulos iguais
Calular a base com o teorema de Pitágoras
h = l² - b² (h = altura, l = usar o maior lado, b = base, usar o menor lado)

area = (b * h)/2
=============================================================
Triângulo Escaleno
Tem todos os lados e ângulos diferentes
Como não temos a informação do ângulo, podemos usar a 
fórmula de Heron (que também calcula a área de qualquer triângulo...)
Calcular o perímetro do triângulo (fazer uma função para isso)
p = perímetro / 2
area = raiz(p*(p - l1)*(p-l2)*(p-l3)) 
l1, l2, l3 = são os lados do triângulo
*/
?>