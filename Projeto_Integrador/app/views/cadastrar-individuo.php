<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AutiWorld - Cadastrar Indivíduo</title>

    <link
        href="../../public/css/style-cadastrar-individuo.css"
        rel="stylesheet"
        type="text/css">

</head>

<body>

    <div class="individuo-cabecalho">


        <!-- =====================================
             LADO ESQUERDO
        ====================================== -->

        <div class="individuo-lado-esquerdo">

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

        <div class="individuo-lado-direito">

            <form
                action="../controllers/cadastrar_individuo_controller.php"
                method="POST">


                <!-- =====================================
                     TÍTULO
                ====================================== -->

                <div class="individuo-titulo">

                    <h1>
                        Cadastrar Indivíduo
                    </h1>

                    <p>
                        Informe os dados da pessoa com autismo que será cadastrada.
                    </p>

                </div>


                <!-- =====================================
                     NOME COMPLETO
                ====================================== -->

                <div class="individuo-nome">

                    <input
                        type="text"
                        name="nome_completo"
                        placeholder="Nome completo"
                        required>

                </div>


                <!-- =====================================
                     DATA DE NASCIMENTO
                ====================================== -->

                <div class="individuo-data">

                    <input
                        type="date"
                        name="data_nascimento"
                        required>

                </div>


                <!-- =====================================
                     IDADE
                ====================================== -->

                <div class="individuo-idade">

                    <input
                        type="number"
                        name="idade"
                        placeholder="Idade"
                        min="0"
                        max="120"
                        required>

                </div>


                <!-- =====================================
                     GÊNERO
                ====================================== -->

                <div class="individuo-genero">

                    <select
                        name="genero"
                        required>

                        <option value="">
                            Selecione o gênero
                        </option>

                        <option value="Masculino">
                            Masculino
                        </option>

                        <option value="Feminino">
                            Feminino
                        </option>

                    </select>

                </div>


                <!-- =====================================
                     BOTÃO
                ====================================== -->

                <div class="individuo-botao">

                    <button
                        type="submit">
                        Cadastrar
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>

</html>