<?php
    class IMC {
        public function calcularIMC($peso, $altura) {
            if ($altura <= 0) {
                throw new Exception("Altura deve ser maior que zero.");
            }
            return $peso / ($altura * $altura);
        }

        public function classificarIMC($imc) {
            if ($imc < 18.5) {
                return "Abaixo do peso";
            } elseif ($imc < 24.9) {
                return "Peso normal";
            } elseif ($imc < 29.9) {
                return "Sobrepeso";
            } else {
                return "Obesidade";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="number"] {
            width: 100px;
        }
        </style>
</head>
<body>
    <form method="post">
        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" id="peso" step="0.1" required>
        <br>
        <label for="altura">Altura (m):</label>
        <input type="number" name="altura" id="altura" step="0.01" required>
        <br>
        <input type="submit" value="Calcular IMC">
    
</body>
</html>