<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0"
    >

    <title>AutiWorld</title>

    <link 
        href="public/css/style-esq-senha.css" 
        rel="stylesheet" 
        type="text/css"
    >

</head>

<body>

    <div class="login-cabecalho">


        <!-- =========================================
             LADO ESQUERDO
        ========================================== -->

        <div class="login-lado-esquerdo">

            <div class="logo-pt1">
                <h1>Auti</h1>
            </div>

            <div class="logo-pt2">
                <h1>World</h1>
            </div>

        </div>


        <!-- =========================================
             LADO DIREITO
        ========================================== -->

        <div class="login-lado-direito">

            <form 
                action="../controllers/" 
                method="POST"
            >


                <!-- =================================
                     TÍTULO
                ================================== -->

                <div class="login">

                    <a 
                        href="index.php" 
                        class="voltar"
                    >
                        ← Voltar
                    </a>

                    <h1>
                        Esqueci minha senha
                    </h1>

                </div>


                <!-- =================================
                     CAMPO EMAIL
                ================================== -->

                <div class="login-nome-email">

                    <img 
                        src="public/css/img/login_email-removebg-preview.png"
                        alt="Ícone de email"
                    >

                    <input 
                        type="email"
                        name="email"
                        placeholder="Email ou Nome"
                        required
                    >

                </div>


                <!-- =================================
                     RECADO
                ================================== -->

                <p class="recado-senha">

                    Digite seu email ou nome para receber
                    um código de recuperação.

                </p>


                <!-- =================================
                     BOTÃO
                ================================== -->

                <div class="login-botao">

                    <button 
                        type="submit"
                        name="botao"
                        value="login"
                    >
                        Enviar Código
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>

</html>