<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $lado = isset($_POST['lado']) ? $_POST['lado']: 0;
    $lado2 = isset($_POST['lado2']) ? $_POST['lado2']: 0;
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
            require_once('../classes/retangulo.class.php');
            $retangulo = new Retangulo($id,$lado,$lado2,$cor,$un,$idquadro);
            $retangulo->editar();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else {
        try{
            require_once('../classes/retangulo.class.php');
            $retangulo = new Retangulo($id,$lado,$lado2,$cor,$un,$idquadro);
            $retangulo->inserir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    if ($acao == 'excluir'){
        try{
            require_once('../classes/retangulo.class.php');
            $retangulo = new Retangulo($id,$lado,$lado2,$cor,$un,$idquadro);
            $retangulo->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>  