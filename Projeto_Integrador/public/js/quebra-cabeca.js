// ==================================================
// QUEBRA-CABEÇA
// ARRASTAR + SOLTAR + TROCAR PEÇAS
// ==================================================

const quadroBranco = document.getElementById("quadroBranco");
const pecasContainer = document.getElementById("pecas");

const pecasColocadasElemento =
    document.getElementById("pecasColocadas");

const movimentosElemento =
    document.getElementById("movimentos");

const feedback =
    document.getElementById("feedback");

const resultado =
    document.getElementById("resultado");

const resultadoTexto =
    document.getElementById("resultadoTexto");

const jogarNovamente =
    document.getElementById("jogarNovamente");

const botoesImagem =
    document.querySelectorAll(".imagem-opcao");


// ==================================================
// IMAGENS
// ==================================================

const imagens = {

    cachorro:
        "../../public/css/img/quebra-cabeca/cachorros.png",

    natureza:
        "../../public/css/img/quebra-cabeca/natureza.jpg",

    carro:
        "../../public/css/img/quebra-cabeca/carro.jpg",

    arcoiris:
        "../../public/css/img/quebra-cabeca/arcoiris.jpg"

};


// ==================================================
// CONFIGURAÇÕES
// ==================================================

const LINHAS = 2;
const COLUNAS = 3;
const TOTAL_PECAS = LINHAS * COLUNAS;


// ==================================================
// ESTADO
// ==================================================

let imagemAtual = null;
let imagemSelecionada = null;

let movimentos = 0;

let pecaArrastada = null;
let copiaArrastada = null;

let origemTipo = null;
let origemIndice = null;

let arrastando = false;


// ==================================================
// ESCOLHER IMAGEM
// ==================================================

botoesImagem.forEach(function (botao) {

    botao.addEventListener("click", function () {

        const nomeImagem =
            botao.dataset.imagem;

        iniciarQuebraCabeca(nomeImagem);

    });

});


// ==================================================
// INICIAR
// ==================================================

function iniciarQuebraCabeca(nomeImagem) {

    imagemAtual = imagens[nomeImagem];

    imagemSelecionada = nomeImagem;

    movimentos = 0;

    atualizarInformacoes();

    feedback.textContent = "";

    feedback.className = "feedback";

    resultado.style.display = "none";

    marcarImagemSelecionada(nomeImagem);

    criarQuadro();

    criarPecas();

}


// ==================================================
// MARCAR IMAGEM ESCOLHIDA
// ==================================================

function marcarImagemSelecionada(nomeImagem) {

    botoesImagem.forEach(function (botao) {

        botao.classList.remove("selecionada");

    });

    const botao =
        document.querySelector(
            `[data-imagem="${nomeImagem}"]`
        );

    if (botao) {

        botao.classList.add("selecionada");

    }

}


// ==================================================
// CRIAR QUADRO
// ==================================================

function criarQuadro() {

    quadroBranco.innerHTML = "";

    for (
        let i = 0;
        i < TOTAL_PECAS;
        i++
    ) {

        const espaco =
            document.createElement("div");

        espaco.classList.add("espaco-peca");

        espaco.dataset.tipo = "quadro";
        espaco.dataset.indice = i;


        quadroBranco.appendChild(espaco);

    }

}


// ==================================================
// CRIAR PEÇAS NA PARTE DE BAIXO
// ==================================================

function criarPecas() {

    pecasContainer.innerHTML = "";

    const ordem =
        embaralhar(
            Array.from(
                { length: TOTAL_PECAS },
                (_, indice) => indice
            )
        );


    ordem.forEach(function (posicaoCorreta) {

        const peca =
            criarPeca(posicaoCorreta);

        pecasContainer.appendChild(peca);

    });

}


// ==================================================
// CRIAR PEÇA
// ==================================================

function criarPeca(posicaoCorreta) {

    const peca =
        document.createElement("div");

    peca.classList.add("peca");

    peca.dataset.posicaoCorreta =
        posicaoCorreta;

    peca.dataset.tipo = "banco";


    const imagem =
        document.createElement("img");

    imagem.src = imagemAtual;

    imagem.alt = "Peça do quebra-cabeça";


    configurarImagemDaPeca(
        imagem,
        posicaoCorreta
    );


    peca.appendChild(imagem);

    configurarArraste(peca);


    return peca;

}


// ==================================================
// CONFIGURAR RECORTE DA IMAGEM
// ==================================================

