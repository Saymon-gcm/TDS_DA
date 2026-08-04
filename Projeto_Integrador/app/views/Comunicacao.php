<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AutiWorld</title>

    <link href="../../public/css/style-Comunicacao.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="cabecalho">

        <!-- =========================
             CABEÇALHO SUPERIOR
        ========================== -->

        <div class="cabecalho-up">

            <h1>AutiWorld🧩</h1>

            <!-- NOTIFICAÇÃO -->

            <div class="notificao">

                <button id="notificacaoButton">
                    🔔
                </button>

            </div>


            <!-- CAIXA DE NOTIFICAÇÃO -->

            <div id="caixaMensagem" class="caixa">

                <p>Olá! Esta é uma pequena mensagem.</p>

            </div>


            <!-- PERFIL -->

            <div class="perfil" id="perfil">

                <img
                    src="../../public/css/img/imagem-de_perfil.jpg"
                    alt="Foto de Perfil">

            </div>


            <!-- MENU DO PERFIL -->

            <div class="menu-perfil" id="menuPerfil">

                <a href="#">
                    👤 Meu Perfil
                </a>

                <a href="#">
                    🧩 Informações(IS)
                </a>

                <a href="#">
                    ⚙️ Configurações
                </a>

                <a href="../../index.php">
                    🚪 Sair
                </a>

            </div>

        </div>


        <!-- =========================
             ÁREA DOS CARDS
        ========================== -->

        <div class="cabecalho-down">


            <!-- BOTÃO VOLTAR -->

            <div class="area-voltar">

                <a
                    href="DashBoard.php"
                    class="botao-voltar">
                    ←
                </a>

            </div>


            <!-- CONTAINER DOS CARDS -->

            <div class="container">


                <button class="card" onclick="falar('Quero comer')">

                    <img
                        src="../../public/css/img/comer.png"
                        alt="Comer">

                    <span>Quero comer</span>

                </button>


                <button class="card" onclick="falar('Quero beber')">

                    <img
                        src="../../public/css/img/beber.png"
                        alt="Beber">

                    <span>Quero beber</span>

                </button>


                <button class="card" onclick="falar('Preciso ir ao banheiro')">

                    <img
                        src="../../public/css/img/banheiro.png"
                        alt="Banheiro">

                    <span>Preciso ir ao banheiro</span>

                </button>


                <button class="card" onclick="falar('Quero brincar')">

                    <img
                        src="../../public/css/img/brincar.png"
                        alt="Brincar">

                    <span>Quero brincar</span>

                </button>


                <button class="card" onclick="falar('Estou cansado')">

                    <img
                        src="../../public/css/img/cansado.png"
                        alt="Descansar">

                    <span>Estou cansado</span>

                </button>


                <button class="card" onclick="falar('Estou feliz')">

                    <img
                        src="../../public/css/img/feliz.png"
                        alt="Feliz">

                    <span>Estou feliz</span>

                </button>


                <button class="card" onclick="falar('Estou triste')">

                    <img
                        src="../../public/css/img/triste.png"
                        alt="Triste">

                    <span>Estou triste</span>

                </button>


                <button class="card" onclick="falar('Estou irritado')">

                    <img
                        src="../../public/css/img/irritado.png"
                        alt="Irritado">

                    <span>Estou irritado</span>

                </button>


                <button class="card" onclick="falar('Estou com dor')">

                    <img
                        src="../../public/css/img/dor.png"
                        alt="Dor">

                    <span>Estou com dor</span>

                </button>


                <button class="card" onclick="falar('Não estou bem')">

                    <img
                        src="../../public/css/img/nao_bem.png"
                        alt="Não estou bem">

                    <span>Não estou bem</span>

                </button>


                <button class="card" onclick="falar('Quero ir para casa')">

                    <img
                        src="../../public/css/img/casa.png"
                        alt="Casa">

                    <span>Quero ir para casa</span>

                </button>


                <button class="card" onclick="falar('Quero minha mãe')">

                    <img
                        src="../../public/css/img/mae.png"
                        alt="Mãe">

                    <span>Quero minha mãe</span>

                </button>


                <button class="card" onclick="falar('Quero meu pai')">

                    <img
                        src="../../public/css/img/pai.png"
                        alt="Pai">

                    <span>Quero meu pai</span>

                </button>


                <button class="card" onclick="falar('Quero minha familia')">

                    <img
                        src="../../public/css/img/familia.png"
                        alt="Familia">

                    <span>Quero minha familia</span>

                </button>


                <button class="card" onclick="falar('Preciso de ajuda')">

                    <img
                        src="../../public/css/img/ajuda.png"
                        alt="Ajuda">

                    <span>Preciso de ajuda</span>

                </button>


            </div>

        </div>

    </div>


    <script src="../../public/js/script.js"></script>

</body>

</html>