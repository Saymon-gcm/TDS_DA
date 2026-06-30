<?php

if (isset($_FILES['foto'])) {

    $nomeImagem = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $nomeImagem);

    echo "Imagem salva com sucesso!";
}
require_once("../models/Contatos.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="../../public/css/style-adc-contato.css" rel="stylesheet" type="text/css" />
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
            <form action="../models/cadastrarContato.php" method="POST" enctype="multipart/form-data">
            <div class="parte-cima">
                <a class="voltar" href="contatos.php">
                    🠔 Voltar
                </a>
                <h1>Novo contato</h1>
            </div>
            <div class="cards-baixos">
                <form  action="../controllers/adc-contato-controller.php" method="POST" enctype="multipart/form-data">
                <div class="card-b1">
                    <h1>Foto</h1>
                    <input type="file" placeholder="Enviar Foto" class="Barra-foto" accept="image/*" id="fotoPerfil">
                    <h1>Nome Completo</h1>
                    <input type="text" name="nome" placeholder="Digite o Nome" class="barra-nome">
                    <h1>Telefone</h1>
                    <input type="text" name="telefone" placeholder="(00) 90000-0000" class="barra-telefone">
                    <h1>Email</h1>
                    <input type="text" name="email" placeholder="email@gmail.com" class="barra-email">
                    <h1>Orientaçoes</h1>
                    <textarea name="orientacoes" class="barra-orientacoes" placeholder="Informações adicionais sobre o contato"></textarea>
                </div>
                </form>
                <form method="POST" enctype="multipart/form-data">
                <div class="card-b2">
                    <img id="preview" src="img/user.png" alt="Foto do contato">
                </div>
                </form>
                <div class="botoes">
                    <button class="bt1">
                        <h1>Cancelar</h1>
                    </button>
                    <button type="submit" class="bt2">
                        <h1>Salvar Contato</h1>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script>
        const foto = document.getElementById("fotoPerfil");
        const preview = document.getElementById("preview");

        foto.onchange = function() {

            if (this.files && this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
            }

        }
    </script>
</body>