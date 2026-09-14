<?php

session_name("Projeto_Sistema");
session_start();

/* ==================================================
   IMPEDIR CACHE
================================================== */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* ==================================================
   MODELO
================================================== */

require_once "../models/user.php";

/* ==================================================
   VERIFICAR LOGIN
================================================== */

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: ../../index.php");
    exit;
}

/* ==================================================
   ID DO USUÁRIO
================================================== */

$id_usuario = (int) $_SESSION["id_usuarios"];

/* ==================================================
   ID DA SALA
================================================== */

$id_sala = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);

if (!$id_sala || $id_sala <= 0) {
    header("Location: escola-virtual.php");
    exit;
}

/* ==================================================
   OBJETO DO USUÁRIO
================================================== */

$usuario = new user();

/* ==================================================
   BUSCAR SALA
================================================== */

$sala = $usuario->ListarSala($id_sala);

/* ==================================================
   VERIFICAR SE A SALA EXISTE
================================================== */

if (!$sala || !is_array($sala)) {
    header("Location: escola-virtual.php");
    exit;
}

/* ==================================================
   VERIFICAR SE A SALA ESTÁ ATIVA
================================================== */

if (isset($sala["ativa"]) && !$sala["ativa"]) {
    header("Location: escola-virtual.php");
    exit;
}

/* ==================================================
   ENTRAR NA SALA
   Registra o usuário como participante
================================================== */

try {

    $usuario->EntrarSalaEscolaVirtual(
        $id_sala,
        $id_usuario
    );

} catch (Throwable $e) {

    /*
     * Se houver algum problema ao registrar a entrada,
     * não interrompemos a página inteira.
     *
     * O JavaScript continuará tentando atualizar
     * a presença.
     */
}

/* ==================================================
   ATUALIZAR PRESENÇA
================================================== */

try {

    $usuario->AtualizarPresencaSala(
        $id_sala,
        $id_usuario
    );

} catch (Throwable $e) {

    // Não interrompe a página.
}

/* ==================================================
   BUSCAR PARTICIPANTES
================================================== */

try {

    $participantes = $usuario->ListarParticipantesSala(
        $id_sala
    );

} catch (Throwable $e) {

    $participantes = [];
}

if (!is_array($participantes)) {
    $participantes = [];
}

/* ==================================================
   BUSCAR DADOS DO USUÁRIO LOGADO
================================================== */

$dadosUsuario = [];

try {

    $dadosUsuario = $usuario->ListarUmUsuario(
        $id_usuario
    );

} catch (Throwable $e) {

    $dadosUsuario = [];
}

if (!is_array($dadosUsuario)) {
    $dadosUsuario = [];
}

/* ==================================================
   FOTO DO USUÁRIO
================================================== */

$fotoPerfil = "../../public/css/img/imagem-de_perfil.jpg";

if (
    isset($dadosUsuario["url"]) &&
    !empty($dadosUsuario["url"])
) {

    $fotoPerfil = "../../" . ltrim(
        $dadosUsuario["url"],
        "/"
    );
}

/* ==================================================
   DADOS DA SALA
================================================== */

$nomeSala = "Sala Virtual";

if (
    isset($sala["nome"]) &&
    !empty($sala["nome"])
) {

    $nomeSala = $sala["nome"];
}

$descricaoSala = "";

if (
    isset($sala["descricao"]) &&
    !empty($sala["descricao"])
) {

    $descricaoSala = $sala["descricao"];
}

/* ==================================================
   PROFESSOR
================================================== */

$nomeProfessor = "Nenhum professor definido";

/*
 * O ListarSala() pode retornar o professor
 * com nomes diferentes dependendo da versão
 * do user.php.
 *
 * Por isso verificamos as possibilidades.
 */

