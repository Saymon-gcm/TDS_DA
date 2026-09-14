const inputFoto =
    document.getElementById("foto");

const fotoPreview =
    document.getElementById("fotoPreview");

const formulario =
    document.getElementById("formEditarPerfil");

const mensagem =
    document.getElementById("mensagem");


/* ==================================================
   PRÉVIA DA FOTO
================================================== */

if (inputFoto) {

    inputFoto.addEventListener(
        "change",
        function () {

            const arquivo =
                this.files[0];


            if (!arquivo) {

                return;

            }


            const tiposPermitidos = [
                "image/jpeg",
                "image/png",
                "image/webp"
            ];


            if (
                !tiposPermitidos.includes(
                    arquivo.type
                )
            ) {

                mensagem.textContent =
                    "Escolha uma imagem JPG, PNG ou WEBP.";

                inputFoto.value = "";

                return;

            }


            const tamanhoMaximo =
                5 * 1024 * 1024;


            if (
                arquivo.size >
                tamanhoMaximo
            ) {

                mensagem.textContent =
                    "A imagem deve ter no máximo 5 MB.";

                inputFoto.value = "";

                return;

            }


            const leitor =
                new FileReader();


            leitor.onload =
                function (evento) {

                    fotoPreview.src =
                        evento.target.result;

                };


            leitor.readAsDataURL(
                arquivo
            );


            mensagem.textContent = "";

        }
    );

}



/* ==================================================
   ENVIO DO FORMULÁRIO
================================================== */

if (formulario) {

    formulario.addEventListener(
        "submit",
        function (event) {

            const nome =
                document.getElementById("nome").value.trim();

            const email =
                document.getElementById("email").value.trim();

            const numero =
                document.getElementById("numero").value.trim();


            if (!nome || !email || !numero) {

                event.preventDefault();

                mensagem.textContent =
                    "Preencha todos os campos.";

                return;

            }


            mensagem.textContent = "";

        }
    );

}