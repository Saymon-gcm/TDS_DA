<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="../../public/css/style-pagina-inicial.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="pag-inic">
        <div class="pag-inic-ld-esq">
            <div class="titulo">
                <img src="../../public/css/img/logo.png" alt="ícone">
                <h1>Agenda</h1>
            </div>
            <div class="item-1">
                <a href="pagina-inicial.php">
                <button type="submit" name="botao" value="dashboard">
                <h1>DashBoard</h1>
                </button>
                </a>
                <img src="../../public/css/img/icone-casa-removebg-preview.png"alt="ícone">
            </div>
            <div class="item-2">
                <a href="contatos.php">
                <button type="submit" name="botao" value="dashboard">
                <h1>Contatos</h1>
                </button>
                </a>
                <img src="../../public/css/img/icone-contatos-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-3">
                <a href="compromissos.php">
                <button type="submit" name="botao" value="dashboard">
                <h1>Compromissos</h1>
                </button>
                </a>
                <img src="../../public/css/img/icone-agenda-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-4">
                <a href="perfil.php">
                <button type="submit" name="botao" value="dashboard">
                <h1>Perfil</h1>
                </button>
                </a>
                <img src="../../public/css/img/icone-perfil-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-5">
                <a href="configuracoes.php">
                <button type="submit" name="botao" value="dashboard">
                <h1>Configurações</h1>
                </button>
                </a>
                <img src="../../public/css/img/icone-engrenagem-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-6">
                <button type="submit" name="botao" value="dashboard">
                <h1>Sair</h1>
                </button>
                <img src="../../public/css/img/icone-sair-removebg-preview.png" alt="ícone">
            </div>
        </div>
        <div class="pag-inic-ld-dir">
            <div class="cabecalho-cima">
                <img src="../../public/css/img/icone-lupa-removebg-preview.png" alt="ícone">
                <input type="text" name="pesquisa" placeholder="Pesquisar" class="pesquisa">
                <button class="notificacao">
                    🔔
                </button>
            </div>
            <hr>
            <div class="cabecalho-baixo">
                <div class="mensagem">
                    <h1>Olá, !👋</h1>
                    <h2>Bem-vindo á sua agenda eletrôníca</h2>
                </div>
                <div style="clear: both;">&nbsp;</div>
                <div class="cards">
                    <div class="card-1">
                        <h1>👨‍👩‍👧‍👦 Contatos</h1>
                        <h2>Total de contatos</h2>
                    </div>
                    <div class="card-2">
                        <h1>📆 Compromissos</h1>
                        <h2>Próximos 7 dias</h2>
                    </div>
                    <div class="card-3">
                        <h1>📝 Tarefas</h1>
                        <h2>Pendentes</h2>
                    </div>
                    <div class="card-4">
                        <h1>✅ Concluido</h1>
                        <h2>Este mês</h2>
                    </div>
                </div>
                <div class="cards-baixos">
                    <div class="card-b1">
                        <h1>Próximos compromissos</h1>
                        <hr>

                        <hr>
                        <a class="ver-todos1" href="contatos.php"><h2>Ver todos</h2></a>
                    </div>
                    <div class="card-b2">
                        <h1>Contatos recentes</h1>
                        <hr>

                        <hr>
                        <a class="ver-todos2" href="">Ver todos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>