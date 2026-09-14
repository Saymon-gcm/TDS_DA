<?php

session_name("Projeto_Sistema");
session_start();

/* ==================================================
   IMPEDIR CACHE DO NAVEGADOR (botao voltar)
================================================== */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "../models/user.php";


/* ==================================================
   VERIFICAR LOGIN
================================================== */

if (!isset($_SESSION["id_usuarios"])) {

    header("Location: ../../index.php");
    exit;

}


/* ==================================================
   BUSCAR USUÁRIO
================================================== */

$usuario = new User();

$dadosUsuario = $usuario->ListarUmUsuario(
    $_SESSION["id_usuarios"]
);


/* ==================================================
   FOTO DE PERFIL
================================================== */

if (!empty($dadosUsuario["url"])) {

    $fotoPerfil = "../../" . $dadosUsuario["url"];

} else {

    $fotoPerfil =
        "../../public/css/img/imagem-de_perfil.jpg";

}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AutiWorld</title>

    <link href="../../public/css/style-Atividades.css" rel="stylesheet" type="text/css">
    <link href="../../public/css/acessibilidade.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="cabecalho">

        <!-- =========================
             CABEÇALHO SUPERIOR
        ========================== -->

        <div class="cabecalho-up">

            <h1>AutiWorld🧩</h1>

            <!-- NOTIFICAÇÃO -->

            <div class="notificao">

                <button id="notificacaoButton">
                    🔔
                </button>

            </div>


            <!-- CAIXA DE NOTIFICAÇÃO -->

            <div id="caixaMensagem" class="caixa">

                <p>Olá! Esta é uma pequena mensagem.</p>

            </div>


            <!-- PERFIL -->

           <div
                class="perfil"
                id="perfil">

                <img
                    src="<?= htmlspecialchars($fotoPerfil) ?>"
                    alt="Foto de Perfil">
            </div>


            <!-- MENU DO PERFIL -->

            <div class="menu-perfil" id="menuPerfil">

                <a href="perfil.php">
                    👤 Meu Perfil
                </a>

                <a href="informacoes.php">
                    🧩 Informações(IS)
                </a>

                <a href="configuracoes.php">
                    ⚙️ Configurações
                </a>

                <a href="../controllers/logout.php">
                    🚪 Sair
                </a>

            </div>

        </div>


        <!-- =========================
             ÁREA DOS CARDS
        ========================== -->

        <div class="cabecalho-down">


            <!-- BOTÃO VOLTAR -->

            <div class="area-voltar">

                <a
                    href="DashBoard.php"
                    class="botao-voltar">
                    ←
                </a>

            </div>


            <!-- CONTAINER DOS CARDS -->

            <div class="container">
                <a href="associacao.php">
                <button class="card">
                    <img src="../../public/css/img/associacao.png" alt="Associação">
                    <span>Associação de Imagens</span>
                </button>
                </a>

                <a href="desenhar.php">
                    <button class="card">
                        <img src="../../public/css/img/desenhar.png" alt="Desenhar">
                        <span>Desenhar</span>
                    </button>
                </a>

                <a href="letras.php">
                    <button class="card">
                        <img src="../../public/css/img/letras.png" alt="Letras">
                        <span>Letras</span>
                    </button>
                </a>

                <a href="emocoes.php">
                    <button class="card">
                        <img src="../../public/css/img/emocoes.png" alt="Emoções">
                        <span>Emoções</span>
                    </button>
                </a>

                <a href="memoria.php">
                    <button class="card">
                        <img src="../../public/css/img/memoria.png" alt="Memória">
                        <span>Memória</span>
                    </button>
                </a>

                <a href="quebra-cabeca.php">
                    <button class="card">
                        <img src="../../public/css/img/quebra_cabeca.png" alt="Quebra-cabeça">
                        <span>Quebra-cabeça</span>
                    </button>
                </a>

                <a href="sons.php">
                    <button class="card">
                        <img src="../../public/css/img/sons.png" alt="Sons">
                        <span>Sons</span>
                    </button>
                </a>

                <a href="cores.php">
                    <button class="card">
                        <img src="../../public/css/img/cores.png" alt="Cores">
                        <span>Cores</span>
                    </button>
                </a>

                <a href="sequencia.php">
                    <button class="card">
                        <img src="../../public/css/img/sequencias.png" alt="Sequências">
                        <span>Sequências</span>
                    </button>
                </a>

                <a href="coordenacao.php">
                    <button class="card">
                        <img src="../../public/css/img/coordenacao.png" alt="Coordenação">
                        <span>Coordenação Motora</span>
                    </button>
                </a>

                <a href="atencao.php">
                    <button class="card">
                        <img src="../../public/css/img/atencao.png" alt="Atenção">
                        <span>Atenção Visual</span>
                    </button>
                </a>

                <a href="logica.php">
                    <button class="card">
                        <img src="../../public/css/img/logica.png" alt="Lógica">
                        <span>Lógica</span>
                    </button>
                </a>

            </div>

        </div>

    </div>


    <script src="../../public/js/script.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>