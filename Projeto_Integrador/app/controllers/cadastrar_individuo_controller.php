<?php

// =====================================
// INICIAR SESSÃO
// =====================================

session_name("Projeto_Sistema");
session_start();


// =====================================
// INCLUIR MODEL DO USUÁRIO
// =====================================

require_once "../models/user.php";


// =====================================
// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
// =====================================

if (!isset($_SESSION['id_usuarios'])) {

    header("Location: ../../index.php");
    exit;

}


// =====================================
// PEGAR ID DO USUÁRIO LOGADO
// =====================================

$id_usuarios = $_SESSION['id_usuarios'];


// =====================================
// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
// =====================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../../app/views/cadastrar_individuo.php");
    exit;

}


// =====================================
// RECEBER DADOS DO FORMULÁRIO
// =====================================

$nome_completo = trim(
    $_POST['nome_completo'] ?? ''
);

$data_nascimento = $_POST['data_nascimento'] ?? '';

$idade = $_POST['idade'] ?? '';

$genero = trim(
    $_POST['genero'] ?? ''
);


// =====================================
// VERIFICAR CAMPOS
// =====================================

if (
    empty($nome_completo) ||
    empty($data_nascimento) ||
    empty($idade) ||
    empty($genero)
) {

    echo "Preencha todos os campos.";

    exit;

}


// =====================================
// CONVERTER IDADE PARA INTEIRO
// =====================================

$idade = (int) $idade;


// =====================================
// CRIAR OBJETO USER
// =====================================

$usuario = new user();


// =====================================
// CADASTRAR INDIVÍDUO
// =====================================

$resultado = $usuario->CadastrarIndividuo(

    $id_usuarios,

    $nome_completo,

    $data_nascimento,

    $idade,

    $genero

);


// =====================================
// VERIFICAR RESULTADO
// =====================================

if ($resultado) {

    header(
        "Location: ../../app/views/DashBoard.php"
    );

    exit;

} else {

    echo "Erro ao cadastrar o indivíduo.";

}

?>