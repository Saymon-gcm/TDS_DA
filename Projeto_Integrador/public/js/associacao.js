// ==================================================
// JOGO DE ASSOCIAÇÃO DE IMAGENS
// ==================================================


// IMAGENS DOS PARES
// Coloque aqui o caminho das imagens que você criou.

const imagens = [

    {
        id: 1,
        imagem: "../../public/css/img/associacao/maca.png"
    },

    {
        id: 2,
        imagem: "../../public/css/img/associacao/cachorro.png"
    },

    {
        id: 3,
        imagem: "../../public/css/img/associacao/carro.png"
    },

    {
        id: 4,
        imagem: "../../public/css/img/associacao/bola.png"
    },

    {
        id: 5,
        imagem: "../../public/css/img/associacao/casa.png"
    },

    {
        id: 6,
        imagem: "../../public/css/img/associacao/arvore.png"
    }

];


// ELEMENTOS DO HTML

const tabuleiro = document.getElementById("tabuleiro");

const tentativasElemento =
    document.getElementById("tentativas");

const paresElemento =
    document.getElementById("paresEncontrados");

const mensagemVitoria =
    document.getElementById("mensagemVitoria");

const jogarNovamente =
    document.getElementById("jogarNovamente");


// VARIÁVEIS DO JOGO

let primeiraCarta = null;

let segundaCarta = null;

let bloqueado = false;

let tentativas = 0;

let paresEncontrados = 0;


// ==================================================
// EMBARALHAR
// ==================================================

function embaralhar(array) {

    return array.sort(() => Math.random() - 0.5);

}


// ==================================================
// CRIAR TABULEIRO
// ==================================================

function iniciarJogo() {

    tabuleiro.innerHTML = "";

    primeiraCarta = null;

    segundaCarta = null;

    bloqueado = false;

    tentativas = 0;

    paresEncontrados = 0;

    tentativasElemento.textContent = tentativas;

    paresElemento.textContent = paresEncontrados;

    mensagemVitoria.classList.remove("mostrar");


    // DUPLICA AS IMAGENS
    const cartas = [
        ...imagens,
        ...imagens
    ];


    // EMBARALHA
    embaralhar(cartas);


    // CRIA AS CARTAS

    cartas.forEach((item) => {

        const carta = document.createElement("button");

        carta.classList.add("carta");

        carta.dataset.id = item.id;


        const imagem = document.createElement("img");

        imagem.src = item.imagem;

        imagem.alt = "Imagem da atividade";


        carta.appendChild(imagem);


        carta.addEventListener(
            "click",
            selecionarCarta
        );


        tabuleiro.appendChild(carta);

    });

}


// ==================================================
// SELECIONAR CARTA
// ==================================================

function selecionarCarta() {

    if (bloqueado) {
        return;
    }


    if (this === primeiraCarta) {
        return;
    }


    if (this.classList.contains("encontrada")) {
        return;
    }


    this.classList.add("selecionada");


    if (!primeiraCarta) {

        primeiraCarta = this;

        return;
    }


    segundaCarta = this;

    bloqueado = true;

    tentativas++;

    tentativasElemento.textContent = tentativas;


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

        primeiraCarta.classList.remove(
            "selecionada"
        );

        segundaCarta.classList.remove(
            "selecionada"
        );


        primeiraCarta.classList.add(
            "encontrada"
        );

        segundaCarta.classList.add(
            "encontrada"
        );


        paresEncontrados++;

        paresElemento.textContent =
            paresEncontrados;


        resetarEscolha();


        verificarVitoria();

    } else {

        setTimeout(() => {

            primeiraCarta.classList.remove(
                "selecionada"
            );

            segundaCarta.classList.remove(
                "selecionada"
            );


            resetarEscolha();

        }, 800);

    }

}


// ==================================================
// RESETAR ESCOLHA
// ==================================================

function resetarEscolha() {

    primeiraCarta = null;

    segundaCarta = null;

    bloqueado = false;

}


// ==================================================
// VERIFICAR VITÓRIA
// ==================================================

function verificarVitoria() {

    if (paresEncontrados === imagens.length) {

        setTimeout(() => {

            mensagemVitoria.classList.add(
                "mostrar"
            );

        }, 400);

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