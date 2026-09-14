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

// ==================================================
// MENSAGEM DE SUCESSO
// ==================================================

$mensagemSucesso = $_SESSION["mensagem_sucesso"] ?? "";

unset($_SESSION["mensagem_sucesso"]);



/* ==================================================
   VERIFICAR LOGIN
================================================== */

if (!isset($_SESSION["id_usuarios"])) {

    header("Location: ../../index.php");
    exit;
}


/* ==================================================
   BUSCAR DADOS DO USUÁRIO
================================================== */

$usuario = new User();

$dadosUsuario = $usuario->ListarUmUsuario(
    $_SESSION["id_usuarios"]
);


/* ==================================================
   VERIFICAR SE USUÁRIO EXISTE
================================================== */

if (!$dadosUsuario) {

    echo "Usuário não encontrado.";
    exit;
}
// ==================================================
// FOTO DE PERFIL
// ==================================================

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

    <title>Meu Perfil - AutiWorld</title>

    <link
        href="../../public/css/style-perfil.css"
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
                    href="javascript:history.back()"
                    class="botao-voltar">

                    ←

                </a>

            </div>


            <!-- =========================
                 PERFIL
            ========================== -->

            <main class="pagina-perfil">


                <h2>
                    Meu Perfil
                </h2>

                <?php if (!empty($mensagemSucesso)): ?>

                    <div class="mensagem-sucesso">

                        <?= htmlspecialchars($mensagemSucesso) ?>

                    </div>

                <?php endif; ?>

                <!-- =========================
                     FOTO
                ========================== -->

                <div class="foto-perfil-grande">

                    <img
                        src="<?= htmlspecialchars($fotoPerfil) ?>"
                        alt="Foto de Perfil">

                </div>

                <!-- =========================
                     NOME DO USUÁRIO
                ========================== -->

                <h3>

                    <?= htmlspecialchars(
                        $dadosUsuario["nome"]
                    ) ?>

                </h3>


                <!-- =========================
                     INFORMAÇÕES
                ========================== -->

                <div class="informacoes-perfil">


                    <!-- NOME -->

                    <div class="campo-perfil">

                        <span class="titulo-campo">
                            Nome
                        </span>

                        <span class="valor-campo">

                            <?= htmlspecialchars(
                                $dadosUsuario["nome"]
                            ) ?>

                        </span>

                    </div>


                    <!-- E-MAIL -->

                    <div class="campo-perfil">

                        <span class="titulo-campo">
                            E-mail
                        </span>

                        <span class="valor-campo">

                            <?= htmlspecialchars(
                                $dadosUsuario["email"]
                            ) ?>

                        </span>

                    </div>


                    <!-- TELEFONE -->

                    <div class="campo-perfil">

                        <span class="titulo-campo">
                            Telefone
                        </span>

                        <span class="valor-campo">

                            <?= htmlspecialchars(
                                $dadosUsuario["numero"]
                            ) ?>

                        </span>

                    </div>


                    <!-- ID -->

                    <!-- SENHA -->

                    <div class="campo-perfil">

                        <span class="titulo-campo">
                            Senha
                        </span>

                        <span class="valor-campo">
                            ********
                        </span>

                    </div>

                </div>


                <!-- =========================
                     BOTÕES
                ========================== -->

                <div class="botoes-perfil">


                    <!-- EDITAR -->

                    <a
                        href="editar-perfil.php"
                        class="botao-editar">

                        ✏️ Editar Perfil

                    </a>


                    <!-- EXCLUIR -->

                    <form
                        method="POST"
                        action="excluir-perfil.php"
                        id="formExcluirPerfil">

                        <button
                            type="button"
                            class="botao-excluir"
                            id="botaoExcluir">

                            🗑️ Excluir Perfil

                        </button>

                    </form>


                </div>


            </main>

        </div>

    </div>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script src="../../public/js/script.js"></script>

    <script src="../../public/js/perfil.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>