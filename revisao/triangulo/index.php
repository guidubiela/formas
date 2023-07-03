<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Triângulo</title>
</head>
<body>
    <h1>Cadastro de Triângulo</h1>
    <form action="acaotriangulo.php" method="post">
        <label for="id">Id:</label>
        <input readonly type="text" name='id' id='id' >
        <label for="lado1">Lado 1:</label>
        <input type="text" name='lado1' id='lado1' >
        <label for="lado2"> Lado 2:</label>
        <input type="text" name='lado2' id='lado2' >
        <label for="lado3"> Lado 3:</label>
        <input type="text" name='lado3' id='lado3' >
        <label for="cor">Cor:</label>
        <input type="color" name='cor' id='cor' >
        <label for="un">UN:</label>
        <select name='un' id='un'>
                <option value=''>Selecione</option>
                <option value='cm' <?php  if($qeditando) if ($qeditando->getUn() == 'cm') echo 'selected'; ?> >Centímetros</option>
                <option value='px' <?php  if($qeditando) if ($qeditando->getUn() == 'px') echo 'selected'; ?>  >Pixel</option>
                <option value='%' <?php  if($qeditando) if ($qeditando->getUn() == '%') echo 'selected'; ?> >Porcentagem</option>
                <option value='vh' <?php  if($qeditando) if ($qeditando->getUn() == 'vh') echo 'selected'; ?> >View Port Height</option>
                <option value='vw' <?php  if($qeditando) if ($qeditando->getUn() == 'vw') echo 'selected'; ?> >View Port Width</option>
        </select>
        <button name='acao' type='submit' id='acao' value='salvar'>Salvar</button>
    </form>
</body>
</html>