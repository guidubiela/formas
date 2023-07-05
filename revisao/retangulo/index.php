<?php
    require_once('../classes/retangulo.class.php');
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $id = isset($_GET['id'])?$_GET['id']:0;

    if ($id > 0){
        $dados = Retangulo::listar(1,$id)[0];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Cadastro de Retângulos</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <a href="../quadro/"><button>Voltar</button></a>
    <h1>Cadastro de Retângulos</h1>
    <section>
        <form action="acaoretangulo.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['idretangulo']; else echo 0; ?>'>
            <label for="lado">Lado:</label>
            <input type="text" name='lado' id='lado' value='<?php if($acao == 'editar') echo $dados['lado']; ?>'>
            <label for="lado2">Lado2:</label>
            <input type="text" name='lado2' id='lado2' value='<?php if($acao == 'editar') echo $dados['lado2']; ?>'>
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
            $lista = Retangulo::listar();
            foreach($lista as $item){
                $r = new Retangulo($item['idretangulo'],$item['lado'],$item['lado2'],$item['cor'],$item['un'],$item['idquadro']);
                echo '<a draggable="true" href="index.php?acao=editar&id='.$r->getId().'">';
                echo $r->desenhar();
                echo '</a>';
            }
        ?>
    </div>
</body>
</html>