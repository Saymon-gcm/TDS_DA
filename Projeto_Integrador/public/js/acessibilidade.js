(function () {

    console.log("acessibilidade.js carregado!");

    /* =====================================================
       CONTRASTE
    ===================================================== */

    const contraste =
        localStorage.getItem("autiworld_contraste");

    if (contraste === "true") {

        document.documentElement.classList.add(
            "alto-contraste"
        );

    }


    /* =====================================================
       MODO LEITURA
    ===================================================== */

    const modoLeitura =
        localStorage.getItem(
            "autiworld_modo_leitura"
        );

    if (modoLeitura === "true") {

        document.documentElement.classList.add(
            "modo-leitura"
        );

    }


    /* =====================================================
       REDUZIR ANIMAÇÕES
    ===================================================== */

    const animacoes =
        localStorage.getItem(
            "autiworld_animacoes"
        );

    if (animacoes === "true") {

        document.documentElement.classList.add(
            "reduzir-animacoes"
        );

    }


    /* =====================================================
       TAMANHO DA FONTE
    ===================================================== */

    const tamanhoFonte =
        localStorage.getItem(
            "autiworld_tamanho_fonte"
        );

    if (tamanhoFonte) {

        document.documentElement.classList.add(
            "fonte-" + tamanhoFonte
        );

    }

})();