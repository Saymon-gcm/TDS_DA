<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="login-cabecalho">
        <div class="login-lado-esquerdo">
            <div class="logo-pt1">
                <h1>Auti</h1>
            </div>
            <div class="logo-pt2">
                <h1>World</h1>
            </div>
        </div>
        <div class="login-lado-direito">
            <form action="app/controllers/login.php" method="POST">
            <div class="login">
                <h1>Login</h1>
            </div>
            <div class="login-nome-email">
                <img src="public/css/img/login_email-removebg-preview.png" alt="ícone">
                <input type="email" name="email" placeholder=" Email">
            </div>
            <div class="login-senha">
                <img src="public/css/img/chave-removebg-preview.png" alt="ícone">
                <input type="password" name="senha" placeholder=" Senha">
            </div>
            <div class="esq-senha">
                <a class="esq-senha" href="esq-senha.php">Esqueci minha senha.</a>
            </div>
            <div class="login-botao">
                <button type="submit" name="botao" value="login">
                <h1>Entrar</h1>
                </button>
            </form>
            </div>
            <div class="login-cadastrar">
                <a class="Cad-user"  href="cadastrar.php">Cadastrar-se</a>
            </div>
        </div>
    </div>
</body>
</html>