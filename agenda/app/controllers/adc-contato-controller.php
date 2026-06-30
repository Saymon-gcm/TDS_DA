<?php
    session_name("agenda");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $orientacoes = $_POST["orientacoes"];

        include_once("../models/Contatos.php");
        $obj = new User();
        $resp = $obj->ValidarLogin($nome, $telefone, $email, $orientacoes);

        if($resp == TRUE)
        {
            $_SESSION["login"] = md5($email);
            header("Location: ../views/adc.contato.php");
        }
        else
        {
            echo'<script>
                        alert("Senha ou Usúario inválido, tente novamente.");
                        window.location.href="http://localhost/agenda/"
            </script>';
        }
    }
?>