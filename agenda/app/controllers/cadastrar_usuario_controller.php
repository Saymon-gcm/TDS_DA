<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $nome = $_POST["nome"];

        include_once("../models/user.php");
        $obj = new User();
        $obj->CadastrarUmUsuario($email,$senha,$nome);

    }
?>