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
   FOTO DO USUÁRIO / RESPONSÁVEL
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

    $fotoIndividuo = "../../" . $dadosIndividuo["url"];

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

    <title>Editar Foto - AutiWorld</title>

    <link
        href="../../public/css/style-editar-informacoes.css"
        rel="stylesheet"
        type="text/css">

    <link href="../../public/css/acessibilidade.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="cabecalho">

    <!-- ==================================================
         CABEÇALHO
    ================================================== -->

    <div class="cabecalho-up">

        <h1>
            AutiWorld🧩
        </h1>

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

        <!-- FOTO DO RESPONSÁVEL -->

        <div
            class="perfil"
            id="perfil">

            <img
                src="<?= htmlspecialchars($fotoPerfil) ?>"
                alt="Foto de Perfil">

        </div>

        <!-- MENU -->

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

        <!-- BOTÃO VOLTAR -->

        <div class="area-voltar">

            <a
                href="informacoes.php"
                class="botao-voltar">

                ←

            </a>

        </div>


        <!-- ==================================================
             FORMULÁRIO
        ================================================== -->

        <main class="pagina-editar">

            <h2>
                Alterar Foto do Indivíduo
            </h2>

            <h3>
                <?= htmlspecialchars(
                    $dadosIndividuo["nome_completo"]
                ) ?>
            </h3>


            <!-- FOTO ATUAL -->

            <div class="foto-individuo">

                <img
                    src="<?= htmlspecialchars($fotoIndividuo) ?>"
                    alt="Foto do indivíduo">

            </div>


            <!-- FORMULÁRIO -->

            <form
                action="../controllers/editar-informacoes_controller.php"
                method="POST"
                enctype="multipart/form-data">

                <input
                    type="hidden"
                    name="id_individuo"
                    value="<?= htmlspecialchars(
                        $dadosIndividuo["id_individuo"]
                    ) ?>">

                <label for="foto">
                    Escolha uma nova foto
                </label>

                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept="image/jpeg,image/png,image/webp"
                    required>


                <div class="botoes">

                    <a
                        href="informacoes.php"
                        class="botao-cancelar">

                        Cancelar

                    </a>

                    <button
                        type="submit"
                        class="botao-salvar">

                        💾 Salvar Foto

                    </button>

                </div>

            </form>

        </main>

    </div>

</div>


<script src="../../public/js/script.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>