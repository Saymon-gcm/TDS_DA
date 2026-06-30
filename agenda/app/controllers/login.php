<?php
    session_name("agenda");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);// md5 serve ocultar aquela propriedade para a pessoa do banco de dados

        include_once("../models/user.php");
        $obj = new User();
        $resp = $obj->ValidarLogin($email,$senha);

        if($resp == TRUE)
        {
            $_SESSION["login"] = md5($email);
            header("Location: ../views/pagina-inicial.php");
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