<?php

session_start();

require_once "../models/user.php";

$usuario = new User();

$dadosUsuario = $usuario->ListarUmUsuario($_SESSION["id_usuarios"]);

$telefoneResponsavel = $dadosUsuario["numero"];

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

            <div class="perfil" id="perfil">
                <img
                    src="../../public/css/img/imagem-de_perfil.jpg"
                    alt="Foto de Perfil">
            </div>

            <div class="menu-perfil" id="menuPerfil">

                <a href="#">👤 Meu Perfil</a>

                <a href="#">🧩 Informações(IS)</a>

                <a href="#">⚙️ Configurações</a>

                <a href="../../index.php">🚪 Sair</a>

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

                    </a>

                    <p>Comunicação</p>

                </article>


                <!-- CARD 2 -->

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


                <!-- CARD 3 -->

                <article class="item-card">

                    <button class="card">

                        <img
                            src="../../public/css/img/Atividades.png"
                            alt="Atividades">

                    </button>

                    <p>Atividades</p>

                </article>


                <!-- CARD 4 -->

                <article class="item-card">

                    <button class="card">

                        <img
                            src="../../public/css/img/escola_virtual.png"
                            alt="Escola virtual">

                    </button>

                    <p>Escola virtual</p>

                </article>


                <!-- CARD 5 -->

                <article class="item-card">

                    <button class="card">

                        <img
                            src="../../public/css/img/Comunidade.png"
                            alt="Comunidade">

                    </button>

                    <p>Comunidade</p>

                </article>


            </section>

        </div>

    </div>

    <script>
        const telefoneResponsavel = "<?= $telefoneResponsavel ?>";
    </script>

    <script src="../../public/js/script.js"></script>
</body>

</html>