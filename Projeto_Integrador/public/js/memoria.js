// ==================================================
// JOGO DA MEMÓRIA
// ==================================================

const tabuleiro =
    document.getElementById("tabuleiro");

const tentativasElemento =
    document.getElementById("tentativas");

const paresElemento =
    document.getElementById("pares");

const resultado =
    document.getElementById("resultado");

const resultadoTexto =
    document.getElementById("resultadoTexto");

const jogarNovamente =
    document.getElementById("jogarNovamente");


// ==================================================
// CONFIGURAÇÕES
// ==================================================

const imagens = [

    {
        id: 1,
        imagem: "../../public/css/img/memoria/gato.png"
    },

    {
        id: 2,
        imagem: "../../public/css/img/memoria/ovelha.png"
    },

    {
        id: 3,
        imagem: "../../public/css/img/memoria/laranja.png"
    },

    {
        id: 4,
        imagem: "../../public/css/img/memoria/bicicleta.png"
    },

    {
        id: 5,
        imagem: "../../public/css/img/memoria/cubo.png"
    },

    {
        id: 6,
        imagem: "../../public/css/img/memoria/peixe.png"
    }

];


let primeiraCarta = null;

let segundaCarta = null;

let bloqueado = false;

let tentativas = 0;

let paresEncontrados = 0;


// ==================================================
// EMBARALHAR
// ==================================================

function embaralhar(array) {

    return [...array].sort(
        () => Math.random() - 0.5
    );

}


// ==================================================
// INICIAR JOGO
// ==================================================

function iniciarJogo() {

    tabuleiro.innerHTML = "";

    primeiraCarta = null;

    segundaCarta = null;

    bloqueado = false;

    tentativas = 0;

    paresEncontrados = 0;


    tentativasElemento.textContent =
        tentativas;

    paresElemento.textContent =
        paresEncontrados;


    resultado.style.display =
        "none";


    // DUPLICAR OS PARES

    const cartas = [

        ...imagens,

        ...imagens

    ];


    // EMBARALHAR

    const cartasEmbaralhadas =
        embaralhar(cartas);


    // CRIAR CARTAS

    cartasEmbaralhadas.forEach(
        function (item) {

            const carta =
                document.createElement("button");


            carta.type = "button";

            carta.classList.add(
                "carta-memoria"
            );


            carta.dataset.id =
                item.id;


            // FRENTE

            const frente =
                document.createElement("div");

            frente.classList.add(
                "carta-frente"
            );


            const imagem =
                document.createElement("img");

            imagem.src =
                item.imagem;

            imagem.alt =
                "Imagem do jogo";


            frente.appendChild(
                imagem
            );


            // VERSO

            const verso =
                document.createElement("div");

            verso.classList.add(
                "carta-verso"
            );


            verso.textContent =
                "🧩";


            carta.appendChild(frente);

            carta.appendChild(verso);


            carta.addEventListener(
                "click",
                function () {

                    selecionarCarta(carta);

                }
            );


            tabuleiro.appendChild(
                carta
            );

        }
    );

}


// ==================================================
// SELECIONAR CARTA
// ==================================================

function selecionarCarta(carta) {

    if (bloqueado) {

        return;

    }


    if (
        carta === primeiraCarta
    ) {

        return;

    }


    if (
        carta.classList.contains(
            "encontrada"
        )
    ) {

        return;

    }


    carta.classList.add(
        "aberta"
    );


    if (!primeiraCarta) {

        primeiraCarta =
            carta;

        return;

    }


    segundaCarta =
        carta;


    bloqueado =
        true;


    tentativas++;


    tentativasElemento.textContent =
        tentativas;


    verificarPar();

}


// ==================================================
// VERIFICAR PAR
// ==================================================

function verificarPar() {

    const mesmoPar =
        primeiraCarta.dataset.id ===
        segundaCarta.dataset.id;


    if (mesmoPar) {

        primeiraCarta.classList.add(
            "encontrada"
        );


        segundaCarta.classList.add(
            "encontrada"
        );


        paresEncontrados++;


        paresElemento.textContent =
            paresEncontrados;


        limparSelecao();


        verificarFim();


    } else {

        setTimeout(
            function () {

                primeiraCarta.classList.remove(
                    "aberta"
                );


                segundaCarta.classList.remove(
                    "aberta"
                );


                limparSelecao();

            },
            900
        );

    }

}


// ==================================================
// LIMPAR SELEÇÃO
// ==================================================

function limparSelecao() {

    primeiraCarta = null;

    segundaCarta = null;

    bloqueado = false;

}


// ==================================================
// VERIFICAR FIM
// ==================================================

function verificarFim() {

    if (
        paresEncontrados ===
        imagens.length
    ) {

        setTimeout(
            function () {

                resultado.style.display =
                    "block";


                resultadoTexto.textContent =
                    `Você encontrou todos os ${imagens.length} pares em ${tentativas} tentativas.`;

            },
            500
        );

    }

}


// ==================================================
// JOGAR NOVAMENTE
// ==================================================

jogarNovamente.addEventListener(
    "click",
    iniciarJogo
);


// ==================================================
// INICIAR
// ==================================================

iniciarJogo();