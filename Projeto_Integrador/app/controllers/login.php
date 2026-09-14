<?php

session_name("Projeto_Sistema");
session_start();

require_once "../models/user.php";


// =====================================
// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
// =====================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"] ?? '';

    $senha = md5($_POST["senha"] ?? '');


    // =====================================
    // CRIAR OBJETO USER
    // =====================================

    $obj = new user();


    // =====================================
    // VALIDAR LOGIN
    // =====================================

    $resp = $obj->ValidarLogin(
        $email,
        $senha
    );


    // =====================================
    // LOGIN CORRETO
    // =====================================

    if ($resp == TRUE) {


        // =====================================
        // BUSCAR DADOS DO USUÁRIO
        // =====================================

        $usuario = $obj->BuscarUsuarioPorEmail(
            $email
        );


        if ($usuario) {


            // =====================================
            // SALVAR ID DO USUÁRIO NA SESSÃO
            // =====================================

            $_SESSION["id_usuarios"] =
                $usuario["id_usuarios"];


            // =====================================
            // SALVAR LOGIN NA SESSÃO
            // =====================================

            $_SESSION["login"] =
                md5($email);


            // =====================================
            // VERIFICAR SE POSSUI INDIVÍDUO
            // =====================================

            $possuiIndividuo =
                $obj->VerificarIndividuo(
                    $usuario["id_usuarios"]
                );


            // =====================================
            // SE JÁ POSSUI INDIVÍDUO
            // =====================================

            if ($possuiIndividuo) {

                header(
                    "Location: ../views/DashBoard.php"
                );

                exit;

            }


            // =====================================
            // SE É PRIMEIRO ACESSO
            // =====================================

            else {

                header(
                    "Location: ../views/cadastrar-individuo.php"
                );

                exit;

            }

        }

    }


    // =====================================
    // LOGIN INCORRETO
    // =====================================

    else {

        echo '
            <script>

                alert(
                    "Senha ou usuário inválido, tente novamente."
                );

                window.location.href =
                    "../../index.php";

            </script>
        ';

        exit;

    }

}

?>
?>