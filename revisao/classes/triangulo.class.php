<?php
require_once('../classes/forma.class.php');
require_once ('../classes/database.class.php');

class Triangulo extends Forma{
    private $lado2;
    private $lado3;

    public function __construct($id, $lado, $lado2, $lado3, $cor, $un){
        parent::__construct($id, $lado, $cor, $un);
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

    public function setLado1($lado1){
        if ($lado1 > 0){
            parent::setLado($lado1);
        }else
            throw new Exception('Valor para o lado 1 inválido.');
    }

    public function getLado1(){
        return parent::getLado();
    }

    public function getLado2(){
        return $this->lado2;
    }

    public function getLado3(){
        return $this->lado3;
    }

    public function inserir(){
        $sql = 'INSERT INTO triangulo (lado, lado2, lado3, cor, un)
                     VALUES (:lado,:lado2,:lado3, :cor, :un)';
        $params = array(':lado'=> $this->getLado1(),
                        ':lado2'=> $this->getLado2(),
                        ':lado3'=> $this->getLado3(),
                        ':cor'=> $this->getCor(),
                        ':un'=> $this->getUn());
        Database::executar($sql, $params);
    }

    public function excluir(){} 
    public function editar(){}
    public function desenhar(){}
    public function calcularArea(){
        if ($this->getLado1 == $this->getLado2 && $this->getLado1 == $this->getLado3 && $this->getLado2 == $this->getLado3){
            $lado = $this->getLado1();
            $base = $this->getLado2();
            $altura = (pow($lado) * sqrt(3)) / 4;
            $area = $base * $altura / 2;
        }
        else if ($this->getLado1 == $this->getLado2 || $this->getLado1 == $this->getLado3 || $this->getLado2 == $this->getLado3){
            $lado = max($this->getLado1(), $this->getLado2(), $this->getLado3());
            $base = min($this->getLado1(), $this->getLado2(), $this->getLado3());

            $altura = pow($lado,  2) - pow($base, 2);
            $area = $base *  $altura / 2;
        }
        else{
            $p = $this->calcularPerimetro() / 2;
            $area = sqrt($p * ($p - $this->getLado1()) * ($p - $this->getLado2()) * ($p - $thisd->getLado3()));
        }

        return $area;
    }

    public function calcularPerimetro(){
        $perimetro = $this->getLado1() +  $this->getLado2() + $this->getLado3();
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