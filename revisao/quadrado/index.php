<?php
require_once('../classes/quadrado.class.php');
$quadrado = new Quadrado('',1,'x','x');

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

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
    <title>Cadastro de Quadrados</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Cadastro de quadrados</h1>
    <section>
        <form action="acaoquadrado.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['id']; else echo 0; ?>'>
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
            $q = new Quadrado($item['id'],$item['lado'],$item['cor'],$item['un']);
            echo '<a draggable="true" href="index.php?id='.$q->getId().'">';
            echo $q->desenhar();
            echo '</a>';
        }
    ?>

    </div>
    
</body>
</html>