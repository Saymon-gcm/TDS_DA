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


$usuario = new User();

$dadosUsuario = $usuario->ListarUmUsuario($_SESSION["id_usuarios"]);

$telefoneResponsavel = $dadosUsuario["numero"];


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

    <link
        href="../../public/css/style-DashBoard.css"
        rel="stylesheet"
        type="text/css">

    <link
        href="../../public/css/acessibilidade.css"
        rel="stylesheet"
        type="text/css">
</head>

<body>

    <div class="cabecalho">

        <!-- =========================
             CABEÇALHO SUPERIOR
        ========================== -->

        <div class="cabecalho-up">

            <h1>AutiWorld🧩</h1>

            <div class="notificao">
                <button id="notificacaoButton">🔔</button>
            </div>

            <div id="caixaMensagem" class="caixa">
                <p>Olá! Esta é uma pequena mensagem.</p>
            </div>

            <div
                class="perfil"
                id="perfil">

                <img
                    src="<?= htmlspecialchars($fotoPerfil) ?>"
                    alt="Foto de Perfil">
            </div>

            <div class="menu-perfil" id="menuPerfil">

                <a href="perfil.php">👤 Meu Perfil</a>

                <a href="informacoes.php">🧩 Informações(IS)</a>

                <a href="configuracoes.php">⚙️ Configurações</a>

                <a href="../controllers/logout.php">🚪 Sair</a>

            </div>

        </div>


        <!-- =========================
             ÁREA DOS CARDS
        ========================== -->

        <div class="cabecalho-down">

            <section class="cards">

                <!-- CARD 1 -->
                <article class="item-card">

                    <a href="Comunicacao.php">

                        <button class="card">

                            <img
                                src="../../public/css/img/comunicacao.png"
                                alt="Comunicação">

                        </button>
                        <p>Comunicação</p>
                    </a>

                  

                </article>


                <!-- CARD 2 -->
                <article class="item-card">

                    <a href="Atividades.php">
                        <button class="card">

                            <img
                                src="../../public/css/img/Atividades.png"
                                alt="Atividades">

                        </button>

                        <p>Atividades</p>
                    </a>
                </article>


                <!-- CARD 3 -->
                <article class="item-card">
                    <a href="escola-virtual.php">
                        <button class="card">

                            <img
                                src="../../public/css/img/escola_virtual.png"
                                alt="Escola virtual">

                        </button>
                        <p>Escola virtual</p>
                    </a>
                    

                </article>


                <!-- CARD 4 -->
                <article class="item-card">
                    <a href="comunidade.php">
                        <button class="card">

                            <img
                                src="../../public/css/img/Comunidade.png"
                                alt="Comunidade">

                        </button>
                        <p>Comunidade</p>
                    </a>

                    

                </article>


                <!-- CARD 5 -->
                <article class="item-card">

                    <button
                        class="card-2"
                        onclick="abrirSOS()">

                        <img
                            src="../../public/css/img/Emergencia.png"
                            alt="Emergência">

                    </button>

                    <p>Emergência</p>

                </article>

            </section>

        </div>

    </div>
<script src="../../public/js/acessibilidade.js"></script>

<script>
    const telefoneResponsavel = <?= json_encode($telefoneResponsavel) ?>;
</script>

<script src="../../public/js/script.js"></script>

<script>

function atualizarOnlineDashboard()
{
    const dados = new FormData();

    dados.append(
        "acao",
        "entrar"
    );

    fetch(
        "../controllers/escola-presença_controller.php",
        {
            method: "POST",
            body: dados,
            credentials: "same-origin"
        }
    ).catch(() => {});
}


function heartbeatDashboard()
{
    const dados = new FormData();

    dados.append(
        "acao",
        "atividade"
    );

    fetch(
        "../controllers/escola-presença_controller.php",
        {
            method: "POST",
            body: dados,
            credentials: "same-origin"
        }
    ).catch(() => {});
}


atualizarOnlineDashboard();


setInterval(
    heartbeatDashboard,
    20000
);


window.addEventListener(
    "beforeunload",
    function()
    {

        const dados = new FormData();

        dados.append(
            "acao",
            "sair"
        );

        navigator.sendBeacon(
            "../controllers/escola-presença_controller.php",
            dados
        );

    }
);

</script>
</body>

</html>