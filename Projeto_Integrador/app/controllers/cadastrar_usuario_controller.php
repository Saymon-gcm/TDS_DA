<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Pegando os dados do formulário
        $email = $_POST["email"] ?? '';
        $senha_pura = $_POST["senha"] ?? '';
        $nome = $_POST["nome"] ?? '';
        $numero = $_POST["numero"] ?? '';

        // SE SEGURANÇA: Se algum campo estiver vazio, para o código aqui
        if (empty($email) || empty($senha_pura) || empty($nome) || empty($numero)) {
            echo '<script>
                    alert("Por favor, preencha todos os campos do formulário!");
                    window.history.back();
                  </script>';
            exit; // Mata a execução para não tentar salvar no banco
        }

        // Só faz o MD5 se a senha não estiver vazia
        $senha = md5($senha_pura);

        include_once("../models/user.php");
        $obj = new user();
        
        // Passando os dados para a model
        $obj->CadastrarUmUsuario($email, $senha, $nome, $numero);
    }
?>