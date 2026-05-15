<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require_once("Aluno.php");
        $obj = new Aluno();
        $exec = $obj->cadastrarAluno($_POST["nome"],$_POST["email"]);

        if($exec == TRUE)
        {
            $msg = "Aluno Cadastrado com sucesso!";
        }
    
        else
        {
            $msg = "Algo deu de Errado tente novamente!";
        }
    }
    else
    {
        header("Location: cadastro_aluno.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="refresh" content="3;url=cadastro_aluno.php">

    <title>Resultado</title>
</head>
<body>

    <h2><?= $msg; ?></h2>

    <p>Redirecionamento...</p>

</body>
</html>