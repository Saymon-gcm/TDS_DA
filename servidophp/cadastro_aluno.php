<!DOCTYPE html>
<html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de alunos</title>
</head>
<body>
    <h1>Cadastro aluno</h1>
    <form method="post" action="salvar.php">
        <label>Nome do aluno:<label>
        <input type="text" name="nome" placeholder="Digite o nome"/>
        <br />
        <label>E-mail:</label>
        <input type="email" name="email" placeholder="Digite o nome" />
        <br />
        <input type="submit" name="cadastrar" value="cadastrar" />
    </form>
    <form method="post" action="vizualizar.php">
         <input type="submit" name="vizualizar" value="Vizualizar" />
    </form>
</body>
</html>