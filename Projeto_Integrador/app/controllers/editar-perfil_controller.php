<?php

session_name("Projeto_Sistema");
session_start();

require_once "../models/user.php";


// ==================================================
// VERIFICAR LOGIN
// ==================================================

if (!isset($_SESSION["id_usuarios"])) {

    header("Location: ../../index.php");
    exit;

}


// ==================================================
// VERIFICAR POST
// ==================================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../views/perfil.php");
    exit;

}


$id_usuario =
    $_SESSION["id_usuarios"];


$nome =
    trim($_POST["nome"] ?? '');


$email =
    trim($_POST["email"] ?? '');


$numero =
    trim($_POST["numero"] ?? '');


// ==================================================
// VALIDAR CAMPOS
// ==================================================

if (
    $nome === '' ||
    $email === '' ||
    $numero === ''
) {

    header(
        "Location: ../views/editar-perfil.php?erro=preencha"
    );

    exit;

}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    header(
        "Location: ../views/editar-perfil.php?erro=email"
    );

    exit;

}


// ==================================================
// OBJETO USER
// ==================================================

$usuario = new User();


// ==================================================
// VERIFICAR E-MAIL DUPLICADO
// ==================================================

$emailExistente =
    $usuario->EmailJaExiste(
        $email,
        $id_usuario
    );


if ($emailExistente) {

    header(
        "Location: ../views/editar-perfil.php?erro=email-existente"
    );

    exit;

}


// ==================================================
// BUSCAR DADOS ATUAIS
// ==================================================

$dadosAtuais =
    $usuario->ListarUmUsuario(
        $id_usuario
    );


if (!$dadosAtuais) {

    header("Location: ../../index.php");
    exit;

}


// ==================================================
// MANTER FOTO ATUAL
// ==================================================

$urlFoto = $dadosAtuais["url"] ?? '';


// ==================================================
// UPLOAD DA FOTO
// ==================================================

if (
    isset($_FILES["foto"]) &&
    $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE
) {


    // ----------------------------------------------
    // VERIFICAR ERRO
    // ----------------------------------------------

    if (
        $_FILES["foto"]["error"] !==
        UPLOAD_ERR_OK
    ) {

        header(
            "Location: ../views/editar-perfil.php?erro=upload"
        );

        exit;

    }


    // ----------------------------------------------
    // TAMANHO
    // ----------------------------------------------

    $tamanhoMaximo =
        5 * 1024 * 1024;


    if (
        $_FILES["foto"]["size"] >
        $tamanhoMaximo
    ) {

        header(
            "Location: ../views/editar-perfil.php?erro=tamanho"
        );

        exit;

    }


    // ----------------------------------------------
    // VERIFICAR MIME
    // ----------------------------------------------

    $finfo =
        new finfo(FILEINFO_MIME_TYPE);


    $mime =
        $finfo->file(
            $_FILES["foto"]["tmp_name"]
        );


    $tiposPermitidos = [

        'image/jpeg' => 'jpg',

        'image/png' => 'png',

        'image/webp' => 'webp'

    ];


    if (
        !isset(
            $tiposPermitidos[$mime]
        )
    ) {

        header(
            "Location: ../views/editar-perfil.php?erro=formato"
        );

        exit;

    }


    // ----------------------------------------------
    // PASTA
    // ----------------------------------------------

    $pastaUpload =
        "../../public/uploads/perfil/";


    if (
        !is_dir($pastaUpload)
    ) {

        mkdir(
            $pastaUpload,
            0755,
            true
        );

    }


    // ----------------------------------------------
    // NOME ÚNICO
    // ----------------------------------------------

    $nomeArquivo =
        "usuario_" .
        $id_usuario .
        "_" .
        bin2hex(
            random_bytes(8)
        ) .
        "." .
        $tiposPermitidos[$mime];


    $caminhoCompleto =
        $pastaUpload .
        $nomeArquivo;


    // ----------------------------------------------
    // MOVER FOTO
    // ----------------------------------------------

    if (
        !move_uploaded_file(
            $_FILES["foto"]["tmp_name"],
            $caminhoCompleto
        )
    ) {

        header(
            "Location: ../views/editar-perfil.php?erro=salvar-foto"
        );

        exit;

    }


    // ----------------------------------------------
    // CAMINHO SALVO NO BANCO
    // ----------------------------------------------

    $urlFoto =
        "public/uploads/perfil/" .
        $nomeArquivo;


    // ----------------------------------------------
    // APAGAR FOTO ANTIGA
    // ----------------------------------------------

    if (
        !empty($dadosAtuais["url"])
    ) {

        $fotoAntiga =
            "../../" .
            $dadosAtuais["url"];


        if (
            file_exists($fotoAntiga)
        ) {

            unlink($fotoAntiga);

        }

    }

}


// ==================================================
// ATUALIZAR BANCO
// ==================================================

$atualizado =
    $usuario->EditarUsuario(
        $id_usuario,
        $nome,
        $email,
        $numero,
        $urlFoto
    );


// ==================================================
// RESULTADO
// ==================================================

if ($atualizado) {

    header(
        "Location: ../views/perfil.php?sucesso=1"
    );

    exit;

}


header(
    "Location: ../views/editar-perfil.php?erro=atualizar"
);

exit;

?>