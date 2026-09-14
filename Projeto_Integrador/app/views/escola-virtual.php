<?php

session_name("Projeto_Sistema");
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "../models/user.php";

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: ../../index.php");
    exit;
}

$usuario = new User();

$idUsuarioLogado = (int) $_SESSION["id_usuarios"];

/*
|--------------------------------------------------------------------------
| DADOS DO INDIVÍDUO LOGADO
|--------------------------------------------------------------------------
*/

$individuoLogado = $usuario->BuscarIndividuo($idUsuarioLogado);

/*
|--------------------------------------------------------------------------
| FOTO DO INDIVÍDUO LOGADO
|--------------------------------------------------------------------------
*/

if (!empty($individuoLogado["url"])) {

    $fotoPerfil = "../../" . ltrim(
        $individuoLogado["url"],
        "/"
    );

} else {

    $fotoPerfil = "../../public/css/img/imagem-de_perfil.jpg";
}

/*
|--------------------------------------------------------------------------
| INDIVÍDUOS CADASTRADOS
|--------------------------------------------------------------------------
*/

$individuos = $usuario->ListarIndividuosEscolaVirtual();

/*
|--------------------------------------------------------------------------
| PESSOAS ONLINE
|--------------------------------------------------------------------------
*/

$online = $usuario->ListarIndividuosOnlineEscolaVirtual();

/*
|--------------------------------------------------------------------------
| SALAS
|--------------------------------------------------------------------------
*/

$salas = $usuario->ListarSalasEscolaVirtual();

/*
|--------------------------------------------------------------------------
| IDS DOS INDIVÍDUOS ONLINE
|--------------------------------------------------------------------------
*/

$idsOnline = [];