function configurarImagemDaPeca(
    imagem,
    posicao
) {

    const linha =
        Math.floor(posicao / COLUNAS);

    const coluna =
        posicao % COLUNAS;


    imagem.style.width =
        `${COLUNAS * 100}%`;

    imagem.style.height =
        `${LINHAS * 100}%`;

    imagem.style.maxWidth =
        "none";

    imagem.style.objectFit =
        "fill";


    const deslocamentoX =
        coluna * 33.333333;

    const deslocamentoY =
        linha * 50;


    imagem.style.transform =
        `translate(
            ${-deslocamentoX}%,
            ${-deslocamentoY}%
        )`;

}


// ==================================================
// CONFIGURAR ARRASTE
// ==================================================

function configurarArraste(peca) {

    peca.addEventListener(
        "pointerdown",
        iniciarArraste
    );

}


// ==================================================
// INICIAR ARRASTE
// ==================================================

function iniciarArraste(evento) {

    evento.preventDefault();

    if (arrastando) {
        return;
    }


    pecaArrastada = this;

    arrastando = true;


    // Guarda a origem da peça

    origemTipo =
        pecaArrastada.dataset.tipo;


    origemIndice =
        pecaArrastada.dataset.indice ?? null;


    // Cria cópia que acompanha o mouse/dedo

    copiaArrastada =
        pecaArrastada.cloneNode(true);


    copiaArrastada.classList.add(
        "peca-arrastando"
    );


    const largura =
        pecaArrastada.getBoundingClientRect().width;

    const altura =
        pecaArrastada.getBoundingClientRect().height;


    copiaArrastada.style.width =
        `${largura}px`;

    copiaArrastada.style.height =
        `${altura}px`;


    document.body.appendChild(
        copiaArrastada
    );


    // Esconde temporariamente a original

    pecaArrastada.style.opacity =
        "0";


    moverCopia(
        evento.clientX,
        evento.clientY
    );


    document.addEventListener(
        "pointermove",
        moverArraste
    );


    document.addEventListener(
        "pointerup",
        finalizarArraste,
        { once: true }
    );

}


// ==================================================
// MOVER
// ==================================================

function moverArraste(evento) {

    if (!arrastando) {
        return;
    }

    evento.preventDefault();

    moverCopia(
        evento.clientX,
        evento.clientY
    );

}


// ==================================================
// MOVER CÓPIA
// ==================================================

function moverCopia(x, y) {

    if (!copiaArrastada) {
        return;
    }


    copiaArrastada.style.left =
        `${x - copiaArrastada.offsetWidth / 2}px`;

    copiaArrastada.style.top =
        `${y - copiaArrastada.offsetHeight / 2}px`;

}


// ==================================================
// FINALIZAR
// ==================================================

function finalizarArraste(evento) {

    document.removeEventListener(
        "pointermove",
        moverArraste
    );


    if (!pecaArrastada) {
        limparArraste();
        return;
    }


    const destino =
        encontrarDestino(
            evento.clientX,
            evento.clientY
        );


    if (!destino) {

        restaurarOrigem();

        limparArraste();

        return;

    }


    movimentos++;

    atualizarInformacoes();


    processarMovimento(
        pecaArrastada,
        destino
    );


    limparArraste();


    verificarVitoria();

}


// ==================================================
// ENCONTRAR DESTINO
// ==================================================

function encontrarDestino(x, y) {

    const elemento =
        document.elementFromPoint(x, y);


    if (!elemento) {
        return null;
    }


    // Pode ser um espaço vazio

    const espaco =
        elemento.closest(".espaco-peca");


    if (espaco) {
        return espaco;
    }


    // Pode ser uma peça que já está no quadro

    const peca =
        elemento.closest(
            ".peca-no-quadro"
        );


    if (peca) {

        return peca.closest(
            ".espaco-peca"
        );

    }


    return null;

}


// ==================================================
// PROCESSAR MOVIMENTO
// ==================================================

function processarMovimento(
    peca,
    destino
) {

    const origem =
        descobrirOrigem(peca);


    const pecaDestino =
        destino.querySelector(
            ".peca-no-quadro"
        );


    // ==================================================
    // PEÇA VINDO DO BANCO
    // ==================================================

    if (origem.tipo === "banco") {

        // Destino vazio

        if (!pecaDestino) {

            colocarNoQuadro(
                peca,
                destino
            );

            return;

        }


        // Destino ocupado:
        // peça do quadro volta para o banco

        colocarNoBanco(
            pecaDestino
        );


        colocarNoQuadro(
            peca,
            destino
        );


        return;

    }


    // ==================================================
    // PEÇA VINDO DO QUADRO
    // ==================================================

    const origemEspaco =
        origem.elemento;


    // Se soltou no mesmo lugar

    if (
        origemEspaco === destino
    ) {

        restaurarOrigem();

        return;

    }


    // Destino vazio

    if (!pecaDestino) {

        colocarNoQuadro(
            peca,
            destino
        );


        return;

    }


    // Destino ocupado:
    // TROCA AS DUAS PEÇAS

    const pecaOrigem =
        peca;


    const destinoOriginal =
        origemEspaco;


    colocarNoQuadro(
        pecaDestino,
        destinoOriginal
    );


    colocarNoQuadro(
        pecaOrigem,
        destino
    );

}


