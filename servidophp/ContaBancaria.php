<?php
    class ContaBancaria
    {
        private $nome;
        private $saldo;
        
        public function Nome($param1,)
        {
            $this->nome=$param1;
        }

        public function depositar($valor)
        {
            $this->saldo=$valor;
        }

        public function sacar($valor)
        {
             $this->saldo=$valor;
        }

        public function retunSaldo()
        {
        }

        public function returnDepositar()
        {
            return "Senhor "$this->nome"<br />".
            "Seu valor depositado foi = "$this->saldo"<br />".
        }
        public function returnSacar()
        {
            return "Senhor "$this->nome"<br />".
            "Seu valor sacado foi= "$this->saldo"<br />";
        }
    }
?>
<!DOCTYPE html>
<html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Bancaria</title>
</head>
<body>
    <form method="post" action="Carro.php">
        <label>nome:</label>
        <input type="text" name="nome" />
        <br />
        <label>depositar:</label>
        <input type="number" name="depositar" />
        <br />
        <input type="submit" name="enviar" value="depositar" />
        <label>sacar:</label>
        <input type="number" name="sacar" />
        <br />
        <input type="submit" name="enviar" value="sacar" />
    </form>
</body>
</html>