foreach ($online as $pessoa) {

    $idsOnline[
        (int) $pessoa["id_individuo"]
    ] = true;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Escola Virtual - AutiWorld
    </title>

    <link
        rel="stylesheet"
        href="../../public/css/style-EscolaVirtual.css"
    >

    <link
        rel="stylesheet"
        href="../../public/css/acessibilidade.css"
    >

</head>

<body>

<div class="escola">

<!-- ==================================================
     CABEÇALHO
================================================== -->

<header class="cabecalho-up">

    <h1>
        AutiWorld🧩
    </h1>

    <div class="notificao">

        <button
            id="notificacaoButton"
            type="button"
        >
            🔔
        </button>

    </div>

    <div
        class="perfil"
        id="perfil"
    >

        <img
            src="<?= htmlspecialchars($fotoPerfil) ?>"
            alt="Foto de perfil"
        >

    </div>

    <div
        class="menu-perfil"
        id="menuPerfil"
    >

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

</header>


<!-- ==================================================
     CONTEÚDO
================================================== -->

<main class="area-principal">

    <div class="area-voltar">

        <a
            href="DashBoard.php"
            class="botao-voltar"
        >
            ←
        </a>

    </div>


    <div class="conteudo-escola">


        <!-- ==================================================
             TÍTULO
        ================================================== -->

        <section class="titulo">

            <h2>
                🎓 Escola Virtual
            </h2>

            <p>
                Aprenda, participe e encontre
                outras pessoas da comunidade AutiWorld.
            </p>

        </section>


        <!-- ==================================================
             PESSOAS ONLINE
        ================================================== -->

        <section class="bloco">

            <div class="titulo-bloco">

                <h3>
                    🟢 Pessoas online
                </h3>

                <span id="quantidadeOnline">
                    <?= count($online) ?>
                </span>

            </div>


            <div
                class="pessoas-grid"
                id="pessoasOnline"
            >

                <?php if (empty($online)): ?>

                    <div class="sem-pessoas">

                        <span>
                            👥
                        </span>

                        <p>
                            Nenhuma pessoa está online
                            no momento.
                        </p>

                    </div>

                <?php else: ?>

                    <?php foreach ($online as $pessoa): ?>

                        <?php

                        $fotoPessoa = "../../public/css/img/imagem-de_perfil.jpg";

                        if (!empty($pessoa["foto_individuo"])) {

                            $fotoPessoa =
                                "../../" .
                                ltrim(
                                    $pessoa["foto_individuo"],
                                    "/"
                                );
                        }

                        ?>

                        <button
                            type="button"
                            class="pessoa-card online"
                            data-id="<?= (int) $pessoa["id_individuo"] ?>"
                            data-nome="<?= htmlspecialchars(
                                $pessoa["nome_completo"],
                                ENT_QUOTES,
                                "UTF-8"
                            ) ?>"
                            data-foto="<?= htmlspecialchars(
                                $fotoPessoa,
                                ENT_QUOTES,
                                "UTF-8"
                            ) ?>"
                            data-online="true"
                        >

                            <div class="status-online"></div>


                            <div class="avatar-pessoa">

                                <img
                                    src="<?= htmlspecialchars($fotoPessoa) ?>"
                                    alt="<?= htmlspecialchars(
                                        $pessoa["nome_completo"]
                                    ) ?>"
                                >

                            </div>


                            <strong>

                                <?= htmlspecialchars(
                                    $pessoa["nome_completo"]
                                ) ?>

                            </strong>


                            <span>
                                🟢 Online
                            </span>

                        </button>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </section>


        <!-- ==================================================
             TODAS AS PESSOAS CADASTRADAS
        ================================================== -->

        <section class="bloco">

            <div class="titulo-bloco">

                <h3>
                    👥 Pessoas cadastradas
                </h3>

                <span id="quantidadeCadastrados">
                    <?= count($individuos) ?>
                </span>

            </div>


            <div
                class="pessoas-grid"
                id="pessoasCadastradas"
            >

                <?php if (empty($individuos)): ?>

                    <div class="sem-pessoas">

                        <span>
                            👥
                        </span>

                        <p>
                            Nenhuma pessoa cadastrada.
                        </p>

                    </div>

                <?php endif; ?>


                <?php foreach ($individuos as $pessoa): ?>

                    <?php

                    /*
                    |--------------------------------------------------------------------------
                    | VERIFICAR SE ESTÁ ONLINE
                    |--------------------------------------------------------------------------
                    */

                    $estaOnline = isset(
                        $idsOnline[
                            (int) $pessoa["id_individuo"]
                        ]
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | FOTO DO INDIVÍDUO
                    |--------------------------------------------------------------------------
                    */

                    $fotoPessoa =
                        "../../public/css/img/imagem-de_perfil.jpg";

                    if (!empty($pessoa["foto_individuo"])) {

                        $fotoPessoa =
                            "../../" .
                            ltrim(
                                $pessoa["foto_individuo"],
                                "/"
                            );
                    }

                    ?>

                    <button
                        type="button"
                        class="pessoa-card <?= $estaOnline ? 'online' : 'offline' ?>"
                        data-id="<?= (int) $pessoa["id_individuo"] ?>"
                        data-nome="<?= htmlspecialchars(
                            $pessoa["nome_completo"],
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>"
                        data-foto="<?= htmlspecialchars(
                            $fotoPessoa,
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>"
                        data-online="<?= $estaOnline ? 'true' : 'false' ?>"
                    >

                        <div
                            class="<?= $estaOnline
                                ? 'status-online'
                                : 'status-offline'
                            ?>"
                        >
                        </div>


                        <!-- FOTO DO INDIVÍDUO -->

                        <div class="avatar-pessoa">

                            <img
                                src="<?= htmlspecialchars($fotoPessoa) ?>"
                                alt="<?= htmlspecialchars(
                                    $pessoa["nome_completo"]
                                ) ?>"
                            >

                        </div>


                        <!-- NOME -->

                        <strong>

                            <?= htmlspecialchars(
                                $pessoa["nome_completo"]
                            ) ?>

                        </strong>


                        <!-- STATUS -->

                        <span>

                            <?= $estaOnline
                                ? "🟢 Online"
                                : "⚪ Offline"
                            ?>

                        </span>

                    </button>

                <?php endforeach; ?>

            </div>

        </section>


        <!-- ==================================================
             SALAS
        ================================================== -->

        <section class="bloco">

            <div class="titulo-bloco">

                <h3>
                    🎓 Salas disponíveis
                </h3>

            </div>


            <div class="salas-grid">

                <?php if (empty($salas)): ?>

                    <div class="sem-pessoas">

                        <span>
                            🎓
                        </span>

                        <p>
                            Nenhuma sala disponível.
                        </p>

                    </div>

                <?php endif; ?>


                <?php foreach ($salas as $sala): ?>

                    <article class="card-sala">

                        <div class="icone-sala">
                            🎓
                        </div>


                        <h3>

                            <?= htmlspecialchars(
                                $sala["nome"]
                            ) ?>

                        </h3>


                        <p>

                            <?= htmlspecialchars(
                                $sala["descricao"] ?? ""
                            ) ?>

                        </p>


                        <small>

                            Criada por:

                            <?= htmlspecialchars(
                                $sala["criador"]
                            ) ?>

                        </small>


                        <a
                            href="sala.php?id=<?= (int) $sala["id_sala"] ?>"
                            class="botao-entrar"
                        >
                            Entrar na sala
                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

        </section>

    </div>

</main>

</div>


<!-- ==================================================
     MODAL DA PESSOA
