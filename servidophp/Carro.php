<?php

    class Carro
    {
        private $cor;
        private $placa;
        private $modelo;

        public function setcaracteristicas($param1, $param2, $param3)
        {
            $this->cor=$param1;
            $this->placa=$param2;
            $this->modelo=$param3;
        }

        public function getcaracteristicas()
        {
            return "A cor do carro e: ".$this->cor."<br />".
            "A placa do carro é: ".$this->placa."<br />".
            "O modelo do carro é: ".$this->modelo."<br />";
        }
    }
?>
<!DOCTYPE html>
<html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de classe</title>
</head>
<body>
    <form method="post" action="Carro.php">
        <label>cor:</label>
        <input type="text" name="cor" />
        <br />
        <label>placa:</label>
        <input type="text" name="placa" />
        <br />
        <label>modelo:</label>
        <input type="text" name="modelo" />
        <br />
        <input type="submit" name="enviar" value="cadastrar" />
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["cor"]) || empty($_POST["placa"]) || empty($_POST["modelo"]))
        {
            echo "<b><i>Você deve cadastrar um veículo</i></b>";
        }
        else
        {
            $meuCarro = new Carro();
            $meuCarro->setcaracteristicas($_POST["cor"],$_POST["placa"],$_POST["modelo"]);
            
            echo $meuCarro->getcaracteristicas();
        }
    }
?>