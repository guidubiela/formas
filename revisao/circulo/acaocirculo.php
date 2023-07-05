<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $raio = isset($_POST['raio']) ? $_POST['raio']: 0;
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
            require_once('../classes/circulo.class.php');
            $circulo = new Circulo($id,$raio,$cor,$un,$idquadro);
            $circulo->editar();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else {
        try{
            require_once('../classes/circulo.class.php');
            $circulo = new Circulo($id,$raio,$cor,$un,$idquadro);
            $circulo->inserir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    if ($acao == 'excluir'){
        try{
            require_once('../classes/circulo.class.php');
            $circulo = new Circulo($id,$raio,$cor,$un,$idquadro);
            $circulo->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>  