================================================== -->

<div
    id="modalPessoa"
    class="modal-pessoa"
>

    <div class="modal-conteudo">

        <button
            type="button"
            id="fecharModal"
            class="fechar-modal"
        >
            ×
        </button>


        <div
            id="dadosPessoa"
            class="dados-pessoa"
        >

            <img
                id="fotoModalPessoa"
                src="../../public/css/img/imagem-de_perfil.jpg"
                alt="Foto da pessoa"
            >


            <h2 id="nomeModalPessoa">
                Nome
            </h2>


            <p id="statusModalPessoa">
                ⚪ Offline
            </p>

        </div>

    </div>

</div>


<script>

const pessoas = <?= json_encode(
    $individuos,
    JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES
) ?>;

const idUsuarioLogado =
    <?= $idUsuarioLogado ?>;

</script>


<script src="../../public/js/escola-virtual.js"></script>

<script src="../../public/js/acessibilidade.js"></script>


<!-- ==================================================
     PRESENÇA AUTOMÁTICA
================================================== -->

<script>

function enviarPresenca(acao)
{
    const dados = new FormData();

    dados.append(
        "acao",
        acao
    );

    fetch(
        "../controllers/escola-presença_controller.php",
        {
            method: "POST",
            body: dados,
            credentials: "same-origin",
            cache: "no-store"
        }
    )
    .catch(() => {});
}


/*
|--------------------------------------------------------------------------
| ENTRAR COMO ONLINE
|--------------------------------------------------------------------------
*/

enviarPresenca("entrar");


/*
|--------------------------------------------------------------------------
| HEARTBEAT
|--------------------------------------------------------------------------
*/

const intervaloPresenca =
    setInterval(
        function()
        {
            enviarPresenca("atividade");
        },
        20000
    );


/*
|--------------------------------------------------------------------------
| SAIR DA ESCOLA VIRTUAL
|--------------------------------------------------------------------------
*/

window.addEventListener(
    "beforeunload",
    function()
    {
        const dados =
            new FormData();

        dados.append(
            "acao",
            "sair"
        );

        navigator.sendBeacon(
            "../controllers/escola-presença_controller.php",
            dados
        );
    }
);

</script>


<!-- ==================================================
     MODAL DAS PESSOAS
================================================== -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function()
    {

        const modal =
            document.getElementById(
                "modalPessoa"
            );

        const fechar =
            document.getElementById(
                "fecharModal"
            );

        const foto =
            document.getElementById(
                "fotoModalPessoa"
            );

        const nome =
            document.getElementById(
                "nomeModalPessoa"
            );

        const status =
            document.getElementById(
                "statusModalPessoa"
            );


        /*
        |--------------------------------------------------------------------------
        | ABRIR MODAL
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            "click",
            function(event)
            {

                const card =
                    event.target.closest(
                        ".pessoa-card"
                    );


                if (!card) {
                    return;
                }


                const nomePessoa =
                    card.dataset.nome || "Pessoa";


                const fotoPessoa =
                    card.dataset.foto ||
                    "../../public/css/img/imagem-de_perfil.jpg";


                const estaOnline =
                    card.dataset.online === "true";


                /*
                |--------------------------------------------------------------------------
                | FOTO
                |--------------------------------------------------------------------------
                */

                foto.src =
                    fotoPessoa;

                foto.alt =
                    nomePessoa;


                /*
                |--------------------------------------------------------------------------
                | NOME
                |--------------------------------------------------------------------------
                */

                nome.textContent =
                    nomePessoa;


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                if (estaOnline)
                {

                    status.textContent =
                        "🟢 Online";

                    status.className =
                        "status-modal online";

                }
                else
                {

                    status.textContent =
                        "⚪ Offline";

                    status.className =
                        "status-modal offline";

                }


                /*
                |--------------------------------------------------------------------------
                | MOSTRAR MODAL
                |--------------------------------------------------------------------------
                */

                modal.classList.add(
                    "ativo"
                );

            });


        /*
        |--------------------------------------------------------------------------
        | FECHAR
        |--------------------------------------------------------------------------
        */

        fechar.addEventListener(
            "click",
            function()
            {
                modal.classList.remove(
                    "ativo"
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | CLICAR FORA
        |--------------------------------------------------------------------------
        */

        modal.addEventListener(
            "click",
            function(event)
            {

                if (
                    event.target === modal
                )
                {

                    modal.classList.remove(
                        "ativo"
                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESC
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            "keydown",
            function(event)
            {

                if (
                    event.key === "Escape"
                )
                {

                    modal.classList.remove(
                        "ativo"
                    );

                }

            }
        );

    }
);

</script>


</body>

</html>