// ==================================================
// JOGO DE ATENÇÃO VISUAL
// ==================================================

const areaElementos =
    document.getElementById("areaElementos");

const alvo =
    document.getElementById("alvo");

const rodadaElemento =
    document.getElementById("rodada");

const acertosElemento =
    document.getElementById("acertos");

const feedback =
    document.getElementById("feedback");

const botaoProxima =
    document.getElementById("proxima");

const resultado =
    document.getElementById("resultado");

const resultadoTexto =
    document.getElementById("resultadoTexto");

const jogarNovamente =
    document.getElementById("jogarNovamente");


// ==================================================
// CONFIGURAÇÕES
// ==================================================

const TOTAL_RODADAS = 10;

let rodadaAtual = 1;

let acertos = 0;

let rodadaRespondida = false;


// ==================================================
// ELEMENTOS DISPONÍVEIS
// ==================================================

const elementos = [

    "🔴",
    "🔵",
    "🟢",
    "🟡",
    "🟣",
    "🟠",
    "⭐",
    "❤️",
    "🔺",
    "⬛",
    "⬜",
    "🔶"

];


// ==================================================
// EMBARALHAR
// ==================================================

function embaralhar(array) {

    return [...array].sort(
        () => Math.random() - 0.5
    );

}


// ==================================================
// ESCOLHER ALVO
// ==================================================

function escolherAlvo() {

    const indice =
        Math.floor(
            Math.random() * elementos.length
        );

    return elementos[indice];

}


// ==================================================
// DEFINIR QUANTIDADE
// ==================================================

function quantidadeElementos() {

    if (rodadaAtual <= 3) {

        return 12;

    }


    if (rodadaAtual <= 6) {

        return 16;

    }


    return 20;

}


// ==================================================
// CRIAR RODADA
// ==================================================

function iniciarRodada() {

    rodadaRespondida = false;

    feedback.textContent = "";

    feedback.className = "feedback";

    botaoProxima.style.display = "none";


    rodadaElemento.textContent =
        rodadaAtual;

    acertosElemento.textContent =
        acertos;


    const alvoAtual =
        escolherAlvo();


    alvo.textContent =
        alvoAtual;


    criarElementos(
        alvoAtual
    );

}


// ==================================================
// CRIAR ELEMENTOS
// ==================================================

function criarElementos(
    alvoAtual
) {

    areaElementos.innerHTML = "";


    const quantidade =
        quantidadeElementos();


    const lista = [];


    /*
       Coloca o alvo pelo menos uma vez.
    */

    lista.push(
        alvoAtual
    );


    /*
       Preenche o restante.
    */

    while (
        lista.length <
        quantidade
    ) {

        const elemento =
            elementos[
                Math.floor(
                    Math.random() *
                    elementos.length
                )
            ];


        lista.push(
            elemento
        );

    }


    const listaEmbaralhada =
        embaralhar(lista);


    listaEmbaralhada.forEach(
        function (elemento) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "elemento-atencao"
            );


            botao.textContent =
                elemento;


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        elemento,
                        botao,
                        alvoAtual
                    );

                }
            );


            areaElementos.appendChild(
                botao
            );

        }
    );

}


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    elemento,
    botao,
    alvoAtual
) {

    if (rodadaRespondida) {

        return;

    }


    if (
        elemento ===
        alvoAtual
    ) {

        rodadaRespondida = true;

        acertos++;


        acertosElemento.textContent =
            acertos;


        botao.classList.add(
            "correto"
        );


        feedback.textContent =
            "🎉 Muito bem!";


        feedback.classList.add(
            "acerto"
        );


        document
            .querySelectorAll(
                ".elemento-atencao"
            )
            .forEach(
                function (item) {

                    item.disabled = true;

                }
            );


        if (
            rodadaAtual <
            TOTAL_RODADAS
        ) {

            botaoProxima.style.display =
                "inline-block";

        } else {

            finalizarJogo();

        }


    } else {

        botao.classList.add(
            "errado"
        );


        feedback.textContent =
            "Não é esse. Procure novamente.";

        feedback.classList.add(
            "erro"
        );


        setTimeout(
            function () {

                botao.classList.remove(
                    "errado"
                );

            },
            500
        );

    }

}


// ==================================================
// PRÓXIMA RODADA
// ==================================================

botaoProxima.addEventListener(
    "click",
    function () {

        rodadaAtual++;

        iniciarRodada();

    }
);


// ==================================================
// FINALIZAR
// ==================================================

function finalizarJogo() {

    setTimeout(
        function () {

            areaElementos.innerHTML = "";

            alvo.textContent = "🎉";

            feedback.textContent = "";

            botaoProxima.style.display =
                "none";


            resultado.style.display =
                "block";


            resultadoTexto.textContent =
                `Você acertou ${acertos} de ${TOTAL_RODADAS} rodadas.`;

        },
        700
    );

}


// ==================================================
// JOGAR NOVAMENTE
// ==================================================

jogarNovamente.addEventListener(
    "click",
    function () {

        rodadaAtual = 1;

        acertos = 0;


        resultado.style.display =
            "none";


        iniciarRodada();

    }
);


// ==================================================
// INICIAR
// ==================================================

iniciarRodada();