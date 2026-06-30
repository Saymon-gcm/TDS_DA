<?php
session_name("painel");
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="public/css/style-cadastrar.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="cadastrar-cabecalho">
        <div class="cadastrar-lado-esquerdo">
            <div class="logo-pt1">
                <h1>Auti</h1>
            </div>
            <div class="logo-pt2">
                <h1>World</h1>
            </div>
        </div>
        <div class="cadastrar-lado-direito">
            <form action="app/controllers/cadastrar_usuario_controller.php" method="POST">
            <div class="cadastrar">
                <h1>cadastrar</h1>
            </div>
            <div class="cadastrar-nome">
                <img src="public/css/img/login_email-removebg-preview.png" alt="ícone">
                <input type="text" name="nome" placeholder=" Nome">
            </div>
            <div class="cadastrar-email">
                <img src="public/css/img/email_-removebg-preview.png" alt="ícone">
                <input type="email" name="email" placeholder=" Email">
            </div>
            <div class="cadastrar-senha">
                <img src="public/css/img/chave-removebg-preview.png" alt="ícone">
                <input type="password" name="senha" placeholder=" Senha">
            </div>
            <div class="cadastrar-botao">
            <button type="submit" name="botao" value="cadastrar">
                <h1>Cadastrar-se</h1>
                
            </button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>