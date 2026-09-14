const botaoEditar =
    document.getElementById("botaoEditar");

const botaoExcluir =
    document.getElementById("botaoExcluir");

const formExcluir =
    document.getElementById("formExcluirPerfil");


if (botaoEditar) {

    botaoEditar.addEventListener(
        "click",
        function () {

            alert(
                "A edição do perfil será adicionada em breve."
            );

        }
    );

}


if (botaoExcluir) {

    botaoExcluir.addEventListener(
        "click",
        function () {

            const confirmar = confirm(
                "Tem certeza que deseja excluir sua conta?\n\n" +
                "Todos os dados da sua conta serão excluídos e essa ação não poderá ser desfeita."
            );


            if (confirmar) {

                formExcluir.submit();

            }

        }
    );

}