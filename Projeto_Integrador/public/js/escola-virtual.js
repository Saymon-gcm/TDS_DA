document.addEventListener("DOMContentLoaded", function () {

    /* ==================================================
       PRESENÇA NA ESCOLA VIRTUAL
    ================================================== */

    function enviarPresenca(acao) {

        const dados = new FormData();

        dados.append("acao", acao);

        fetch(
            "../controllers/escola-presenca_controller.php",
            {
                method: "POST",
                body: dados
            }
        )
        .then(function (response) {

            if (!response.ok) {
                throw new Error(
                    "Erro HTTP: " + response.status
                );
            }

            return response.json();

        })
        .then(function (resultado) {

            if (!resultado.sucesso) {

                console.warn(
                    "Presença não atualizada:",
                    resultado.mensagem
                );

            }

        })
        .catch(function (erro) {

            console.error(
                "Erro na presença:",
                erro
            );

        });

    }


    /* ==================================================
       ENTRAR NA ESCOLA VIRTUAL
    ================================================== */

    enviarPresenca("entrar");


    /* ==================================================
       ATUALIZAR PRESENÇA A CADA 30 SEGUNDOS
    ================================================== */

    setInterval(function () {

        enviarPresenca("atividade");

    }, 30000);


    /* ==================================================
       SAIR DA ESCOLA VIRTUAL
    ================================================== */

    window.addEventListener(
        "beforeunload",
        function () {

            const dados = new FormData();

            dados.append("acao", "sair");


            navigator.sendBeacon(
                "../controllers/escola-presenca_controller.php",
                dados
            );

        }
    );


    /* ==================================================
       MENU DO PERFIL
    ================================================== */

    const perfil =
        document.getElementById("perfil");

    const menuPerfil =
        document.getElementById("menuPerfil");


    if (perfil && menuPerfil) {

        perfil.addEventListener(
            "click",
            function (event) {

                event.stopPropagation();

                menuPerfil.classList.toggle(
                    "mostrar"
                );

            }
        );


        menuPerfil.addEventListener(
            "click",
            function (event) {

                event.stopPropagation();

            }
        );

    }


    document.addEventListener(
        "click",
        function () {

            if (menuPerfil) {

                menuPerfil.classList.remove(
                    "mostrar"
                );

            }

        }
    );


    /* ==================================================
       MODAL DO INDIVÍDUO
    ================================================== */

    const modal =
        document.getElementById("modalPessoa");

    const dadosPessoa =
        document.getElementById("dadosPessoa");

    const fecharModal =
        document.getElementById("fecharModal");


    /*
       Só executa se o modal existir.
    */

    if (
        modal &&
        dadosPessoa
    ) {


        /* ==================================================
           CARDS DOS INDIVÍDUOS
        ================================================== */

        document
            .querySelectorAll(".pessoa-card")
            .forEach(function (card) {

                card.addEventListener(
                    "click",
                    function () {

                        const id =
                            this.dataset.id;


                        if (!id) {

                            console.error(
                                "ID do indivíduo não encontrado."
                            );

                            return;

                        }


                        /* ==========================================
                           ABRIR MODAL
                        ========================================== */

                        modal.classList.add(
                            "mostrar"
                        );


                        /* ==========================================
                           LOADING
                        ========================================== */

                        dadosPessoa.innerHTML = `

                            <div class="carregando">

                                <div>
                                    ⏳
                                </div>

                                <p>
                                    Carregando informações...
                                </p>

                            </div>

                        `;


                        /* ==========================================
                           BUSCAR INFORMAÇÕES
                        ========================================== */

                        fetch(
                            "../controllers/escola-virtual_controller.php?id="
                            + encodeURIComponent(id)
                        )

                        .then(function (response) {

                            if (!response.ok) {

                                throw new Error(
                                    "Erro HTTP: "
                                    + response.status
                                );

                            }

                            return response.json();

                        })


                        .then(function (dados) {


                            /* ======================================
                               VERIFICAR RESPOSTA
                            ====================================== */

                            if (!dados.sucesso) {

                                dadosPessoa.innerHTML = `

                                    <div class="erro-modal">

                                        <div>
                                            ⚠️
                                        </div>

                                        <p>
                                            ${
                                                dados.mensagem
                                                ||
                                                "Não foi possível carregar as informações."
                                            }
                                        </p>

                                    </div>

                                `;

                                return;

                            }


                            const p =
                                dados.pessoa;


                            /* ======================================
                               FOTO
                            ====================================== */

                            let fotoHTML = "👤";


                            if (p.url) {

                                fotoHTML = `

                                    <img
                                        src="../../${escapeHtml(p.url)}"
                                        alt="Foto do indivíduo"
                                    >

                                `;

                            }


                            /* ======================================
                               INFORMAÇÕES
                            ====================================== */

                            dadosPessoa.innerHTML = `


                                <!-- ===============================
                                     CABEÇALHO DO INDIVÍDUO
                                ================================ -->

                                <div class="perfil-individuo">


                                    <div class="avatar-modal">

                                        ${fotoHTML}

                                    </div>


                                    <h2>

                                        ${
                                            escapeHtml(
                                                p.nome_completo
                                            )
                                        }

                                    </h2>


                                    <span class="status-modal">

                                        👤 Indivíduo cadastrado

                                    </span>


                                </div>



                                <!-- ===============================
                                     INDIVÍDUO
                                ================================ -->

                                <section class="informacao-secao">


                                    <h3>

                                        🧩 Informações do indivíduo (IS)

                                    </h3>


                                    <div class="informacao-linha">

                                        <strong>
                                            Nome completo
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.nome_completo
                                                )
                                            }

                                        </span>

                                    </div>



                                    <div class="informacao-linha">

                                        <strong>
                                            Data de nascimento
                                        </strong>

                                        <span>

                                            ${
                                                formatarData(
                                                    p.data_nascimento
                                                )
                                            }

                                        </span>

                                    </div>



                                    <div class="informacao-linha">

                                        <strong>
                                            Idade
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.idade ??
                                                    "Não informado"
                                                )
                                            }

                                        </span>

                                    </div>



                                    <div class="informacao-linha">

                                        <strong>
                                            Gênero
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.genero ??
                                                    "Não informado"
                                                )
                                            }

                                        </span>

                                    </div>


                                </section>



                                <!-- ===============================
                                     RESPONSÁVEL
                                ================================ -->

                                <section class="informacao-secao responsavel">


                                    <h3>

                                        👤 Responsável

                                    </h3>



                                    <div class="informacao-linha">

                                        <strong>
                                            Nome
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.nome_responsavel
                                                )
                                            }

                                        </span>

                                    </div>



                                    <div class="informacao-linha">

                                        <strong>
                                            E-mail
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.email
                                                )
                                            }

                                        </span>

                                    </div>



                                    <div class="informacao-linha">

                                        <strong>
                                            Telefone
                                        </strong>

                                        <span>

                                            ${
                                                escapeHtml(
                                                    p.numero ??
                                                    "Não informado"
                                                )
                                            }

                                        </span>

                                    </div>


                                </section>


                            `;

                        })


                        /* ==========================================
                           ERRO
                        ========================================== */

                        .catch(function (erro) {

                            console.error(
                                "Erro ao buscar indivíduo:",
                                erro
                            );


                            dadosPessoa.innerHTML = `

                                <div class="erro-modal">

                                    <div>
                                        ❌
                                    </div>

                                    <p>
                                        Erro ao carregar
                                        as informações.
                                    </p>

                                </div>

                            `;

                        });

                    }

                );

            });

    }


    /* ==================================================
       FECHAR MODAL
    ================================================== */

    if (fecharModal && modal) {

        fecharModal.addEventListener(
            "click",
            function () {

                modal.classList.remove(
                    "mostrar"
                );

            }
        );


        /* ==============================================
           CLICAR FORA DO MODAL
        ============================================== */

        modal.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === modal
                ) {

                    modal.classList.remove(
                        "mostrar"
                    );

                }

            }
        );

    }


    /* ==================================================
       ESC FECHA O MODAL
    ================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                modal
            ) {

                modal.classList.remove(
                    "mostrar"
                );

            }

        }
    );

});


/* ==================================================
   SEGURANÇA
================================================== */

function escapeHtml(valor) {

    if (
        valor === null ||
        valor === undefined
    ) {

        return "";

    }


    return String(valor)

        .replaceAll(
            "&",
            "&amp;"
        )

        .replaceAll(
            "<",
            "&lt;"
        )

        .replaceAll(
            ">",
            "&gt;"
        )

        .replaceAll(
            '"',
            "&quot;"
        )

        .replaceAll(
            "'",
            "&#039;"
        );

}


/* ==================================================
   FORMATAR DATA
================================================== */

function formatarData(data) {

    if (!data) {

        return "Não informado";

    }


    const partes =
        String(data).split("-");


    if (partes.length !== 3) {

        return escapeHtml(data);

    }


    return (

        partes[2].substring(0, 2)
        + "/"
        + partes[1]
        + "/"
        + partes[0]

    );

}