if (
    isset($sala["professor_nome"]) &&
    !empty($sala["professor_nome"])
) {

    $nomeProfessor = $sala["professor_nome"];

} elseif (
    isset($sala["nome_professor"]) &&
    !empty($sala["nome_professor"])
) {

    $nomeProfessor = $sala["nome_professor"];

} elseif (
    isset($sala["professor"]) &&
    !empty($sala["professor"])
) {

    $nomeProfessor = $sala["professor"];

} elseif (
    isset($sala["professor_nome_completo"]) &&
    !empty($sala["professor_nome_completo"])
) {

    $nomeProfessor = $sala["professor_nome_completo"];
}

/* ==================================================
   CRIADOR
================================================== */

$nomeCriador = "Usuário";

if (
    isset($sala["criador"]) &&
    !empty($sala["criador"])
) {

    $nomeCriador = $sala["criador"];
}

/* ==================================================
   IDENTIFICAR SE O USUÁRIO É O CRIADOR
================================================== */

$idCriador = 0;

if (isset($sala["id_criador"])) {
    $idCriador = (int) $sala["id_criador"];
}

$ehCriador = ($idCriador === $id_usuario);

/* ==================================================
   IDENTIFICAR SE O USUÁRIO É O PROFESSOR
================================================== */

$idProfessor = 0;

if (
    isset($sala["id_professor"]) &&
    $sala["id_professor"] !== null
) {

    $idProfessor = (int) $sala["id_professor"];
}

$ehProfessor = ($idProfessor === $id_usuario);

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
        <?= htmlspecialchars(
            $nomeSala,
            ENT_QUOTES,
            "UTF-8"
        ) ?>
        - AutiWorld
    </title>

    <!-- ==================================================
         CSS DA SALA
    ================================================== -->

    <link
        rel="stylesheet"
        href="../../public/css/style-Sala.css"
    >

    <!-- ==================================================
         CSS DE ACESSIBILIDADE
    ================================================== -->

    <link
        rel="stylesheet"
        href="../../public/css/acessibilidade.css"
    >

</head>

<body>

<div
    class="sala-container"
    id="salaContainer"
    data-sala-id="<?= htmlspecialchars(
        (string) $id_sala,
        ENT_QUOTES,
        "UTF-8"
    ) ?>"
    data-usuario-id="<?= htmlspecialchars(
        (string) $id_usuario,
        ENT_QUOTES,
        "UTF-8"
    ) ?>"
    data-criador="<?= $ehCriador ? "true" : "false" ?>"
    data-professor="<?= $ehProfessor ? "true" : "false" ?>"
