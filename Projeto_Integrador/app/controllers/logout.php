<?php

session_name("Projeto_Sistema");
session_start();


/* ==================================================
   LIMPAR TODOS OS DADOS DA SESSÃO
================================================== */

$_SESSION = [];


/* ==================================================
   DESTRUIR O COOKIE DE SESSÃO NO NAVEGADOR
================================================== */

if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}


/* ==================================================
   DESTRUIR A SESSÃO NO SERVIDOR
================================================== */

session_destroy();


/* ==================================================
   IMPEDIR CACHE DO NAVEGADOR (botão voltar)
================================================== */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


/* ==================================================
   REDIRECIONAR PARA O LOGIN
================================================== */

header("Location: ../../index.php");
exit;

?>
