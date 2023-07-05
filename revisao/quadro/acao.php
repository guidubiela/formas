<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $nome = isset($_POST['nome']) ? $_POST['nome']: '';

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if ($acao == 'salvar'){
        try{
            require_once('../classes/quadro.class.php');
            $quadro = new Quadro($id, $nome);
            $quadro->inserir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else if ($acao == 'editar'){
        try{
            require_once('../classes/quadro.class.php');
            $quadro = new Quadro($id, $nome);
            $quadro->editar();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    else if ($acao == 'excluir'){
        try{
            require_once('../classes/quadro.class.php');
            $quadro = new Quadro($id, $nome);
            $quadro->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    function findById($id){
        $conexao = new PDO(MYSQL_DNS, MYSQL_USUARIO, MYSQL_SENHA);
        $conexao = $conexao->query("SELECT * FROM quadro WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>  