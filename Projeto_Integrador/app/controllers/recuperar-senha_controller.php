<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Pegando os dados do formulário
        $email = $_POST["email"];

        include_once("../models/user.php");
        $obj = new user();

        $resp = $obj->BuscarUsuarioPorEmail($email);
        $id_usuario = $resp['id_usuarios'];
        $nome = $resp['nome'];
        $assunto = "Recuperação de senha";
        $msg = "Prezado(a) $nome,<br><br>Recebemos uma solicitação para recuperação de senha.<br><br>Se você não solicitou esta alteração, por favor, ignore este e-mail.<br><br>Atenciosamente,<br>A equipe de suporte.<a href='http://localhost/Projeto_Integrador/app/views/recuperar-senha.php?id_usuario=$id_usuario'>Clique aqui para recuperar sua senha</a>";
        // Passando os dados para a model
        $obj->enviarEmail($email, $nome, $assunto, $msg);
        header("Location: ../../index.php");
    }
?>