<?php

require_once ("../models/Contatos.php");
$obj = new Contatos();
$contatos = $obj->ListarContatos();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="../../public/css/style-contatos.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="pag-inic">
        <div class="pag-inic-ld-esq">
            <div class="titulo">
                <img src="../../public/css/img/logo.png" alt="ícone">
                <h1>Agenda</h1>
            </div>
            <div class="item-1">
                <a href="pagina-inicial.php">
                    <button type="submit" name="botao" value="dashboard">
                        <h1>DashBoard</h1>
                    </button>
                </a>
                <img src="../../public/css/img/icone-casa-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-2">
                <a href="contatos.php">
                    <button type="submit" name="botao" value="dashboard">
                        <h1>Contatos</h1>
                    </button>
                </a>
                <img src="../../public/css/img/icone-contatos-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-3">
                <a href="compromissos.php">
                    <button type="submit" name="botao" value="dashboard">
                        <h1>Compromissos</h1>
                    </button>
                </a>
                <img src="../../public/css/img/icone-agenda-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-4">
                <a href="perfil.php">
                    <button type="submit" name="botao" value="dashboard">
                        <h1>Perfil</h1>
                    </button>
                </a>
                <img src="../../public/css/img/icone-perfil-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-5">
                <a href="configuracoes.php">
                    <button type="submit" name="botao" value="dashboard">
                        <h1>Configurações</h1>
                    </button>
                </a>
                <img src="../../public/css/img/icone-engrenagem-removebg-preview.png" alt="ícone">
            </div>
            <div class="item-6">
                <button type="submit" name="botao" value="dashboard">
                    <h1>Sair</h1>
                </button>
                <img src="../../public/css/img/icone-sair-removebg-preview.png" alt="ícone">
            </div>
        </div>
        <div class="pag-inic-ld-dir">
            <div class="cabecalho-cima">
                <h1>Contatos</h1>
            </div>
            <hr>
            <div class="cabecalho-baixo">
                <img src="../../public/css/img/icone-lupa-removebg-preview.png" alt="ícone">
                <input type="text" name="pesquisa" placeholder="Pesquisar" class="pesquisa">
                <a href="adc.contato.php">
                    <button class="adicionar">
                        <h1>➕ Novo Contato</h1>
                    </button>
                </a>
            </div>
            <table>

                    <thead>

                        <tr>

                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Orientações</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($contatos as $contato) { ?>

                            <tr>

                                <td>
                                    <img src="../../uploads/<?php echo $contato['foto']; ?>" width="60">
                                </td>

                                <td><?php echo $contato['nome']; ?></td>

                                <td><?php echo $contato['telefone']; ?></td>

                                <td><?php echo $contato['email']; ?></td>

                                <td><?php echo $contato['orientacoes']; ?></td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
        </div>
    </div>
</body>