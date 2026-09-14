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

    <title>Configurações - AutiWorld</title>


    <link
        href="../../public/css/style-configuracoes.css"
        rel="stylesheet"
        type="text/css">


    <link
        href="../../public/css/acessibilidade.css"
        rel="stylesheet"
        type="text/css">

    <script
        src="../../public/js/configuracoes.js"
        defer></script>

</head>


<body>


    <div class="cabecalho">


        <!-- ==================================================
         CABEÇALHO SUPERIOR
    ================================================== -->

        <div class="cabecalho-up">


            <!-- TÍTULO -->

            <h1>
                AutiWorld🧩
            </h1>


            <!-- NOTIFICAÇÃO -->

            <div class="notificao">

                <button
                    id="notificacaoButton"
                    type="button"
                    aria-label="Notificações">
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



        <!-- ==================================================
         ÁREA PRINCIPAL
    ================================================== -->

        <div class="cabecalho-down">


            <!-- BOTÃO VOLTAR -->

            <div class="area-voltar">

                <a
                    href="DashBoard.php"
                    class="botao-voltar"
                    aria-label="Voltar para o Dashboard">
                    ←
                </a>

            </div>



            <!-- ==================================================
             CONFIGURAÇÕES
        ================================================== -->

            <main class="area-configuracoes">


                <div class="titulo-configuracoes">

                    <h2>
                        Configurações
                    </h2>

                    <p>
                        Personalize o AutiWorld de acordo
                        com suas necessidades.
                    </p>

                </div>



                <!-- ==================================================
                 ACESSIBILIDADE
            ================================================== -->

                <section class="bloco-configuracoes">


                    <h3 class="titulo-bloco">
                        Acessibilidade
                    </h3>



                    <!-- ALTO CONTRASTE -->

                    <div class="config-item">

                        <div class="config-info">

                            <div class="config-icone">
                                ◐
                            </div>

                            <div>

                                <h4>
                                    Alto contraste
                                </h4>

                                <p>
                                    Aumenta o contraste entre o
                                    fundo, textos e elementos
                                    da página.
                                </p>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                id="altoContraste">

                            <span class="slider"></span>

                        </label>

                    </div>

                    <!-- MODO LEITURA -->

                    <div class="config-item">

                        <div class="config-info">

                            <div class="config-icone">
                                Aa
                            </div>

                            <div>

                                <h4>
                                    Modo leitura
                                </h4>

                                <p>
                                    Aumenta o espaçamento e
                                    facilita a leitura dos textos.
                                </p>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                id="modoLeitura">

                            <span class="slider"></span>

                        </label>

                    </div>



                    <!-- REDUZIR ANIMAÇÕES -->

                    <div class="config-item">

                        <div class="config-info">

                            <div class="config-icone">
                                ✦
                            </div>

                            <div>

                                <h4>
                                    Reduzir animações
                                </h4>

                                <p>
                                    Diminui animações e transições
                                    presentes no sistema.
                                </p>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                id="reduzirAnimacoes">

                            <span class="slider"></span>

                        </label>

                    </div>



                    <!-- TAMANHO DA FONTE -->

                    <div class="config-item">

                        <div class="config-info">

                            <div class="config-icone">
                                T
                            </div>

                            <div>

                                <h4>
                                    Tamanho da fonte
                                </h4>

                                <p>
                                    Escolha o tamanho dos textos
                                    em todo o sistema.
                                </p>

                            </div>

                        </div>


                        <div class="tamanhos-fonte">

                            <button
                                type="button"
                                class="botao-fonte"
                                data-tamanho="90"
                                aria-label="Fonte pequena">
                                A
                            </button>


                            <button
                                type="button"
                                class="botao-fonte"
                                data-tamanho="100"
                                aria-label="Fonte normal">
                                A
                            </button>


                            <button
                                type="button"
                                class="botao-fonte"
                                data-tamanho="110"
                                aria-label="Fonte grande">
                                A
                            </button>


                            <button
                                type="button"
                                class="botao-fonte"
                                data-tamanho="125"
                                aria-label="Fonte muito grande">
                                A
                            </button>

                        </div>

                    </div>



                    <!-- RESTAURAR -->

                    <div class="area-restaurar">

                        <button
                            type="button"
                            id="restaurarConfiguracoes"
                            class="botao-restaurar">
                            Restaurar configurações
                        </button>

                    </div>


                </section>


            </main>


        </div>


    </div>
    <script src="../../public/js/script.js"></script>
</body>

</html>