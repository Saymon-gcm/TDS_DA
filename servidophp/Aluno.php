<?php
    class Aluno
    {
        private string $nome;
        private string $email;

        public function cadastrarAluno($nomeAluno,$emailAluno)
        {
            require_once("conect.php");
            $obj = new conect();
            $pdo = $obj->conectarbanco();


            $sql = "INSERT INTO alunos (nome,email) values (:nome, :email);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome',$nomeAluno);
            $stmt->bindValue(':email',$emailAluno);

            $stmt->execute();

            return "Aluno Cadastrado com sucesso.";
        }

        public function listaAlunos()
        {
            require_once("conect.php");
            $obj = new conect();
            $pdo = $obj->conectarbanco();

            $sql = "SELECT * FROM alunos;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $tuplas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $tuplas;
        }
    }
?>