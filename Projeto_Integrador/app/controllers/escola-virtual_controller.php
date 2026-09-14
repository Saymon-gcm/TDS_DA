<?php

session_name("Projeto_Sistema");
session_start();

header("Content-Type: application/json");

require_once "../models/user.php";


if (!isset($_SESSION["id_usuarios"])) {

    http_response_code(401);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}


$id =
    filter_input(
        INPUT_GET,
        "id",
        FILTER_VALIDATE_INT
    );


if (!$id) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Indivíduo inválido."
    ]);

    exit;
}


$usuario = new User();


$pessoa =
    $usuario->BuscarIndividuoEscolaVirtual($id);


if (!$pessoa) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Indivíduo não encontrado."
    ]);

    exit;
}


echo json_encode([

    "sucesso" => true,

    "pessoa" => $pessoa

], JSON_UNESCAPED_UNICODE);