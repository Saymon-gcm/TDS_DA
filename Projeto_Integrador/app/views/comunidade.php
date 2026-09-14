<?php

session_name("Projeto_Sistema");
session_start();

/* ==================================================
   IMPEDIR CACHE DO NAVEGADOR
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

    $fotoPerfil = "../../public/css/img/imagem-de_perfil.jpg";

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Comunidade - AutiWorld</title>


    <!-- CSS DA COMUNIDADE -->
    <link
        href="../../public/css/style-Comunidade.css"
        rel="stylesheet"
        type="text/css"
    >


    <!-- CSS DE ACESSIBILIDADE -->
    <link
        href="../../public/css/acessibilidade.css"
        rel="stylesheet"
        type="text/css"
    >

</head>


<body>


<div class="cabecalho">


    <!-- ==================================================
         CABEÇALHO SUPERIOR
    ================================================== -->

    <div class="cabecalho-up">


        <!-- LOGO -->
        <h1>
            AutiWorld🧩
        </h1>


        <!-- ==================================================
             NOTIFICAÇÃO
        ================================================== -->

        <div class="notificao">

            <button
                id="notificacaoButton"
                type="button"
                aria-label="Abrir notificações"
            >
                🔔
            </button>

        </div>


        <!-- ==================================================
             CAIXA DE NOTIFICAÇÃO
        ================================================== -->

        <div
            id="caixaMensagem"
            class="caixa"
        >

            <p>
                Olá! Esta é uma pequena mensagem.
            </p>

        </div>


        <!-- ==================================================
             PERFIL
        ================================================== -->

        <div
            class="perfil"
            id="perfil"
        >

            <img
                src="<?= htmlspecialchars($fotoPerfil) ?>"
                alt="Foto de Perfil"
            >

        </div>


        <!-- ==================================================
             MENU DO PERFIL
        ================================================== -->

        <div
            class="menu-perfil"
            id="menuPerfil"
        >

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


    <!-- ==================================================
         ÁREA PRINCIPAL
    ================================================== -->

    <div class="cabecalho-down">


        <!-- ==================================================
             BOTÃO VOLTAR
        ================================================== -->

        <div class="area-voltar">

            <a
                href="DashBoard.php"
                class="botao-voltar"
                aria-label="Voltar para o Dashboard"
            >
                ←
            </a>

        </div>


        <!-- ==================================================
             CONTEÚDO DA COMUNIDADE
        ================================================== -->

        <main class="conteudo-comunidade">


            <!-- ==================================================
                 TÍTULO
            ================================================== -->

            <div class="titulo-comunidade">

                <h2>
                    Comunidade
                </h2>

                <p>
                    Conecte-se com outras pessoas,
                    acompanhe nossas novidades e
                    participe da comunidade AutiWorld.
                </p>

            </div>


            <!-- ==================================================
                 CARDS DAS REDES SOCIAIS
            ================================================== -->

            <section class="cards-comunidade">


                <!-- ==================================================
                     WHATSAPP
                ================================================== -->

                <a
                    href="https://chat.whatsapp.com/KaYexmUiVJ1LtmzW06LYMc"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="card-comunidade card-whatsapp"
                    aria-label="Entrar na comunidade do WhatsApp"
                >

                    <div class="icone-comunidade">
                        💬
                    </div>

                    <h3>
                        WhatsApp
                    </h3>

                    <p>
                        Entre na nossa comunidade do
                        WhatsApp e converse com outras
                        pessoas.
                    </p>

                    <span class="seta-comunidade">
                        →
                    </span>

                </a>


                <!-- ==================================================
                     INSTAGRAM
                ================================================== -->

                <a
                    href="https://www.instagram.com/comunidadeproautismo/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="card-comunidade card-instagram"
                    aria-label="Acessar o Instagram do AutiWorld"
                >

                    <div class="icone-comunidade">
                        📸
                    </div>

                    <h3>
                        Instagram
                    </h3>

                    <p>
                        Acompanhe nossas publicações,
                        novidades e conteúdos do
                        AutiWorld.
                    </p>

                    <span class="seta-comunidade">
                        →
                    </span>

                </a>


                <!-- ==================================================
                     FACEBOOK
                ================================================== -->

                <a
                    href="https://www.facebook.com/groups/1284141732213401/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="card-comunidade card-facebook"
                    aria-label="Acessar o Facebook do AutiWorld"
                >

                    <div class="icone-comunidade">
                        👍
                    </div>

                    <h3>
                        Facebook
                    </h3>

                    <p>
                        Acompanhe a nossa comunidade
                        e fique por dentro das novidades.
                    </p>

                    <span class="seta-comunidade">
                        →
                    </span>

                </a>


            </section>


        </main>


    </div>


    <!-- ==================================================
         RODAPÉ
    ================================================== -->

    <footer class="rodape">

        <p>
            © 2026 AutiWorld - Todos os direitos reservados.
        </p>

    </footer>


</div>


<!-- ==================================================
     JAVASCRIPT
================================================== -->

<script>

    /* ==================================================
       MENU DO PERFIL
    ================================================== */

    const perfil = document.getElementById("perfil");
    const menuPerfil = document.getElementById("menuPerfil");

    perfil.addEventListener("click", function (event) {

        event.stopPropagation();

        menuPerfil.classList.toggle("mostrar");

    });


    /* ==================================================
       NOTIFICAÇÃO
    ================================================== */

    const notificacaoButton =
        document.getElementById("notificacaoButton");

    const caixaMensagem =
        document.getElementById("caixaMensagem");


    notificacaoButton.addEventListener("click", function (event) {

        event.stopPropagation();

        caixaMensagem.classList.toggle("mostrar");

    });


    /* ==================================================
       FECHAR MENUS AO CLICAR FORA
    ================================================== */

    document.addEventListener("click", function () {

        menuPerfil.classList.remove("mostrar");

        caixaMensagem.classList.remove("mostrar");

    });

</script>


    <script src="../../public/js/acessibilidade.js"></script>
</body>

</html>