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
        href="../../public/css/style-desenhar.css"
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

                <button id="notificacaoButton">
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
                 ÁREA DE DESENHO
            ========================== -->

            <main class="area-desenho">


                <h2>
                    Desenhar
                </h2>


                <p class="instrucao">

                    Use o espaço abaixo para criar
                    seu desenho.

                </p>


                <!-- CANVAS -->

                <div class="quadro-desenho">

                    <canvas id="canvasDesenho"></canvas>

                </div>


                <!-- =========================
                     FERRAMENTAS
                ========================== -->

                <div class="ferramentas">


                    <!-- CORES -->

                    <div class="grupo-ferramenta">

                        <span>
                            Cor:
                        </span>


                        <button
                            class="cor selecionada"
                            data-cor="#000000"
                            style="background-color: #000000;">
                        </button>


                        <button
                            class="cor"
                            data-cor="#FF0000"
                            style="background-color: #FF0000;">
                        </button>


                        <button
                            class="cor"
                            data-cor="#0066FF"
                            style="background-color: #0066FF;">
                        </button>


                        <button
                            class="cor"
                            data-cor="#00A651"
                            style="background-color: #00A651;">
                        </button>


                        <button
                            class="cor"
                            data-cor="#FFD000"
                            style="background-color: #FFD000;">
                        </button>


                        <button
                            class="cor"
                            data-cor="#9B30FF"
                            style="background-color: #9B30FF;">
                        </button>

                    </div>


                    <!-- TAMANHO -->

                    <div class="grupo-ferramenta">

                        <label for="tamanhoPincel">

                            Tamanho:

                        </label>


                        <input
                            type="range"
                            id="tamanhoPincel"
                            min="2"
                            max="40"
                            value="8">

                    </div>


                    <!-- BOTÕES -->

                    <div class="grupo-botoes">

                        <button
                            id="borracha"
                            class="botao-ferramenta">

                            🧹 Borracha

                        </button>


                        <button
                            id="limpar"
                            class="botao-ferramenta">

                            🗑️ Limpar

                        </button>

                    </div>

                </div>

            </main>

        </div>

    </div>


    <!-- JAVASCRIPT GERAL -->

    <script src="../../public/js/script.js"></script>


    <!-- JAVASCRIPT DO DESENHO -->

    <script src="../../public/js/desenhar.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>