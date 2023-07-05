<!DOCTYPE html>
<html lang="en">
<?php 
    require_once '../config/config.inc.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $id = isset($_GET['id']) ? $_GET['id']:0;

    if ($id > 0){
        $dados = findById($id);
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Cadastro de Quadros</title>
</head>
<body>
    <nav>
        <?php include '../navbar.php'; ?>
    </nav>
    <h1>Cadastro de Quadros</h1>
    <section>
        <form action="acao.php" method="post">
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['id']; else echo 0; ?>'>
            <label for="nome">Nome:</label>
            <input type="text" name='nome' id='nome' value='<?php if($acao == 'editar') echo $dados['nome']; ?>'>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
            <?php if ($acao == 'editar'){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
        </form>
    </section>
</body>
</html>