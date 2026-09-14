<?php

session_name("Projeto_Sistema");
session_start();

require_once "../models/user.php";

/* ==================================================
   VERIFICAR LOGIN
================================================== */

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: ../../index.php");
    exit;
}


/* ==================================================
   VERIFICAR SE FOI ENVIADA UMA FOTO
================================================== */

if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {

    echo "
        <script>
            alert('Selecione uma foto válida.');
            window.location.href = '../views/editar-informacoes.php';
        </script>
    ";

    exit;
}


/* ==================================================
   PEGAR ID DO INDIVÍDUO
================================================== */

$idIndividuo = $_POST["id_individuo"] ?? null;

if (!$idIndividuo) {

    echo "
        <script>
            alert('Indivíduo não encontrado.');
            window.location.href = '../views/informacoes.php';
        </script>
    ";

    exit;
}


/* ==================================================
   ARQUIVO ENVIADO
================================================== */

$arquivo = $_FILES["foto"];

$nomeOriginal = $arquivo["name"];

$tmpNome = $arquivo["tmp_name"];

$tamanho = $arquivo["size"];


/* ==================================================
   VERIFICAR TAMANHO
================================================== */

$limite = 5 * 1024 * 1024; // 5 MB

if ($tamanho > $limite) {

    echo "
        <script>
            alert('A foto deve ter no máximo 5 MB.');
            window.location.href = '../views/editar-informacoes.php';
        </script>
    ";

    exit;
}


/* ==================================================
   VERIFICAR TIPO DA IMAGEM
================================================== */

$tiposPermitidos = [
    "image/jpeg",
    "image/png",
    "image/webp"
];

$finfo = new finfo(FILEINFO_MIME_TYPE);

$tipo = $finfo->file($tmpNome);

if (!in_array($tipo, $tiposPermitidos)) {

    echo "
        <script>
            alert('Formato de imagem não permitido.');
            window.location.href = '../views/editar-informacoes.php';
        </script>
    ";

    exit;
}


/* ==================================================
   DEFINIR EXTENSÃO
================================================== */

$extensoes = [
    "image/jpeg" => "jpg",
    "image/png"  => "png",
    "image/webp" => "webp"
];

$extensao = $extensoes[$tipo];


/* ==================================================
   CRIAR NOME ÚNICO
================================================== */

$novoNome =
    "individuo_" .
    $_SESSION["id_usuarios"] .
    "_" .
    time() .
    "." .
    $extensao;


/* ==================================================
   PASTA DE UPLOAD
================================================== */

$pasta = "../../public/uploads/individuos/";


/* ==================================================
   CRIAR PASTA SE NÃO EXISTIR
================================================== */

if (!is_dir($pasta)) {

    mkdir(
        $pasta,
        0777,
        true
    );
}


/* ==================================================
   CAMINHO COMPLETO
================================================== */

$caminhoCompleto =
    $pasta . $novoNome;


/* ==================================================
   MOVER FOTO
================================================== */

if (!move_uploaded_file(
    $tmpNome,
    $caminhoCompleto
)) {

    echo "
        <script>
            alert('Não foi possível salvar a foto.');
            window.location.href = '../views/editar-informacoes.php';
        </script>
    ";

    exit;
}


/* ==================================================
   CAMINHO PARA O BANCO
================================================== */

$urlBanco =
    "public/uploads/individuos/" . $novoNome;


/* ==================================================
   ATUALIZAR BANCO
================================================== */

$usuario = new User();

$resultado = $usuario->AtualizarFotoIndividuo(
    $idIndividuo,
    $_SESSION["id_usuarios"],
    $urlBanco
);


/* ==================================================
   RESULTADO
================================================== */

if ($resultado) {

    echo "
        <script>
            alert('Foto do indivíduo atualizada com sucesso!');
            window.location.href = '../views/informacoes.php';
        </script>
    ";

} else {

    echo "
        <script>
            alert('Não foi possível atualizar a foto no banco de dados.');
            window.location.href = '../views/editar-informacoes.php';
        </script>
    ";
}