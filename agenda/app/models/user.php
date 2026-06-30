<?php
class user
{
    private string $login;
    private string $password;
    private string $name;
    private object $pdo; //pdo recebe um objeto para conexao
    public function __construct() // dps do function (espaço, anderline, anderline)
    {
        include_once("connect.php");
        $conexao = new connect();
        $this->pdo = $conexao->conectarbanco(); // pdo agr viro um objeto atraves da funçao construçao

    }
    public function ValidarLogin($email, $senha)
    {
        $this->login = $email;
        $this->password = $senha;

        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND ativo = TRUE";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $this->login);
        $stmt->bindParam(':senha', $this->password);
        $stmt->execute();

        $vetor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($vetor["email"]) && isset($vetor["senha"])) {
            return (TRUE);
        } else {
            return (FALSE);
        }
    }
    public function CadastrarUmUsuario($email, $senha, $nome)
    {
        $this->name = $nome;

        $sql = "INSERT INTO usuarios (email, senha, nome, ativo) VALUES(:email, :senha, :nome, 'true');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':nome', $nome);
        if ($stmt->execute()) {
            echo '<script>
                        alert("Usuario Cadastrado com sucesso!.");
                        window.location.href="http://localhost/agenda/";
                </script>';
        } else {
            echo "Algo esta faltando para que o usuario seja cadastrado!.";
        }
    }
    public function ListarTodosUsuarios()
    {
        $sql = "SELECT * FROM contatos ORDER BY nome ASC;";
        $stmt = $this->pdo->prepare($sql);
        if (($stmt->execute())) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }
    public function ListarUmUsuario($id_usuario)
    {
        $sql = "SELECT * FROM contatos WHERE id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_usuario);
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }
}
