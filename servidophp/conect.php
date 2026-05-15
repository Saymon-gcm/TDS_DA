<?php

    class conect
    {
        private $host;//endereço onde o servidor esta instalado
        private $dbname;//Nome da base de dados que iremos utilizar
        private $password;//senha do meu banco de daods
        private $user;//usiario do banco de dados do postgre é postgres
        private $port;//Porta onde as conexoes do banco de dados o padrao do postgre e 5432

        function __construct()
        {
            $this->host = "localhost";
            $this->dbname = "Teste";
            $this->password = "123456";
            $this->user = "postgres";
            $this->port = "5432";
        }

        public function conectarbanco()
        {
            try
            {
                $PDO = new PDO("pgsql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname,$this->user,$this->password);
                echo "eu sou bom de mais";
                return($PDO);
            }
            catch(PDOException $erro)
            {
                $msg = "Falha no acesso com o PostGres:".$erro->getMessage();
                echo $msg;
                return(NULL);
            }
        }
    }

?>