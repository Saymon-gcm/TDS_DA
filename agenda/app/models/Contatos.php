<?php
class Contatos
{

    private string $name;
    private object $pdo; //pdo recebe um objeto para conexao

    public function __construct() // dps do function (espaço, anderline, anderline)
    {
        include_once("connect.php");
        $conexao = new connect();
        $this->pdo = $conexao->conectarbanco(); // pdo agr viro um objeto atraves da funçao construçao

    }

    public function ListarContatos()
    {
        $sql = "SELECT * FROM contatos;";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }
    public function CadastrarUmContato($email, $telefone, $nome, $orientacoes)
    {

        require_once "contatos.php";

        if (isset($_POST["nome"])) {

            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            $orientacoes = $_POST["orientacoes"];

            $foto = "";

            if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {

                $foto = time() . "_" . $_FILES["foto"]["name"];

                move_uploaded_file(
                    $_FILES["foto"]["tmp_name"],
                    "uploads/" . $foto
                );
            }

            $sql = "INSERT INTO contatos
    (nome, telefone, email, orientacoes, foto)
    VALUES
    (:nome,:telefone,:email,:orientacoes,:foto)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":orientacoes", $orientacoes);
            $stmt->bindParam(":foto", $foto);

            $stmt->execute();

            echo "Contato cadastrado com sucesso!";
        }
    }
}