// ==================================================
// DESCOBRIR ORIGEM
// ==================================================

function descobrirOrigem(peca) {

    const tipo =
        peca.dataset.tipo;


    if (tipo === "banco") {

        return {

            tipo: "banco",

            elemento: pecasContainer

        };

    }


    return {

        tipo: "quadro",

        elemento:
            peca.closest(
                ".espaco-peca"
            )

    };

}


// ==================================================
// COLOCAR NO QUADRO
// ==================================================

function colocarNoQuadro(
    peca,
    espaco
) {

    if (!peca || !espaco) {
        return;
    }


    // Remove da posição anterior

    if (
        peca.parentElement &&
        peca.parentElement !== espaco
    ) {

        peca.parentElement.removeChild(
            peca
        );

    }


    peca.dataset.tipo =
        "quadro";


    peca.dataset.indice =
        espaco.dataset.indice;


    peca.classList.add(
        "peca-no-quadro"
    );


    peca.classList.remove(
        "peca-arrastando"
    );


    peca.style.opacity =
        "1";


    peca.style.width =
        "100%";

    peca.style.height =
        "100%";


    espaco.appendChild(
        peca
    );

}


// ==================================================
// COLOCAR NO BANCO
// ==================================================

function colocarNoBanco(peca) {

    if (!peca) {
        return;
    }


    if (peca.parentElement) {

        peca.parentElement.removeChild(
            peca
        );

    }


    peca.dataset.tipo =
        "banco";


    delete peca.dataset.indice;


    peca.classList.remove(
        "peca-no-quadro"
    );


    peca.style.opacity =
        "1";


    peca.style.width =
        "";

    peca.style.height =
        "";


    pecasContainer.appendChild(
        peca
    );

}


// ==================================================
// RESTAURAR ORIGEM
// ==================================================

function restaurarOrigem() {

    if (!pecaArrastada) {
        return;
    }


    pecaArrastada.style.opacity =
        "1";

}


// ==================================================
// LIMPAR ARRASTE
// ==================================================

function limparArraste() {

    if (copiaArrastada) {

        copiaArrastada.remove();

    }


    if (pecaArrastada) {

        pecaArrastada.style.opacity =
            "1";

    }


    copiaArrastada = null;

    pecaArrastada = null;

    origemTipo = null;

    origemIndice = null;

    arrastando = false;

}


// ==================================================
// ATUALIZAR INFORMAÇÕES
// ==================================================

function atualizarInformacoes() {

    const pecasNoQuadro =
        quadroBranco.querySelectorAll(
            ".peca-no-quadro"
        ).length;


    pecasColocadasElemento.textContent =
        pecasNoQuadro;


    movimentosElemento.textContent =
        movimentos;

}


// ==================================================
// VERIFICAR VITÓRIA
// ==================================================

function verificarVitoria() {

    const espacos =
        quadroBranco.querySelectorAll(
            ".espaco-peca"
        );


    if (
        espacos.length !==
        TOTAL_PECAS
    ) {

        return;

    }


    const correto =
        Array.from(
            espacos
        ).every(function (espaco) {

            const peca =
                espaco.querySelector(
                    ".peca-no-quadro"
                );


            if (!peca) {
                return false;
            }


            const posicaoCorreta =
                Number(
                    peca.dataset.posicaoCorreta
                );


            const posicaoAtual =
                Number(
                    espaco.dataset.indice
                );


            return (
                posicaoCorreta ===
                posicaoAtual
            );

        });


    if (!correto) {
        return;
    }


    feedback.textContent =
        "🎉 Você montou o quebra-cabeça!";

    feedback.className =
        "feedback sucesso";


    setTimeout(function () {

        resultado.style.display =
            "block";


        resultadoTexto.textContent =
            `Você completou o quebra-cabeça em ${movimentos} movimentos.`;

    }, 400);

}


// ==================================================
// JOGAR NOVAMENTE
// ==================================================

jogarNovamente.addEventListener(
    "click",
    function () {

        if (imagemSelecionada) {

            iniciarQuebraCabeca(
                imagemSelecionada
            );

        }

    }
);


// ==================================================
// EMBARALHAR
// ==================================================

function embaralhar(array) {

    return [...array].sort(
        () => Math.random() - 0.5
    );

}