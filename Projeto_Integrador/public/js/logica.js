// ==================================================
// JOGO DE LÓGICA
// ==================================================

const perguntaTexto =
    document.getElementById("perguntaTexto");

const grupoObjetos =
    document.getElementById("grupoObjetos");

const opcoesLogica =
    document.getElementById("opcoesLogica");

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

let respostaAtual = "";

let rodadaRespondida = false;


// ==================================================
// DESAFIOS
// ==================================================

const desafios = [

    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🍎",
            "🍎",
            "🍎",
            "🍌",
            "🍎"
        ],

        resposta: "🍌",

        opcoes: [
            "🍌",
            "🍎",
            "🍊"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🐶",
            "🐶",
            "🐱",
            "🐶",
            "🐶"
        ],

        resposta: "🐱",

        opcoes: [
            "🐱",
            "🐶",
            "🐰"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🚗",
            "🚗",
            "🚗",
            "🚲",
            "🚗"
        ],

        resposta: "🚲",

        opcoes: [
            "🚲",
            "🚗",
            "🚌"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "⭐",
            "⭐",
            "⭐",
            "❤️",
            "⭐"
        ],

        resposta: "❤️",

        opcoes: [
            "❤️",
            "⭐",
            "🔵"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🍐",
            "🍐",
            "🍐",
            "🍉",
            "🍐"
        ],

        resposta: "🍉",

        opcoes: [
            "🍉",
            "🍐",
            "🍓"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🐟",
            "🐟",
            "🐟",
            "🐦",
            "🐟"
        ],

        resposta: "🐦",

        opcoes: [
            "🐦",
            "🐟",
            "🐢"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🔵",
            "🔵",
            "🔴",
            "🔵",
            "🔵"
        ],

        resposta: "🔴",

        opcoes: [
            "🔴",
            "🔵",
            "🟢"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🌳",
            "🌳",
            "🌳",
            "🌻",
            "🌳"
        ],

        resposta: "🌻",

        opcoes: [
            "🌻",
            "🌳",
            "🌷"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "⚽",
            "⚽",
            "🏀",
            "⚽",
            "⚽"
        ],

        resposta: "🏀",

        opcoes: [
            "🏀",
            "⚽",
            "🎾"
        ]
    },


    {
        pergunta: "Qual objeto não pertence ao grupo?",

        grupo: [
            "🟢",
            "🟢",
            "🟢",
            "🟡",
            "🟢"
        ],

        resposta: "🟡",

        opcoes: [
            "🟡",
            "🟢",
            "🔵"
        ]
    }

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
// INICIAR RODADA
// ==================================================

function iniciarRodada() {

    rodadaRespondida = false;

    feedback.textContent = "";

    feedback.className = "feedback";

    botaoProxima.style.display =
        "none";


    rodadaElemento.textContent =
        rodadaAtual;


    acertosElemento.textContent =
        acertos;


    const desafio =
        desafios[rodadaAtual - 1];


    perguntaTexto.textContent =
        desafio.pergunta;


    respostaAtual =
        desafio.resposta;


    mostrarGrupo(
        desafio.grupo
    );


    mostrarOpcoes(
        desafio.opcoes
    );

}


// ==================================================
// MOSTRAR GRUPO
// ==================================================

function mostrarGrupo(
    grupo
) {

    grupoObjetos.innerHTML = "";


    grupo.forEach(
        function (item) {

            const elemento =
                document.createElement("div");


            elemento.classList.add(
                "objeto-logica"
            );


            elemento.textContent =
                item;


            grupoObjetos.appendChild(
                elemento
            );

        }
    );

}


// ==================================================
// MOSTRAR OPÇÕES
// ==================================================

function mostrarOpcoes(
    opcoes
) {

    opcoesLogica.innerHTML = "";


    const opcoesEmbaralhadas =
        embaralhar(opcoes);


    opcoesEmbaralhadas.forEach(
        function (opcao) {

            const botao =
                document.createElement("button");


            botao.type = "button";


            botao.classList.add(
                "opcao-logica"
            );


            botao.textContent =
                opcao;


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        opcao,
                        botao
                    );

                }
            );


            opcoesLogica.appendChild(
                botao
            );

        }
    );

}


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    resposta,
    botaoClicado
) {

    if (rodadaRespondida) {

        return;

    }


    const botoes =
        document.querySelectorAll(
            ".opcao-logica"
        );


    if (
        resposta ===
        respostaAtual
    ) {

        rodadaRespondida = true;

        acertos++;


        acertosElemento.textContent =
            acertos;


        botaoClicado.classList.add(
            "correta"
        );


        feedback.textContent =
            "🎉 Muito bem!";


        feedback.classList.add(
            "acerto"
        );


        botoes.forEach(
            function (botao) {

                botao.disabled = true;

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

        botaoClicado.classList.add(
            "errada"
        );


        feedback.textContent =
            "Tente novamente!";


        feedback.classList.add(
            "erro"
        );


        setTimeout(
            function () {

                botaoClicado.classList.remove(
                    "errada"
                );

            },
            600
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

            grupoObjetos.innerHTML = "";

            opcoesLogica.innerHTML = "";

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
// INICIAR JOGO
// ==================================================

iniciarRodada();