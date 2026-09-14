<?php

session_name("Projeto_Sistema");
session_start();

header("Content-Type: application/json; charset=UTF-8");

// ==================================================
// VERIFICAR LOGIN
// ==================================================

if (!isset($_SESSION["id_usuarios"])) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Usuário não está logado."
    ]);

    exit;
}

// ==================================================
// CONFIGURAÇÃO WHATSAPP CLOUD API
// ==================================================

$accessToken = "COLOQUE_SEU_ACCESS_TOKEN_AQUI";

$phoneNumberId = "COLOQUE_SEU_PHONE_NUMBER_ID_AQUI";

// ==================================================
// CARREGAR MODEL
// ==================================================

require_once "../models/user.php";

try {

    $usuario = new User();

    $dadosUsuario = $usuario->ListarUmUsuario(
        $_SESSION["id_usuarios"]
    );

    // ==================================================
    // VERIFICAR USUÁRIO
    // ==================================================

    if (!$dadosUsuario) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Usuário não encontrado."
        ]);

        exit;
    }

    // ==================================================
    // PEGAR TELEFONE
    // ==================================================

    $telefone = $dadosUsuario["numero"] ?? "";

    if (empty($telefone)) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Nenhum telefone foi encontrado no cadastro."
        ]);

        exit;
    }

    // ==================================================
    // LIMPAR TELEFONE
    // ==================================================

    $telefone = preg_replace("/\D/", "", $telefone);

    // ==================================================
    // ADICIONAR BRASIL
    // ==================================================

    if (!str_starts_with($telefone, "55")) {
        $telefone = "55" . $telefone;
    }

    // ==================================================
    // MENSAGEM
    // ==================================================

    $mensagem =
        "🚨 ALERTA AUTIWORLD!\n\n" .
        "Uma situação de emergência foi acionada no AutiWorld.\n\n" .
        "Por favor, entre em contato com o usuário o mais rápido possível.";

    // ==================================================
    // URL DA META
    // ==================================================

    $url =
        "https://graph.facebook.com/v23.0/" .
        $phoneNumberId .
        "/messages";

    // ==================================================
    // DADOS
    // ==================================================

    $dados = [

        "messaging_product" => "whatsapp",

        "recipient_type" => "individual",

        "to" => $telefone,

        "type" => "text",

        "text" => [

            "preview_url" => false,

            "body" => $mensagem

        ]

    ];

    // ==================================================
    // CURL
    // ==================================================

    $ch = curl_init($url);

    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            "Authorization: Bearer " . $accessToken,

            "Content-Type: application/json"

        ],

        CURLOPT_POSTFIELDS => json_encode(
            $dados,
            JSON_UNESCAPED_UNICODE
        ),

        CURLOPT_TIMEOUT => 30,

        CURLOPT_SSL_VERIFYPEER => true,

        CURLOPT_SSL_VERIFYHOST => 2

    ]);

    // ==================================================
    // EXECUTAR
    // ==================================================

    $resposta = curl_exec($ch);

    $codigoHTTP = curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );

    $erroCurl = curl_error($ch);

    curl_close($ch);

    // ==================================================
    // ERRO CURL
    // ==================================================

    if ($resposta === false) {

        echo json_encode([

            "sucesso" => false,

            "mensagem" => "Erro ao conectar com a API do WhatsApp.",

            "erro_curl" => $erroCurl

        ]);

        exit;
    }

    // ==================================================
    // RESPOSTA META
    // ==================================================

    $resultado = json_decode(
        $resposta,
        true
    );

    // ==================================================
    // SUCESSO
    // ==================================================

    if ($codigoHTTP >= 200 && $codigoHTTP < 300) {

        echo json_encode([

            "sucesso" => true,

            "mensagem" => "Mensagem enviada com sucesso!",

            "resposta_meta" => $resultado

        ]);

        exit;
    }

    // ==================================================
    // ERRO META
    // ==================================================

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "A Meta recusou o envio da mensagem.",

        "codigo_http" => $codigoHTTP,

        "resposta_meta" => $resultado

    ]);

} catch (Throwable $e) {

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "Erro interno no servidor.",

        "erro" => $e->getMessage()

    ]);

}