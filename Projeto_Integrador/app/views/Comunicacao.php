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

    <link href="../../public/css/style-Comunicacao.css" rel="stylesheet" type="text/css">
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


                <button class="card" onclick="falar('Quero comer', this)">

                    <img
                        src="../../public/css/img/comer.png"
                        alt="Comer">

                    <span>Quero comer</span>

                </button>


                <button class="card" onclick="falar('Quero beber', this)">

                    <img
                        src="../../public/css/img/beber.png"
                        alt="Beber">

                    <span>Quero beber</span>

                </button>


                <button class="card" onclick="falar('Preciso ir ao banheiro', this)">

                    <img
                        src="../../public/css/img/banheiro.png"
                        alt="Banheiro">

                    <span>Preciso ir ao banheiro</span>

                </button>


                <button class="card" onclick="falar('Quero brincar', this)">

                    <img
                        src="../../public/css/img/brincar.png"
                        alt="Brincar">

                    <span>Quero brincar</span>

                </button>


                <button class="card" onclick="falar('Estou cansado', this)">

                    <img
                        src="../../public/css/img/cansado.png"
                        alt="Descansar">

                    <span>Estou cansado</span>

                </button>


                <button class="card" onclick="falar('Estou feliz', this)">

                    <img
                        src="../../public/css/img/feliz.png"
                        alt="Feliz">

                    <span>Estou feliz</span>

                </button>


                <button class="card" onclick="falar('Estou triste', this)">

                    <img
                        src="../../public/css/img/triste.png"
                        alt="Triste">

                    <span>Estou triste</span>

                </button>


                <button class="card" onclick="falar('Estou irritado', this)">

                    <img
                        src="../../public/css/img/irritado.png"
                        alt="Irritado">

                    <span>Estou irritado</span>

                </button>


                <button class="card" onclick="falar('Estou com dor', this)">

                    <img
                        src="../../public/css/img/dor.png"
                        alt="Dor">

                    <span>Estou com dor</span>

                </button>


                <button class="card" onclick="falar('Não estou bem', this)">

                    <img
                        src="../../public/css/img/nao_bem.png"
                        alt="Não estou bem">

                    <span>Não estou bem</span>

                </button>


                <button class="card" onclick="falar('Quero ir para casa', this)">

                    <img
                        src="../../public/css/img/casa.png"
                        alt="Casa">

                    <span>Quero ir para casa</span>

                </button>


                <button class="card" onclick="falar('Quero minha mãe', this)">

                    <img
                        src="../../public/css/img/mae.png"
                        alt="Mãe">

                    <span>Quero minha mãe</span>

                </button>


                <button class="card" onclick="falar('Quero meu pai', this)">

                    <img
                        src="../../public/css/img/pai.png"
                        alt="Pai">

                    <span>Quero meu pai</span>

                </button>


                <button class="card" onclick="falar('Quero minha familia', this)">

                    <img
                        src="../../public/css/img/familia.png"
                        alt="Familia">

                    <span>Quero minha familia</span>

                </button>


                <button class="card" onclick="falar('Preciso de ajuda', this)">

                    <img
                        src="../../public/css/img/ajuda.png"
                        alt="Ajuda">

                    <span>Preciso de ajuda</span>

                </button>


            </div>

        </div>

    </div>
    <!-- =========================================
     MODAL DA IMAGEM AMPLIADA
========================================= -->

    <div id="modalImagem" class="modal-imagem">

        <div class="fundo-modal"></div>

        <div class="imagem-ampliada-container">

            <img
                id="imagemAmpliada"
                src=""
                alt="Imagem ampliada">

        </div>

    </div>

    <script src="../../public/js/script.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>