>

    <!-- ==================================================
         CABEÇALHO
    ================================================== -->

    <header class="sala-header">

        <a
            href="escola-virtual.php"
            class="botao-voltar"
            aria-label="Voltar para Escola Virtual"
        >
            ←
        </a>

        <div class="titulo-sala">

            <span
                class="icone-sala"
                aria-hidden="true"
            >
                🎓
            </span>

            <div>

                <h1>

                    <?= htmlspecialchars(
                        $nomeSala,
                        ENT_QUOTES,
                        "UTF-8"
                    ) ?>

                </h1>

                <p>

                    Professor:

                    <strong
                        id="nomeProfessorHeader"
                    >

                        <?= htmlspecialchars(
                            $nomeProfessor,
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>

                    </strong>

                </p>

            </div>

        </div>

        <div class="status-sala">

            <span class="bolinha"></span>

            Ao vivo

        </div>

    </header>


    <!-- ==================================================
         ÁREA PRINCIPAL
    ================================================== -->

    <main class="area-aula">


        <!-- ==================================================
             PROFESSOR
        ================================================== -->

        <section class="professor-area">

            <div class="titulo-area">

                <h2>
                    Professor
                </h2>

                <span id="nomeProfessorArea">

                    👨‍🏫

                    <?= htmlspecialchars(
                        $nomeProfessor,
                        ENT_QUOTES,
                        "UTF-8"
                    ) ?>

                </span>

            </div>


            <div class="video-professor">


                <!-- ==================================================
                     VÍDEO DO PROFESSOR
                ================================================== -->

                <video
                    id="videoProfessor"
                    autoplay
                    playsinline
                    class="video-real"
                ></video>


                <!-- ==================================================
                     COMPARTILHAMENTO DE TELA
                ================================================== -->

                <video
                    id="videoTelaProfessor"
                    autoplay
                    playsinline
                    class="video-tela"
                ></video>


                <!-- ==================================================
                     PLACEHOLDER
                ================================================== -->

                <div
                    id="professorPlaceholder"
                    class="professor-placeholder"
                >

                    <div class="icone-professor">
                        👨‍🏫
                    </div>

                    <h3
                        id="professorPlaceholderNome"
                    >

                        <?= htmlspecialchars(
                            $nomeProfessor,
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>

                    </h3>

                    <p>
                        Professor da aula
                    </p>

                </div>


                <!-- ==================================================
                     INDICADOR DE COMPARTILHAMENTO
                ================================================== -->

                <div
                    id="compartilhamentoAtivo"
                    class="compartilhamento-ativo"
                >

                    🖥️ Compartilhando tela

                </div>

            </div>

        </section>


        <!-- ==================================================
             PARTICIPANTES
        ================================================== -->

        <section class="alunos-area">

            <div class="titulo-area">

                <h2>
                    Participantes
                </h2>

                <span id="contadorAlunos">

                    <?= count($participantes) ?>

                    <?= count($participantes) === 1
                        ? "participante"
                        : "participantes"
                    ?>

                </span>

            </div>


            <div
                class="alunos-grid"
                id="alunosGrid"
            >

                <?php if (empty($participantes)): ?>

                    <div class="sem-participantes">

                        <span>
                            👥
                        </span>

                        <p>
                            Nenhum participante
                            encontrado.
                        </p>

                    </div>

                <?php else: ?>


                    <?php foreach (
                        $participantes
                        as $participante
                    ): ?>

                        <?php

                        $idParticipante = 0;

                        if (
                            isset(
                                $participante["id_usuarios"]
                            )
                        ) {

                            $idParticipante =
                                (int)
                                $participante[
                                    "id_usuarios"
                                ];
                        }


                        $nomeParticipante =
                            "Usuário";


                        if (
                            isset(
                                $participante[
                                    "nome_completo"
                                ]
                            ) &&
                            !empty(
                                $participante[
                                    "nome_completo"
                                ]
                            )
                        ) {

                            $nomeParticipante =
                                $participante[
                                    "nome_completo"
                                ];
                        }


                        $urlParticipante = "";

                        if (
                            isset(
                                $participante["url"]
                            ) &&
                            !empty(
                                $participante["url"]
                            )
                        ) {

                            $urlParticipante =
                                "../../" .
                                ltrim(
                                    $participante["url"],
                                    "/"
                                );
                        }

                        ?>


                        <div
                            class="card-aluno
                            <?= $idParticipante === $id_usuario
                                ? "sou-eu"
                                : ""
                            ?>"
                            data-id="<?= htmlspecialchars(
                                (string)
                                $idParticipante,
                                ENT_QUOTES,
                                "UTF-8"
                            ) ?>"
                        >

                            <div class="avatar-aluno">

                                <?php if (
                                    !empty(
                                        $urlParticipante
                                    )
                                ): ?>

                                    <img
                                        src="<?= htmlspecialchars(
                                            $urlParticipante,
                                            ENT_QUOTES,
                                            "UTF-8"
                                        ) ?>"
                                        alt="Foto de <?= htmlspecialchars(
                                            $nomeParticipante,
                                            ENT_QUOTES,
                                            "UTF-8"
                                        ) ?>"
                                    >

                                <?php else: ?>

                                    <span
                                        class="avatar-padrao"
                                        aria-hidden="true"
                                    >
                                        👤
                                    </span>

                                <?php endif; ?>

                            </div>


                            <span class="nome-aluno">

                                <?= htmlspecialchars(
                                    $nomeParticipante,
                                    ENT_QUOTES,
                                    "UTF-8"
                                ) ?>

                                <?php if (
                                    $idParticipante ===
                                    $id_usuario
                                ): ?>

                                    <small>
                                        (Você)
                                    </small>

                                <?php endif; ?>

                            </span>


                            <small
                                class="estado-microfone"
                                title="Microfone"
                            >
                                🎤
                            </small>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </section>


        <!-- ==================================================
             MINHA CÂMERA
        ================================================== -->

        <section class="minha-camera">

            <div class="titulo-area">

                <h2>
                    Você
                </h2>

            </div>


            <div class="video-aluno">

                <video
                    id="videoAluno"
                    autoplay
                    muted
                    playsinline
                ></video>


                <div
                    id="cameraMensagem"
                    class="camera-mensagem"
                >

                    <span>
                        📷
                    </span>

                    <p>
                        Sua câmera está desligada
                    </p>

                </div>

            </div>

        </section>

    </main>


    <!-- ==================================================
         CONTROLES
    ================================================== -->

    <footer class="controles">


        <!-- MICROFONE -->

        <button
            type="button"
            id="microfoneButton"
            class="controle"
            aria-label="Ativar ou desativar microfone"
            title="Microfone"
        >
            🎤
        </button>


        <!-- CÂMERA -->

        <button
            type="button"
            id="cameraButton"
            class="controle"
            aria-label="Ativar ou desativar câmera"
            title="Câmera"
        >
            📹
        </button>


        <!-- COMPARTILHAR TELA -->

        <button
            type="button"
            id="telaButton"
            class="controle"
            aria-label="Compartilhar tela"
            title="Compartilhar tela"
        >
            🖥️
        </button>


        <!-- LEVANTAR A MÃO -->

        <button
            type="button"
            id="maoButton"
            class="controle"
            aria-label="Levantar a mão"
            title="Levantar a mão"
        >
            ✋
        </button>


        <!-- CHAT -->

        <button
            type="button"
            id="chatButton"
            class="controle"
            aria-label="Abrir chat"
            title="Chat"
        >
            💬
        </button>


        <!-- SAIR -->

        <a
            href="escola-virtual.php"
            class="controle sair"
            id="sairSala"
            aria-label="Sair da sala"
            title="Sair da sala"
        >
            📞
        </a>

    </footer>


    <!-- ==================================================
         CHAT
    ================================================== -->

    <div
        id="mensagemChat"
        class="mensagem-chat"
    >


        <!-- CABEÇALHO -->

        <div class="chat-cabecalho">

            <strong>
                💬 Chat da aula
            </strong>

            <button
                type="button"
                id="fecharChat"
                aria-label="Fechar chat"
            >
                ×
            </button>

        </div>


        <!-- MENSAGENS -->

        <div
            id="chatMensagens"
            class="chat-mensagens"
        >

            <p class="chat-vazio">
                O chat da aula aparecerá aqui.
            </p>

        </div>


        <!-- CAMPO DE ENVIO -->

        <div class="chat-input-area">

            <input
                type="text"
                id="chatInput"
                placeholder="Digite uma mensagem..."
                maxlength="300"
                autocomplete="off"
            >

            <button
                type="button"
                id="enviarChat"
                aria-label="Enviar mensagem"
            >
                ➤
            </button>

        </div>

    </div>


</div>


<!-- ==================================================
     JAVASCRIPT DA SALA
================================================== -->

<script
    src="../../public/js/sala.js"
></script>


<!-- ==================================================
     JAVASCRIPT DE ACESSIBILIDADE
================================================== -->

<script
    src="../../public/js/acessibilidade.js"
></script>

</body>

</html>