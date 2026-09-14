<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Pegando os dados do formulário
        $novaSenha = $_POST["senha"];
        $id_usuario = $_GET['id_usuario'];

        include_once("../models/user.php");
        $obj = new user();

        // Passando os dados para a model
        $obj->AtualizarSenha($novaSenha, $id_usuario);
        header("Location: ../../index.php");
    }
?>