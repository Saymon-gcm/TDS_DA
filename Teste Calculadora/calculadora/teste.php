<?php

require_once 'Calculadora.php';

$calc = new Calculadora();

function testar($nome, $obtido, $resultadoEsperado)
{
    echo "<hr>";
    echo "<strong>Teste:</strong> " . $nome . "<br>";
    echo "<strong>Esperado:</strong> " . $resultadoEsperado . "<br>";
    echo "<strong>Obtido:</strong> " . $obtido . "<br>";

    if ($obtido === $resultadoEsperado) {
        echo "<strong>Status: APROVADO</strong><br>";
    } else {
        echo "<strong>Status: REPROVADO</strong><br>";
    }
}

testar(
    "Soma 2 + 3",
    $calc->somar(2, 3),
    5
);

testar(
    "Soma 10 + 20",
    $calc->somar(10, 20),
    30
);

testar(
    "Soma -5 + 5",
    $calc->somar(-5, 5),
    0
);

testar(
    "Subtração 10 - 5",
    $calc->subtrair(10, 5),
    5
);

testar(
    "Subtração 20 - 30",
    $calc->subtrair(20, 30),
    -10
);

testar(
    "Subtração 0 - 0",
    $calc->subtrair(0, 0),
    0
);

testar(
    "Multiplicação 4 × 5",
    $calc->multiplicar(4, 5),
    20
);

testar(
    "Multiplicação 0 × 10",
    $calc->multiplicar(0, 10),
    0
);

testar(
    "Multiplicação -2 × 3",
    $calc->multiplicar(-2, 3),
    -6
);

testar(
    "Divisão 20 ÷ 4",
    $calc->dividir(20, 4),
    5
);

testar(
    "Divisão 15 ÷ 3",
    $calc->dividir(15, 3),
    5
);

testar(
    "Divisão 10 ÷ 2",
    $calc->dividir(10, 2),
    5
);

echo "<hr>";
echo "<strong>Teste: Divisão 10 ÷ 0</strong><br>";
echo "<strong>Esperado:</strong> Erro de divisão por zero<br>";

try {

    $calc->dividir(10, 0);

    echo "<strong>Obtido:</strong> Nenhum erro<br>";
    echo "<strong>Status: REPROVADO</strong><br>";

} catch (Exception $e) {

    echo "<strong>Obtido:</strong> " . $e->getMessage() . "<br>";
    echo "<strong>Status: APROVADO</strong><br>";
}