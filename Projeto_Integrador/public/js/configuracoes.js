document.addEventListener("DOMContentLoaded", function () {

    console.log("configuracoes.js carregado!");

    /* =====================================================
       ELEMENTOS
    ===================================================== */

    const altoContraste =
        document.getElementById("altoContraste");

    const modoLeitura =
        document.getElementById("modoLeitura");

    const reduzirAnimacoes =
        document.getElementById("reduzirAnimacoes");

    const botoesFonte =
        document.querySelectorAll(".botao-fonte");

    const restaurar =
        document.getElementById("restaurarConfiguracoes");


    /* =====================================================
       CARREGAR CONFIGURAÇÕES SALVAS
    ===================================================== */

    const contrasteSalvo =
        localStorage.getItem("autiworld_contraste");

    const modoLeituraSalvo =
        localStorage.getItem("autiworld_modo_leitura");

    const animacoesSalvas =
        localStorage.getItem("autiworld_animacoes");

    const tamanhoFonteSalvo =
        localStorage.getItem("autiworld_tamanho_fonte");


    /* =====================================================
       ALTO CONTRASTE
    ===================================================== */

    if (altoContraste) {

        if (contrasteSalvo === "true") {

            altoContraste.checked = true;

            document.documentElement.classList.add(
                "alto-contraste"
            );

        }


        altoContraste.addEventListener("change", function () {

            document.documentElement.classList.toggle(
                "alto-contraste",
                this.checked
            );

            localStorage.setItem(
                "autiworld_contraste",
                this.checked
            );

            console.log(
                "Alto contraste:",
                this.checked
            );

        });

    }


    /* =====================================================
       MODO LEITURA
    ===================================================== */

    if (modoLeitura) {

        if (modoLeituraSalvo === "true") {

            modoLeitura.checked = true;

            document.documentElement.classList.add(
                "modo-leitura"
            );

        }


        modoLeitura.addEventListener("change", function () {

            document.documentElement.classList.toggle(
                "modo-leitura",
                this.checked
            );

            localStorage.setItem(
                "autiworld_modo_leitura",
                this.checked
            );

            console.log(
                "Modo leitura:",
                this.checked
            );

        });

    }


    /* =====================================================
       REDUZIR ANIMAÇÕES
    ===================================================== */

    if (reduzirAnimacoes) {

        if (animacoesSalvas === "true") {

            reduzirAnimacoes.checked = true;

            document.documentElement.classList.add(
                "reduzir-animacoes"
            );

        }


        reduzirAnimacoes.addEventListener("change", function () {

            document.documentElement.classList.toggle(
                "reduzir-animacoes",
                this.checked
            );

            localStorage.setItem(
                "autiworld_animacoes",
                this.checked
            );

            console.log(
                "Reduzir animações:",
                this.checked
            );

        });

    }


    /* =====================================================
       TAMANHO DA FONTE
    ===================================================== */

    function aplicarTamanhoFonte(tamanho) {

        document.documentElement.classList.remove(
            "fonte-90",
            "fonte-100",
            "fonte-110",
            "fonte-125",
            "fonte-grande"
        );

        document.documentElement.classList.add(
            "fonte-" + tamanho
        );

        localStorage.setItem(
            "autiworld_tamanho_fonte",
            tamanho
        );


        /* Destacar visualmente o botão selecionado */

        botoesFonte.forEach(function (botao) {

            botao.classList.toggle(
                "ativo",
                botao.dataset.tamanho === tamanho
            );

        });


        console.log(
            "Tamanho da fonte:",
            tamanho
        );
    }


    /* =====================================================
       CARREGAR TAMANHO SALVO
    ===================================================== */

    if (tamanhoFonteSalvo) {

        aplicarTamanhoFonte(
            tamanhoFonteSalvo
        );

    } else {

        aplicarTamanhoFonte("100");

    }


    /* =====================================================
       BOTÕES DE TAMANHO
    ===================================================== */

    botoesFonte.forEach(function (botao) {

        botao.addEventListener("click", function () {

            const tamanho =
                this.dataset.tamanho;

            aplicarTamanhoFonte(
                tamanho
            );

        });

    });


    /* =====================================================
       RESTAURAR CONFIGURAÇÕES
    ===================================================== */

    if (restaurar) {

        restaurar.addEventListener(
            "click",
            function () {

                localStorage.removeItem(
                    "autiworld_contraste"
                );

                localStorage.removeItem(
                    "autiworld_modo_leitura"
                );

                localStorage.removeItem(
                    "autiworld_animacoes"
                );

                localStorage.removeItem(
                    "autiworld_tamanho_fonte"
                );


                document.documentElement.classList.remove(
                    "alto-contraste",
                    "modo-leitura",
                    "reduzir-animacoes",
                    "fonte-90",
                    "fonte-100",
                    "fonte-110",
                    "fonte-125"
                );


                if (altoContraste) altoContraste.checked = false;
                if (modoLeitura) modoLeitura.checked = false;
                if (reduzirAnimacoes) reduzirAnimacoes.checked = false;


                aplicarTamanhoFonte("100");


                alert(
                    "Configurações restauradas!"
                );

            }
        );

    }

});