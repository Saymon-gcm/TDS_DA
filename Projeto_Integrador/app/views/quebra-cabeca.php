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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>AutiWorld</title>

    <link
        href="../../public/css/style-quebra-cabeca.css"
        rel="stylesheet"
        type="text/css">

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

                <button
                    id="notificacaoButton"
                    type="button">

                    🔔

                </button>

            </div>


            <!-- CAIXA DE NOTIFICAÇÃO -->

            <div
                id="caixaMensagem"
                class="caixa">

                <p>
                    Olá! Esta é uma pequena mensagem.
                </p>

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

            <div
                class="menu-perfil"
                id="menuPerfil">

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
             ÁREA PRINCIPAL
        ========================== -->

        <div class="cabecalho-down">


            <!-- BOTÃO VOLTAR -->

            <div class="area-voltar">

                <a
                    href="Atividades.php"
                    class="botao-voltar">

                    ←

                </a>

            </div>


            <!-- =========================
                 JOGO
            ========================== -->

            <main class="jogo-quebra-cabeca">


                <h2>
                    Quebra-Cabeça
                </h2>


                <p class="instrucao">
                    Escolha uma imagem e arraste as peças
                    para o quadro.
                </p>


                <!-- =========================
                     ESCOLHA DA IMAGEM
                ========================== -->

                <div class="escolha-imagens">

                    <p class="titulo-secao">
                        Escolha uma imagem:
                    </p>


                    <div
                        class="lista-imagens"
                        id="listaImagens">

                        <button
                            type="button"
                            class="imagem-opcao"
                            data-imagem="cachorro">

                            <img
                                src="../../public/css/img/quebra-cabeca/cachorros.png"
                                alt="Cachorro">

                        </button>


                        <button
                            type="button"
                            class="imagem-opcao"
                            data-imagem="natureza">

                            <img
                                src="../../public/css/img/quebra-cabeca/natureza.jpg"
                                alt="Natureza">

                        </button>


                        <button
                            type="button"
                            class="imagem-opcao"
                            data-imagem="carro">

                            <img
                                src="../../public/css/img/quebra-cabeca/carro.jpg"
                                alt="Carro">

                        </button>


                        <button
                            type="button"
                            class="imagem-opcao"
                            data-imagem="arcoiris">

                            <img
                                src="../../public/css/img/quebra-cabeca/arcoiris.jpg"
                                alt="Arco-íris">

                        </button>

                    </div>

                </div>


                <!-- =========================
                     INFORMAÇÕES
                ========================== -->

                <div class="informacoes-jogo">

                    <span>
                        Peças:
                        <strong id="pecasColocadas">
                            0
                        </strong>/6
                    </span>


                    <span>
                        Movimentos:
                        <strong id="movimentos">
                            0
                        </strong>
                    </span>

                </div>


                <!-- =========================
                     QUADRO BRANCO
                ========================== -->

                <section class="area-quadro">

                    <p class="titulo-secao">
                        Monte aqui:
                    </p>


                    <div
                        class="quadro-branco"
                        id="quadroBranco">

                        <!-- PEÇAS ENTRAM AQUI -->

                    </div>

                </section>


                <!-- =========================
                     PEÇAS
                ========================== -->

                <section class="area-pecas">

                    <p class="titulo-secao">
                        Peças do quebra-cabeça:
                    </p>


                    <div
                        class="pecas"
                        id="pecas">

                    </div>

                </section>


                <!-- =========================
                     FEEDBACK
                ========================== -->

                <div
                    class="feedback"
                    id="feedback">
                </div>


                <!-- =========================
                     RESULTADO
                ========================== -->

                <div
                    class="resultado"
                    id="resultado">

                    <h3>
                        🎉 Parabéns!
                    </h3>


                    <p id="resultadoTexto">
                    </p>


                    <button
                        id="jogarNovamente"
                        type="button">

                        Jogar novamente

                    </button>

                </div>

            </main>

        </div>

    </div>


    <!-- JAVASCRIPT GERAL -->

    <script src="../../public/js/script.js"></script>


    <!-- JAVASCRIPT DO JOGO -->

    <script src="../../public/js/quebra-cabeca.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>