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
// VERIFICAR LOGIN
// ==================================================

if (!isset($_SESSION["id_usuarios"])) {

    header("Location: ../../index.php");
    exit;

}


// ==================================================
// BUSCAR USUÁRIO
// ==================================================

$usuario = new User();

$dadosUsuario = $usuario->ListarUmUsuario(
    $_SESSION["id_usuarios"]
);


if (!$dadosUsuario) {

    echo "Usuário não encontrado.";
    exit;

}


// ==================================================
// FOTO ATUAL
// ==================================================

if (!empty($dadosUsuario["url"])) {

    $fotoPerfil =
        "../../" . $dadosUsuario["url"];

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

    <title>Editar Perfil - AutiWorld</title>

    <link
        rel="stylesheet"
        href="../../public/css/style-editar-perfil.css">

    <link href="../../public/css/acessibilidade.css" rel="stylesheet" type="text/css">
</head>


<body>


    <div class="pagina-editar">


        <!-- ==================================================
             CABEÇALHO
        ================================================== -->

        <header class="cabecalho-editar">

            <h1>
                AutiWorld🧩
            </h1>

        </header>



        <!-- ==================================================
             ÁREA PRINCIPAL
        ================================================== -->

        <main class="conteudo-editar">


            <!-- BOTÃO VOLTAR -->

            <div class="area-voltar">

                <a
                    href="Dashboard.php"
                    class="botao-voltar">

                    ←

                </a>

            </div>



            <!-- ==================================================
                 FORMULÁRIO
            ================================================== -->

            <section class="caixa-editar">


                <h2>
                    Editar Perfil
                </h2>


                <p class="descricao">

                    Altere as informações do seu perfil.

                </p>



                <form
                    action="../controllers/editar-perfil_controller.php"
                    method="POST"
                    enctype="multipart/form-data"
                    id="formEditarPerfil">


                    <!-- ==================================================
                         FOTO
                    ================================================== -->

                    <div class="area-foto">


                        <div class="foto-preview">

                            <img
                                src="<?= htmlspecialchars($fotoPerfil) ?>"
                                id="fotoPreview"
                                alt="Foto de Perfil">

                        </div>


                        <label
                            for="foto"
                            class="botao-foto">

                            📷 Escolher foto

                        </label>


                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp">


                        <p class="info-foto">

                            JPG, JPEG, PNG ou WEBP.
                            Máximo de 5 MB.

                        </p>


                    </div>



                    <!-- ==================================================
                         NOME
                    ================================================== -->

                    <div class="campo">

                        <label for="nome">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            value="<?= htmlspecialchars($dadosUsuario["nome"]) ?>"
                            maxlength="100"
                            required>

                    </div>



                    <!-- ==================================================
                         E-MAIL
                    ================================================== -->

                    <div class="campo">

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($dadosUsuario["email"]) ?>"
                            maxlength="150"
                            required>

                    </div>



                    <!-- ==================================================
                         TELEFONE
                    ================================================== -->

                    <div class="campo">

                        <label for="numero">
                            Telefone
                        </label>

                        <input
                            type="text"
                            id="numero"
                            name="numero"
                            value="<?= htmlspecialchars($dadosUsuario["numero"]) ?>"
                            maxlength="20"
                            required>

                    </div>



                    <!-- ==================================================
                         MENSAGEM
                    ================================================== -->

                    <p
                        id="mensagem"
                        class="mensagem">
                    </p>



                    <!-- ==================================================
                         BOTÕES
                    ================================================== -->

                    <div class="botoes-editar">


                        <a
                            href="perfil.php"
                            class="botao-cancelar">

                            Cancelar

                        </a>


                        <button
                            type="submit"
                            class="botao-salvar">

                            💾 Salvar alterações

                        </button>


                    </div>


                </form>


            </section>


        </main>


    </div>



    <script src="../../public/js/editar-perfil.js"></script>

<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>