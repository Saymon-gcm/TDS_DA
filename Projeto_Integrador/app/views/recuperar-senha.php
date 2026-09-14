<?php

session_name("Projeto_Sistema");
session_start();

$id_usuario = $_GET['id_usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Recuperar Senha - AutiWorld</title>

    <link
        rel="stylesheet"
        href="../../public/css/style-recuperar-senha.css">

    <link href="../../public/css/acessibilidade.css" rel="stylesheet" type="text/css">
</head>


<body>


    <main class="pagina-recuperar">


        <!-- =========================================
             LADO ESQUERDO
        ========================================== -->

        <section class="lado-esquerdo">

            <div class="logo">

                <span class="logo-auti">
                    Auti
                </span>

                <span class="logo-world">
                    World
                </span>

                <span class="emoji">
                    🧩
                </span>

            </div>


            <p class="texto-esquerdo">

                Crie uma nova senha
                para acessar sua conta.

            </p>

        </section>



        <!-- =========================================
             LADO DIREITO
        ========================================== -->

        <section class="lado-direito">


            <div class="caixa-recuperar">


                <h1>
                    Nova senha
                </h1>


                <p class="descricao">

                    Digite sua nova senha
                    e confirme para continuar.

                </p>



                <!-- =================================
                     FORMULÁRIO
                ================================== -->

                <form
                    action="../../app/controllers/atualizar-senha_controller.php?id_usuario=<?php echo $id_usuario; ?>"
                    method="POST"
                    id="formRecuperarSenha">


                    <!-- NOVA SENHA -->

                    <div class="campo">

                        <label for="senha">
                            Nova senha
                        </label>

                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            placeholder="Digite sua nova senha"
                            required
                            minlength="8"
                            autocomplete="new-password">

                    </div>



                    <!-- CONFIRMAR SENHA -->

                    <div class="campo">

                        <label for="confirmarSenha">
                            Confirmar senha
                        </label>

                        <input
                            type="password"
                            id="confirmarSenha"
                            name="confirmarSenha"
                            placeholder="Digite a senha novamente"
                            required
                            minlength="8"
                            autocomplete="new-password">

                    </div>



                    <!-- MENSAGEM -->

                    <p
                        id="mensagemSenha"
                        class="mensagem-senha">
                    </p>



                    <!-- BOTÃO -->

                    <button
                        type="submit"
                        class="botao-confirmar">

                        Confirmar nova senha

                    </button>


                </form>



                <!-- VOLTAR -->

                <a
                    href="../../index.php"
                    class="voltar-login">

                    ← Voltar para o login

                </a>


            </div>

        </section>


    </main>



    <!-- JAVASCRIPT -->

    <script src="../../public/js/recuperar-senha.js"></script>


<script src="../../public/js/acessibilidade.js"></script>
</body>

</html>