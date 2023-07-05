<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $lado = isset($_POST['lado']) ? $_POST['lado']: 0;
    $lado2 = isset($_POST['lado2']) ? $_POST['lado2']: 0;
    $lado3 = isset($_POST['lado3']) ? $_POST['lado3']: 0;
    $cor = isset($_POST['cor']) ? $_POST['cor']: '';
    $un = isset($_POST['un']) ? $_POST['un']: '';
    $idquadro = isset($_POST['idquadro']) ? $_POST['idquadro'] : 0;

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if ($id > 0) {
        try{
            require_once('../classes/triangulo.class.php');
            $triangulo = new Triangulo($id,$lado,$lado2,$lado3,$cor,$un,$idquadro);
            $triangulo->editar();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else {
        try{
            require_once('../classes/triangulo.class.php');
            $triangulo = new Triangulo($id,$lado,$lado2,$lado3,$cor,$un,$idquadro);
            $triangulo->inserir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    if ($acao == 'excluir'){
        try{
            require_once('../classes/triangulo.class.php');
            $triangulo = new Triangulo($id,$lado,$lado2,$lado3,$cor,$un,$idquadro);
            $triangulo->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>  