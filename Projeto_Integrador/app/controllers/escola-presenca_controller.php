<?php

session_name("Projeto_Sistema");
session_start();

header("Content-Type: application/json; charset=UTF-8");

require_once "../models/user.php";


if (!isset($_SESSION["id_usuarios"])) {

    http_response_code(401);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Usuário não autenticado."
    ]);

    exit;
}


$usuario = new User();

$id_usuario = (int) $_SESSION["id_usuarios"];

$acao = $_POST["acao"] ?? "";

$id_sala = isset($_POST["id_sala"])
    ? filter_var($_POST["id_sala"], FILTER_VALIDATE_INT)
    : null;


switch ($acao) {


    // ==================================================
    // ENTRAR NA ESCOLA
    // ==================================================

    case "entrar":

        $resultado =
            $usuario->EntrarEscolaVirtual(
                $id_usuario
            );

        break;


    // ==================================================
    // HEARTBEAT GLOBAL
    // ==================================================

    case "atividade":

        $resultado =
            $usuario->AtualizarPresencaEscolaVirtual(
                $id_usuario
            );

        break;


    // ==================================================
    // SAIR DA ESCOLA
    // ==================================================

    case "sair":

        $resultado =
            $usuario->SairEscolaVirtual(
                $id_usuario
            );

        break;


    // ==================================================
    // ENTRAR NA SALA
    // ==================================================

    case "entrar_sala":

        if (!$id_sala) {

            $resultado = false;

            break;
        }

        $usuario->EntrarEscolaVirtual(
            $id_usuario
        );

        $resultado =
            $usuario->EntrarSalaEscolaVirtual(
                $id_sala,
                $id_usuario
            );

        break;


    // ==================================================
    // ATUALIZAR SALA
    // ==================================================

    case "atividade_sala":

        if (!$id_sala) {

            $resultado = false;

            break;
        }

        $usuario->AtualizarPresencaEscolaVirtual(
            $id_usuario
        );

        $resultado =
            $usuario->AtualizarPresencaSala(
                $id_sala,
                $id_usuario
            );

        break;


    // ==================================================
    // SAIR DA SALA
    // ==================================================

    case "sair_sala":

        if (!$id_sala) {

            $resultado = false;

            break;
        }

        $usuario->SairSalaEscolaVirtual(
            $id_sala,
            $id_usuario
        );

        $resultado =
            $usuario->SairEscolaVirtual(
                $id_usuario
            );

        break;


    default:

        $resultado = false;

        break;
}


echo json_encode([
    "sucesso" => (bool) $resultado
], JSON_UNESCAPED_UNICODE);