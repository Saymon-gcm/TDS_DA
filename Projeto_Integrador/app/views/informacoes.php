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
   CRIAR OBJETO
================================================== */

$usuario = new User();


/* ==================================================
   BUSCAR USUÁRIO
================================================== */

$dadosUsuario = $usuario->ListarUmUsuario(
    $_SESSION["id_usuarios"]
);

if (!$dadosUsuario) {
    echo "Usuário não encontrado.";
    exit;
}


/* ==================================================
   BUSCAR INDIVÍDUO
================================================== */

$dadosIndividuo = $usuario->BuscarIndividuo(
    $_SESSION["id_usuarios"]
);

if (!$dadosIndividuo) {
    echo "Informações do indivíduo não encontradas.";
    exit;
}


/* ==================================================
   FOTO DO RESPONSÁVEL
================================================== */

if (!empty($dadosUsuario["url"])) {

    $fotoPerfil = "../../" . $dadosUsuario["url"];

} else {

    $fotoPerfil =
        "../../public/css/img/imagem-de_perfil.jpg";
}


/* ==================================================
   FOTO DO INDIVÍDUO
================================================== */

if (!empty($dadosIndividuo["url"])) {

    $fotoIndividuo =
        "../../" . $dadosIndividuo["url"];

} else {

    $fotoIndividuo =
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

    <title>Informações - AutiWorld</title>

    <link
        href="../../public/css/style-informacoes.css"
        rel="stylesheet"
        type="text/css">

    <link href="../../public/css/acessibilidade.css" rel="stylesheet" type="text/css">
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
                type="button">

                🔔

            </button>

        </div>


        <!-- ==================================================
             CAIXA DE NOTIFICAÇÃO
        ================================================== -->

        <div
            id="caixaMensagem"
            class="caixa">

            <p>
                Olá! Esta é uma pequena mensagem.
            </p>

        </div>


        <!-- ==================================================
             FOTO DO RESPONSÁVEL
        ================================================== -->

        <div
            class="perfil"
            id="perfil">

            <img
                src="<?= htmlspecialchars($fotoPerfil) ?>"
                alt="Foto de Perfil">

        </div>


        <!-- ==================================================
             MENU DO PERFIL
        ================================================== -->

        <div
            class="menu-perfil"
            id="menuPerfil">

            <a href="perfil.php">
                👤 Meu Perfil
            </a>

            <a href="informacoes.php">
                🧩 Informações (IS)
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
                href="Dashboard.php"
                class="botao-voltar">

                ←

            </a>

        </div>



        <!-- ==================================================
             PÁGINA DE INFORMAÇÕES
        ================================================== -->

        <main class="pagina-informacoes">


            <!-- TÍTULO -->

            <h2>
                Informações do Indivíduo
            </h2>


            <!-- ==================================================
                 FOTO DO INDIVÍDUO
            ================================================== -->

            <div class="foto-individuo">

                <img
                    src="<?= htmlspecialchars($fotoIndividuo) ?>"
                    alt="Foto do indivíduo">

            </div>


            <!-- ==================================================
                 BOTÃO ALTERAR FOTO
            ================================================== -->

            <div class="botao-foto-individuo">

                <a
                    href="editar-informacoes.php"
                    class="botao-editar-foto">

                    📷 Alterar Foto

                </a>

            </div>


            <!-- ==================================================
                 NOME DO INDIVÍDUO
            ================================================== -->

            <h3>

                <?= htmlspecialchars(
                    $dadosIndividuo["nome_completo"]
                ) ?>

            </h3>


            <!-- ==================================================
                 INFORMAÇÕES
            ================================================== -->

            <div class="informacoes-individuo">


                <!-- NOME COMPLETO -->

                <div class="campo-informacao">

                    <span class="titulo-campo">
                        Nome completo
                    </span>

                    <span class="valor-campo">

                        <?= htmlspecialchars(
                            $dadosIndividuo["nome_completo"]
                        ) ?>

                    </span>

                </div>


                <!-- DATA DE NASCIMENTO -->

                <div class="campo-informacao">

                    <span class="titulo-campo">
                        Data de nascimento
                    </span>

                    <span class="valor-campo">

                        <?= date(
                            "d/m/Y",
                            strtotime(
                                $dadosIndividuo["data_nascimento"]
                            )
                        ) ?>

                    </span>

                </div>


                <!-- IDADE -->

                <div class="campo-informacao">

                    <span class="titulo-campo">
                        Idade
                    </span>

                    <span class="valor-campo">

                        <?= htmlspecialchars(
                            $dadosIndividuo["idade"]
                        ) ?>

                        anos

                    </span>

                </div>


                <!-- GÊNERO -->

                <div class="campo-informacao">

                    <span class="titulo-campo">
                        Gênero
                    </span>

                    <span class="valor-campo">

                        <?= htmlspecialchars(
                            $dadosIndividuo["genero"]
                        ) ?>

                    </span>

                </div>


            </div>

        </main>

    </div>

</div>



<!-- ==================================================
     JAVASCRIPT
================================================== -->

<script src="../../public/js/script.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>