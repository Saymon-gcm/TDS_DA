<?php

class user
{
    private string $login;
    private string $password;
    private string $name;
    private string $number;
    private object $pdo;


    // ==================================================
    // CONEXÃO COM O BANCO
    // ==================================================

    public function __construct()
    {
        include_once("connect.php");

        $conexao = new connect();

        $this->pdo = $conexao->conectarbanco();
    }


    // ==================================================
    // VALIDAR LOGIN
    // ==================================================

    public function ValidarLogin($email, $senha)
    {
        $this->login = $email;
        $this->password = $senha;

        $sql = "
            SELECT *
            FROM usuarios
            WHERE email = :email
            AND senha = :senha
            AND ativo = TRUE
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':email',
            $this->login
        );

        $stmt->bindValue(
            ':senha',
            $this->password
        );

        $stmt->execute();

        $vetor = $stmt->fetch(
            PDO::FETCH_ASSOC
        );

        if ($vetor && isset($vetor["email"])) {

            return true;

        } else {

            return false;

        }
    }


    // ==================================================
    // BUSCAR USUÁRIO PELO EMAIL
    // ==================================================

    public function BuscarUsuarioPorEmail($email)
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE email = :email
            AND ativo = TRUE
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':email',
            $email
        );

        $stmt->execute();

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }


    // ==================================================
    // CADASTRAR USUÁRIO
    // ==================================================

    public function CadastrarUmUsuario(
        $email,
        $senha,
        $nome,
        $numero
    )
    {
        $this->name = $nome;

        $this->login = $email;

        $this->password = $senha;

        $this->number = $numero;


        $sql = "
            INSERT INTO usuarios
            (
                email,
                senha,
                nome,
                numero,
                ativo
            )
            VALUES
            (
                :email,
                :senha,
                :nome,
                :numero,
                TRUE
            )
            RETURNING id_usuarios
        ";


        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(
            ':email',
            $email
        );

        $stmt->bindValue(
            ':senha',
            $senha
        );

        $stmt->bindValue(
            ':nome',
            $nome
        );

        $stmt->bindValue(
            ':numero',
            $numero
        );


        if ($stmt->execute()) {

            // Pega o ID gerado pelo PostgreSQL
            $id_usuario = $stmt->fetchColumn();


            echo '
                <script>
                    alert("Usuário cadastrado com sucesso!");
                    window.location.href="http://localhost/Projeto_Integrador/";
                </script>
            ';

            return $id_usuario;

        } else {

            echo "
                Algo está faltando para que o usuário seja cadastrado.
            ";

            return false;
        }
    }


    // ==================================================
    // CADASTRAR INDIVÍDUO
    // ==================================================

    public function CadastrarIndividuo(
        $id_usuario,
        $nome_completo,
        $data_nascimento,
        $idade,
        $genero
    )
    {

        $sql = "
            INSERT INTO individuos
            (
                id_usuarios,
                nome_completo,
                data_nascimento,
                idade,
                genero
            )
            VALUES
            (
                :id_usuario,
                :nome_completo,
                :data_nascimento,
                :idade,
                :genero
            )
        ";


        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );


        $stmt->bindValue(
            ':nome_completo',
            $nome_completo
        );


        $stmt->bindValue(
            ':data_nascimento',
            $data_nascimento
        );


        $stmt->bindValue(
            ':idade',
            $idade,
            PDO::PARAM_INT
        );


        $stmt->bindValue(
            ':genero',
            $genero
        );


        return $stmt->execute();
    }


    // ==================================================
    // VERIFICAR SE USUÁRIO POSSUI INDIVÍDUO
    // ==================================================

    public function VerificarIndividuo($id_usuario)
    {

        $sql = "
            SELECT id_individuo
            FROM individuos
            WHERE id_usuarios = :id_usuario
            LIMIT 1
        ";


        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );


        $stmt->execute();


        $resultado = $stmt->fetch(
            PDO::FETCH_ASSOC
        );


        if ($resultado) {

            return true;

        }


        return false;
    }


    // ==================================================
    // BUSCAR INDIVÍDUO DO USUÁRIO
    // ==================================================

    public function BuscarIndividuo($id_usuario)
    {

        $sql = "
            SELECT *
            FROM individuos
            WHERE id_usuarios = :id_usuario
            LIMIT 1
        ";


        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );


        $stmt->execute();


        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }


    // ==================================================
    // LISTAR TODOS OS USUÁRIOS
    // ==================================================

    public function ListarTodosUsuarios()
    {

        $sql = "
            SELECT *
            FROM usuarios
            ORDER BY nome ASC
        ";


        $stmt = $this->pdo->prepare($sql);


        if ($stmt->execute()) {

            return $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

        }


        return false;
    }


    // ==================================================
    // BUSCAR UM USUÁRIO PELO ID
    // ==================================================

    public function ListarUmUsuario($id_usuario)
    {

        $sql = "
            SELECT *
            FROM usuarios
            WHERE id_usuarios = :id
        ";


        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(
            ':id',
            $id_usuario,
            PDO::PARAM_INT
        );


        if ($stmt->execute()) {

            return $stmt->fetch(
                PDO::FETCH_ASSOC
            );

        }


        return false;
    }
}