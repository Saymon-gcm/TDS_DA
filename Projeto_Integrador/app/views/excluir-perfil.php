<?php

session_name("Projeto_Sistema");
session_start();

/* ==================================================
   IMPEDIR CACHE DO NAVEGADOR (botao voltar)
================================================== */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "../models/user.php";


// ==================================================
// VERIFICAR LOGIN
// ==================================================

if (!isset($_SESSION["id_usuarios"])) {

    header("Location: ../../index.php");
    exit;

}


// ==================================================
// PEGAR ID DO USUÁRIO LOGADO
// ==================================================

$id_usuario = $_SESSION["id_usuarios"];


// ==================================================
// EXCLUIR USUÁRIO
// ==================================================

$usuario = new User();

$excluido = $usuario->ExcluirUsuario($id_usuario);


// ==================================================
// SE EXCLUIU COM SUCESSO
// ==================================================

if ($excluido) {

    // Limpa os dados armazenados na sessão
    $_SESSION = [];

    // Destrói a sessão
    session_destroy();

    // Volta para a tela de login
    header("Location: ../../index.php");
    exit;
}


// ==================================================
// SE DEU ERRO
// ==================================================

echo "Não foi possível excluir sua conta.";

?>