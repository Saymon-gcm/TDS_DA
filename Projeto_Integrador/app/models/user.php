<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../vendor/autoload.php';

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

        $vetor = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($vetor && isset($vetor["email"]));
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

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // BUSCAR USUÁRIO PELO NÚMERO
    // ==================================================

    public function BuscarUsuarioPorNumero($numero)
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE numero = :numero
            AND ativo = TRUE
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':numero',
            $numero
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // CADASTRAR USUÁRIO
    // ==================================================

    public function CadastrarUmUsuario(
        $email,
        $senha,
        $nome,
        $numero
    ) {
        $this->name = $nome;
        $this->login = $email;
        $this->password = $senha;
        $this->number = $numero;

        if ($this->BuscarUsuarioPorEmail($email)) {

            echo '
                <script>
                    alert("Este e-mail já está cadastrado!");
                    window.history.back();
                </script>
            ';

            return false;
        }

        if ($this->BuscarUsuarioPorNumero($numero)) {

            echo '
                <script>
                    alert("Este número de telefone já está cadastrado!");
                    window.history.back();
                </script>
            ';

            return false;
        }

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

        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':numero', $numero);

        try {

            if ($stmt->execute()) {

                $id_usuario = $stmt->fetchColumn();

                echo '
                    <script>
                        alert("Usuário cadastrado com sucesso!");
                        window.location.href =
                            "http://localhost/Projeto_Integrador/";
                    </script>
                ';

                return $id_usuario;
            }

            return false;

        } catch (PDOException $e) {

            if ($e->getCode() === "23505") {

                $mensagemErro = $e->getMessage();

                if (stripos($mensagemErro, "numero") !== false) {

                    echo '
                        <script>
                            alert(
                                "Este número de telefone já está cadastrado!"
                            );
                            window.history.back();
                        </script>
                    ';

                } else {

                    echo '
                        <script>
                            alert(
                                "Este e-mail já está cadastrado!"
                            );
                            window.history.back();
                        </script>
                    ';
                }

                return false;
            }

            echo '
                <script>
                    alert(
                        "Não foi possível cadastrar o usuário."
                    );
                    window.history.back();
                </script>
            ';

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
    ) {
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
    // VERIFICAR INDIVÍDUO
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

        return ($stmt->fetch(PDO::FETCH_ASSOC) !== false);
    }


    // ==================================================
    // BUSCAR INDIVÍDUO
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

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // LISTAR USUÁRIOS
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

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }


    // ==================================================
    // BUSCAR USUÁRIO PELO ID
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

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }


    // ==================================================
    // EXCLUIR USUÁRIO
    // ==================================================

    public function ExcluirUsuario($id_usuario)
    {
        $sql = "
            DELETE FROM usuarios
            WHERE id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // ATUALIZAR SENHA
    // ==================================================

    public function AtualizarSenha($novaSenha, $id_usuario)
    {
        $sql = "
            UPDATE usuarios
            SET senha = :novaSenha
            WHERE id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':novaSenha',
            md5($novaSenha),
            PDO::PARAM_STR
        );

        return $stmt->execute();
    }


    // ==================================================
    // ENVIAR EMAIL
    // ==================================================

    public function enviarEmail(
        $destinatario,
        $nome,
        $assunto,
        $mensagem
    ) {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->SMTPAuth = true;

            /*
             * COLOQUE AQUI UMA NOVA SENHA
             * DE APLICATIVO DO GMAIL.
             */

            $mail->Username = 'SEU_EMAIL@gmail.com';

            $mail->Password = 'SUA_SENHA_DE_APP';

            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = 587;

            $mail->setFrom(
                'SEU_EMAIL@gmail.com',
                'AutiWorld'
            );

            $mail->addAddress(
                $destinatario,
                $nome
            );

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Subject = $assunto;

            $mail->Body = $mensagem;

            $mail->AltBody =
                strip_tags($mensagem);

            $mail->send();

            return true;

        } catch (Exception $e) {

            return false;
        }
    }


    // ==================================================
    // EDITAR USUÁRIO
    // ==================================================

    public function EditarUsuario(
        $id_usuario,
        $nome,
        $email,
        $numero,
        $url
    ) {

        $sql = "
            UPDATE usuarios
            SET
                nome = :nome,
                email = :email,
                numero = :numero,
                url = :url
            WHERE id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':numero', $numero);
        $stmt->bindValue(':url', $url);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // VERIFICAR EMAIL DE OUTRO USUÁRIO
    // ==================================================

    public function EmailJaExiste(
        $email,
        $id_usuario
    ) {

        $sql = "
            SELECT id_usuarios
            FROM usuarios
            WHERE email = :email
            AND id_usuarios != :id_usuario
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // ATUALIZAR FOTO DO INDIVÍDUO
    // ==================================================

    public function AtualizarFotoIndividuo(
        $idIndividuo,
        $idUsuario,
        $url
    ) {

        $sql = "
            UPDATE individuos
            SET url = :url
            WHERE id_individuo = :id_individuo
            AND id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':url',
            $url,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':id_individuo',
            $idIndividuo,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_usuario',
            $idUsuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // LISTAR INDIVÍDUOS DA ESCOLA VIRTUAL
    // ==================================================

    public function ListarIndividuosEscolaVirtual()
    {
        $sql = "
            SELECT
                i.id_individuo,
                i.id_usuarios,
                i.nome_completo,
                i.data_nascimento,
                i.idade,
                i.genero,
                i.url AS foto_individuo,

                u.nome AS nome_responsavel,
                u.email,
                u.numero,
                u.url AS foto_usuario

            FROM individuos i

            INNER JOIN usuarios u
                ON i.id_usuarios = u.id_usuarios

            ORDER BY i.nome_completo ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // BUSCAR INDIVÍDUO DA ESCOLA
    // ==================================================

    public function BuscarIndividuoEscolaVirtual(
        $id_individuo
    ) {

        $sql = "
            SELECT
                i.id_individuo,
                i.id_usuarios,
                i.nome_completo,
                i.data_nascimento,
                i.idade,
                i.genero,
                i.url AS foto_individuo,

                u.nome AS nome_responsavel,
                u.email,
                u.numero,
                u.url AS foto_usuario

            FROM individuos i

            INNER JOIN usuarios u
                ON i.id_usuarios = u.id_usuarios

            WHERE i.id_individuo = :id_individuo

            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_individuo',
            $id_individuo,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // ENTRAR NA ESCOLA VIRTUAL
    // ==================================================

    public function EntrarEscolaVirtual($id_usuario)
    {
        $sql = "
            INSERT INTO presencas_escola_virtual
            (
                id_usuarios,
                ultima_atividade
            )
            VALUES
            (
                :id_usuario,
                CURRENT_TIMESTAMP
            )

            ON CONFLICT (id_usuarios)

            DO UPDATE SET
                ultima_atividade = CURRENT_TIMESTAMP
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // ATUALIZAR PRESENÇA NA ESCOLA
    // ==================================================

    public function AtualizarPresencaEscolaVirtual(
        $id_usuario
    ) {

        return $this->EntrarEscolaVirtual(
            $id_usuario
        );
    }


    // ==================================================
    // SAIR DA ESCOLA VIRTUAL
    // ==================================================

    public function SairEscolaVirtual($id_usuario)
    {
        $sql = "
            DELETE FROM presencas_escola_virtual
            WHERE id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // LISTAR INDIVÍDUOS ONLINE
    // ==================================================

    public function ListarIndividuosOnlineEscolaVirtual()
    {
        $sql = "
            SELECT
                i.id_individuo,
                i.id_usuarios,
                i.nome_completo,
                i.data_nascimento,
                i.idade,
                i.genero,

                i.url AS foto_individuo,

                u.nome AS nome_responsavel,
                u.email,
                u.numero,
                u.url AS foto_usuario,

                p.ultima_atividade

            FROM presencas_escola_virtual p

            INNER JOIN usuarios u
                ON p.id_usuarios = u.id_usuarios

            INNER JOIN individuos i
                ON i.id_usuarios = u.id_usuarios

            WHERE p.ultima_atividade >=
                CURRENT_TIMESTAMP - INTERVAL '60 seconds'

            ORDER BY i.nome_completo ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // CRIAR SALA
    // ==================================================

    public function CriarSalaEscolaVirtual(
        $nome,
        $descricao,
        $id_usuario
    ) {

        $sql = "
            INSERT INTO salas_escola_virtual
            (
                nome,
                descricao,
                id_criador
            )

            VALUES
            (
                :nome,
                :descricao,
                :id_usuario
            )

            RETURNING id_sala
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':nome',
            $nome
        );

        $stmt->bindValue(
            ':descricao',
            $descricao
        );

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchColumn();
    }


    // ==================================================
    // LISTAR SALAS
    // ==================================================

    public function ListarSalasEscolaVirtual()
    {
        $sql = "
            SELECT
                s.id_sala,
                s.nome,
                s.descricao,
                s.id_criador,
                s.id_professor,
                s.data_criacao,
                s.ativa,

                u.nome AS criador

            FROM salas_escola_virtual s

            INNER JOIN usuarios u
                ON s.id_criador = u.id_usuarios

            WHERE s.ativa = TRUE

            ORDER BY s.data_criacao DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // ENTRAR NA SALA
    // ==================================================

    public function EntrarSalaEscolaVirtual(
        $id_sala,
        $id_usuario
    ) {

        $sql = "
            INSERT INTO participantes_sala
            (
                id_sala,
                id_usuarios,
                entrou_em,
                ultima_atividade
            )

            VALUES
            (
                :id_sala,
                :id_usuario,
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            )

            ON CONFLICT (id_sala, id_usuarios)

            DO UPDATE SET
                ultima_atividade = CURRENT_TIMESTAMP
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // ATUALIZAR PRESENÇA NA SALA
    // ==================================================

    public function AtualizarPresencaSala(
        $id_sala,
        $id_usuario
    ) {

        $sql = "
            UPDATE participantes_sala

            SET ultima_atividade =
                CURRENT_TIMESTAMP

            WHERE id_sala = :id_sala

            AND id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // LISTAR PARTICIPANTES ONLINE DA SALA
    // ==================================================

    public function ListarParticipantesSala($id_sala)
    {
        $sql = "
            SELECT
                i.id_individuo,
                i.id_usuarios,
                i.nome_completo,
                i.data_nascimento,
                i.idade,
                i.genero,

                i.url AS foto_individuo,

                u.nome AS nome_responsavel,
                u.email,
                u.numero,
                u.url AS foto_usuario,

                ps.entrou_em,
                ps.ultima_atividade

            FROM participantes_sala ps

            INNER JOIN usuarios u
                ON ps.id_usuarios = u.id_usuarios

            INNER JOIN individuos i
                ON i.id_usuarios = u.id_usuarios

            WHERE ps.id_sala = :id_sala

            AND ps.ultima_atividade >=
                CURRENT_TIMESTAMP - INTERVAL '60 seconds'

            ORDER BY i.nome_completo ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // BUSCAR SALA
    // ==================================================

    public function ListarSala($id_sala)
    {
        $sql = "
            SELECT

                s.id_sala,
                s.nome,
                s.descricao,
                s.id_criador,
                s.id_professor,
                s.data_criacao,
                s.ativa,

                criador.nome AS nome_criador,
                criador.url AS foto_criador,

                professor.nome AS nome_professor,
                professor.email AS email_professor,
                professor.url AS foto_professor

            FROM salas_escola_virtual s

            INNER JOIN usuarios criador
                ON s.id_criador = criador.id_usuarios

            LEFT JOIN usuarios professor
                ON s.id_professor = professor.id_usuarios

            WHERE s.id_sala = :id_sala

            AND s.ativa = TRUE

            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==================================================
    // DEFINIR PROFESSOR
    // ==================================================

    public function DefinirProfessorSala(
        $id_sala,
        $id_professor,
        $id_criador
    ) {

        $sql = "
            UPDATE salas_escola_virtual

            SET id_professor = :id_professor

            WHERE id_sala = :id_sala

            AND id_criador = :id_criador

            AND ativa = TRUE

            AND EXISTS
            (
                SELECT 1

                FROM participantes_sala ps

                WHERE ps.id_sala =
                    salas_escola_virtual.id_sala

                AND ps.id_usuarios =
                    :id_professor

                AND ps.ultima_atividade >=
                    CURRENT_TIMESTAMP - INTERVAL '60 seconds'
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_professor',
            $id_professor,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_criador',
            $id_criador,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }


    // ==================================================
    // REMOVER PROFESSOR
    // ==================================================

    public function RemoverProfessorSala(
        $id_sala,
        $id_criador
    ) {

        $sql = "
            UPDATE salas_escola_virtual

            SET id_professor = NULL

            WHERE id_sala = :id_sala

            AND id_criador = :id_criador
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_criador',
            $id_criador,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }


    // ==================================================
    // SAIR DA SALA
    // ==================================================

    public function SairSalaEscolaVirtual(
        $id_sala,
        $id_usuario
    ) {

        $sql = "
            DELETE FROM participantes_sala

            WHERE id_sala = :id_sala

            AND id_usuarios = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id_sala',
            $id_sala,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id_usuario',
            $id_usuario,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }
}