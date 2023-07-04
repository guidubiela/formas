<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $lado = isset($_POST['lado']) ? $_POST['lado']: 0;
    $cor = isset($_POST['cor']) ? $_POST['cor']: '';
    $un = isset($_POST['un']) ? $_POST['un']: '';

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if ($acao == 'salvar'){
        try{
            require_once('../classes/quadrado.class.php');
            $quadrado = new Quadrado($id,$lado,$cor,$un);
            $quadrado->inserir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else if ($acao == 'editar'){
        try{
            require_once('../classes/quadrado.class.php');
            $quadrado = new Quadrado($id,$lado,$cor,$un);
            $quadrado->editar();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else if ($acao == 'excluir'){
        try{
            require_once('../classes/quadrado.class.php');
            $quadrado = new Quadrado($id,$lado,$cor,$un);
            $quadrado->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    function findById($id){
        $conexao = new PDO(MYSQL_DNS, MYSQL_USUARIO, MYSQL_SENHA);
        $conexao = $conexao->query("SELECT * FROM quadrado WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>  