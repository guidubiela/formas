<?php
require_once('../classes/quadrado.class.php');
$quadrado = new Quadrado('',1,'x','x','x');

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

function findById($id){
    $conexao = Database::conectar();
    $conexao = $conexao->query("SELECT * FROM quadrado WHERE idquadrado = $id;");
    $result = $conexao->fetch(PDO::FETCH_ASSOC);
    return $result;
}

$id = isset($_GET['id'])?$_GET['id']:0;
if ($id > 0){
   $dados = findById($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Cadastro de Quadrados</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <a href="../quadro/"><button>Voltar</button></a>
    <h1>Cadastro de quadrados</h1>
    <section>
        <form action="acaoquadrado.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['idquadrado']; else echo 0; ?>'>
            <label for="lado">Lado:</label>
            <input type="text" name='lado' id='lado' value='<?php if($acao == 'editar') echo $dados['lado']; ?>'>
            <label for="un">UN:</label>
            <select name='un' id='un'>
                <option value=''>Selecione</option>
                <option value='cm' <?php if($acao == 'editar') if ($dados['un'] == 'cm') echo 'selected'; ?>>Centímetros</option>
                <option value='px' <?php if($acao == 'editar') if ($dados['un'] == 'px') echo 'selected'; ?>>Pixel</option>
                <option value='%' <?php if($acao == 'editar') if ($dados['un'] == '%') echo 'selected'; ?>>Porcentagem</option>
                <option value='vh' <?php if($acao == 'editar') if ($dados['un'] == 'vh') echo 'selected'; ?>>View Port Height</option>
                <option value='vw' <?php if($acao == 'editar') if ($dados['un'] == 'vw') echo 'selected'; ?>>View Port Width</option>
            </select>
            <label for="cor">Cor:</label>
            <input type="color" name='cor' id='cor' value='<?php if($acao == 'editar') echo $dados['cor']; ?>'>
            <label for="quadro">Quadro:</label>
            <select name="idquadro" id="idquadro">
                <?php
                    $conexao = Database::conectar();
                    $sql = $conexao->query('SELECT * FROM quadro');
                    while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
                        if($acao == 'editar'){
                            if($linha['id'] == $dados['id']){
                                echo "<option value='{$linha['id']}' selected>{$linha['nome']}</option>";
                            }
                            else{
                                echo "<option value='{$linha['id']}'>{$linha['nome']}</option>";
                            }
                        }
                        else{
                            echo "<option value='{$linha['id']}'>{$linha['nome']}</option>";
                        }
                    }
                ?>
            </select>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
            <?php if($acao == 'editar'){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
        </form>
    </section>
    <hr>
    <div style='height:70vw'>
    <?php
        $lista = $quadrado->listar();
        foreach($lista as $item){
            $q = new Quadrado($item['idquadrado'],$item['lado'],$item['cor'],$item['un'],$item['idquadro']);
            echo '<a draggable="true" href="index.php?acao=editar&id='.$q->getId().'">';
            echo $q->desenhar();
            echo '</a>';
        }
    ?>

    </div>
    
</body>
</html>