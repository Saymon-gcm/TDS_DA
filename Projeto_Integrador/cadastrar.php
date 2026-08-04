<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AutiWorld</title>

    <link href="public/css/style-cadastrar.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="cadastrar-cabecalho">


        <!-- =====================================
             LADO ESQUERDO
        ====================================== -->

        <div class="cadastrar-lado-esquerdo">

            <div class="logo-pt1">
                <h1>Auti</h1>
            </div>

            <div class="logo-pt2">
                <h1>World</h1>
            </div>

        </div>


        <!-- =====================================
             LADO DIREITO
        ====================================== -->

        <div class="cadastrar-lado-direito">

            <form
                action="app/controllers/cadastrar_usuario_controller.php"
                method="POST">


                <!-- =====================================
                     TÍTULO E VOLTAR
                ====================================== -->

                <div class="cadastrar">

                    <a href="index.php">
                        ← Voltar
                    </a>

                    <h1>
                        Cadastrar
                    </h1>

                </div>


                <!-- =====================================
                     NOME
                ====================================== -->

                <div class="cadastrar-nome">

                    <img
                        src="public/css/img/login_email-removebg-preview.png"
                        alt="Ícone de nome">

                    <input
                        type="text"
                        name="nome"
                        placeholder="Nome"
                        required>

                </div>


                <!-- =====================================
                     EMAIL
                ====================================== -->

                <div class="cadastrar-email">

                    <img
                        src="public/css/img/email_-removebg-preview.png"
                        alt="Ícone de email">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required>

                </div>


                <!-- =====================================
                     NÚMERO DE CELULAR
                ====================================== -->

                <div class="cadastrar-telefone">

                    <img
                        src="public/css/img/login-telefone.png"
                        alt="Ícone de número de celular">

                    <div class="codigo-pais">
                        +55
                    </div>

                    <input
                        type="tel"
                        id="numero"
                        name="numero"
                        placeholder="46 99999-9999"
                        autocomplete="tel"
                        maxlength="14"
                        required>

                </div>


                <!-- =====================================
                     SENHA
                ====================================== -->

                <div class="cadastrar-senha">

                    <img
                        src="public/css/img/chave-removebg-preview.png"
                        alt="Ícone de senha">

                    <input
                        type="password"
                        name="senha"
                        placeholder="Senha"
                        required>

                </div>


                <!-- =====================================
                     BOTÃO CADASTRAR
                ====================================== -->

                <div class="cadastrar-botao">

                    <button
                        type="submit"
                        name="botao"
                        value="cadastrar">
                        Cadastrar-se
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>

</html>