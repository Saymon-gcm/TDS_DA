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
        href="../../public/css/style-cores.css"
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
                 JOGO DAS CORES
            ========================== -->

            <main class="jogo-cores">


                <h2>
                    Jogo das Cores
                </h2>


                <p class="instrucao">
                    Encontre a cor indicada.
                </p>


                <!-- =========================
                     INFORMAÇÕES
                ========================== -->

                <div class="informacoes">

                    <div>
                        Rodada:
                        <strong id="rodada">
                            1
                        </strong>/10
                    </div>


                    <div>
                        Acertos:
                        <strong id="acertos">
                            0
                        </strong>
                    </div>

                </div>


                <!-- =========================
                     COR ALVO
                ========================== -->

                <div class="pergunta-cor">

                    <p>
                        Encontre esta cor:
                    </p>


                    <div
                        id="corAlvo"
                        class="cor-alvo">

                    </div>


                    <div
                        id="nomeCor"
                        class="nome-cor">

                        Azul

                    </div>

                </div>


                <!-- =========================
                     OPÇÕES
                ========================== -->

                <div
                    id="opcoesCores"
                    class="opcoes-cores">

                </div>


                <!-- =========================
                     FEEDBACK
                ========================== -->

                <div
                    id="feedback"
                    class="feedback">

                </div>


                <!-- =========================
                     PRÓXIMA
                ========================== -->

                <button
                    id="proxima"
                    class="botao-proxima"
                    type="button">

                    Próxima

                </button>


                <!-- =========================
                     RESULTADO
                ========================== -->

                <div
                    id="resultado"
                    class="resultado">

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


    <script src="../../public/js/script.js"></script>

    <script src="../../public/js/cores.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>