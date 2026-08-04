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
        href="public/css/style.css"
        rel="stylesheet"
        type="text/css"
    >

</head>


<body>

    <div class="login-cabecalho">


        <!-- ==========================================
             LADO ESQUERDO
        =========================================== -->

        <div class="login-lado-esquerdo">

            <div class="logo-pt1">

                <h1>Auti</h1>

            </div>


            <div class="logo-pt2">

                <h1>World</h1>

            </div>

        </div>



        <!-- ==========================================
             LADO DIREITO
        =========================================== -->

        <div class="login-lado-direito">


            <!-- ==========================================
                 FORMULÁRIO DE LOGIN
            =========================================== -->

            <form
                action="app/controllers/login.php"
                method="POST"
                id="form-login"
            >


                <!-- ==========================================
                     TÍTULO
                =========================================== -->

                <div class="login">

                    <h1>Login</h1>

                </div>



                <!-- ==========================================
                     EMAIL
                =========================================== -->

                <div class="login-nome-email">


                    <img
                        src="public/css/img/login_email-removebg-preview.png"
                        alt="Ícone de email"
                    >


                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        autocomplete="email"
                        required
                    >


                </div>



                <!-- ==========================================
                     SENHA
                =========================================== -->

                <div class="login-senha">


                    <img
                        src="public/css/img/chave-removebg-preview.png"
                        alt="Ícone de senha"
                    >


                    <input
                        type="password"
                        name="senha"
                        id="senha"
                        placeholder="Senha"
                        autocomplete="current-password"
                        required
                    >


                </div>



                <!-- ==========================================
                     LOGIN AUTOMÁTICO
                =========================================== -->

                <div class="login-automatico">


                    <label>


                        <input
                            type="checkbox"
                            name="login_automatico"
                            id="login_automatico"
                            value="1"
                        >


                        <span>
                            Login automático
                        </span>


                    </label>


                </div>



                <!-- ==========================================
                     ESQUECI MINHA SENHA
                =========================================== -->

                <div class="esq-senha">


                    <a href="esq-senha.php">

                        Esqueci minha senha.

                    </a>


                </div>



                <!-- ==========================================
                     BOTÃO ENTRAR
                =========================================== -->

                <div class="login-botao">


                    <button
                        type="submit"
                        name="botao"
                        value="login"
                    >

                        Entrar

                    </button>


                </div>


            </form>



            <!-- ==========================================
                 BOTÃO CADASTRAR
            =========================================== -->

            <div class="login-cadastrar">


                <a
                    class="Cad-user"
                    href="cadastrar.php"
                >

                    Cadastrar-se

                </a>


            </div>


        </div>


    </div>



    <!-- ==========================================
         LOGIN AUTOMÁTICO
    =========================================== -->

    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function () {


                // ==========================================
                // PEGAR ELEMENTOS
                // ==========================================

                const email =
                    document.getElementById("email");

                const senha =
                    document.getElementById("senha");

                const loginAutomatico =
                    document.getElementById("login_automatico");

                const formulario =
                    document.getElementById("form-login");



                // ==========================================
                // BUSCAR DADOS SALVOS
                // ==========================================

                const emailSalvo =
                    localStorage.getItem(
                        "autiworld_email"
                    );

                const senhaSalva =
                    localStorage.getItem(
                        "autiworld_senha"
                    );



                // ==========================================
                // PREENCHER CAMPOS AUTOMATICAMENTE
                // ==========================================

                if (
                    emailSalvo &&
                    senhaSalva
                ) {


                    email.value =
                        emailSalvo;


                    senha.value =
                        senhaSalva;


                    loginAutomatico.checked =
                        true;


                }



                // ==========================================
                // QUANDO ENVIAR O FORMULÁRIO
                // ==========================================

                formulario.addEventListener(
                    "submit",
                    function () {


                        // ==========================================
                        // SE LOGIN AUTOMÁTICO ESTIVER MARCADO
                        // ==========================================

                        if (
                            loginAutomatico.checked
                        ) {


                            localStorage.setItem(
                                "autiworld_email",
                                email.value
                            );


                            localStorage.setItem(
                                "autiworld_senha",
                                senha.value
                            );


                        }


                        // ==========================================
                        // SE LOGIN AUTOMÁTICO NÃO ESTIVER MARCADO
                        // ==========================================

                        else {


                            localStorage.removeItem(
                                "autiworld_email"
                            );


                            localStorage.removeItem(
                                "autiworld_senha"
                            );


                        }


                    }
                );



                // ==========================================
                // SE DESMARCAR A CAIXA
                // ==========================================

                loginAutomatico.addEventListener(
                    "change",
                    function () {


                        if (
                            !this.checked
                        ) {


                            localStorage.removeItem(
                                "autiworld_email"
                            );


                            localStorage.removeItem(
                                "autiworld_senha"
                            );


                        }


                    }
                );


            }
        );

    </script>


</body>

</html>