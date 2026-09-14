// ==================================================
// JOGO DA SEQUÊNCIA
// ==================================================

const sequenciaElemento =
    document.getElementById("sequencia");

const opcoesSequencia =
    document.getElementById("opcoesSequencia");

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

let respostaAtual = null;

let rodadaRespondida = false;


// ==================================================
// TIPOS DE SEQUÊNCIA
// ==================================================

const tiposSequencia = [

    "simbolos",

    "cores",

    "numeros"

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
// SEQUÊNCIA DE SÍMBOLOS
// ==================================================

const simbolos = [
    "⭐",
    "❤️",
    "🔵",
    "🟢",
    "🟡",
    "🔺"
];


// ==================================================
// SEQUÊNCIA DE CORES
// ==================================================

const cores = [

    {
        valor: "🔴",
        nome: "Vermelho"
    },

    {
        valor: "🔵",
        nome: "Azul"
    },

    {
        valor: "🟢",
        nome: "Verde"
    },

    {
        valor: "🟡",
        nome: "Amarelo"
    }

];


// ==================================================
// CRIAR SEQUÊNCIA DE SÍMBOLOS
// ==================================================

function criarSequenciaSimbolos() {

    const primeiro =
        simbolos[
            Math.floor(
                Math.random() * simbolos.length
            )
        ];


    let segundo =
        simbolos[
            Math.floor(
                Math.random() * simbolos.length
            )
        ];


    while (segundo === primeiro) {

        segundo =
            simbolos[
                Math.floor(
                    Math.random() * simbolos.length
                )
            ];

    }


    const terceiro =
        primeiro;


    const quarto =
        segundo;


    const resposta =
        primeiro;


    return {

        visiveis: [
            primeiro,
            segundo,
            terceiro,
            quarto
        ],

        resposta: resposta

    };

}


// ==================================================
// CRIAR SEQUÊNCIA DE CORES
// ==================================================

function criarSequenciaCores() {

    const primeira =
        Math.floor(
            Math.random() * cores.length
        );


    let segunda =
        Math.floor(
            Math.random() * cores.length
        );


    while (segunda === primeira) {

        segunda =
            Math.floor(
                Math.random() * cores.length
            );

    }


    return {

        visiveis: [

            cores[primeira].valor,

            cores[segunda].valor,

            cores[primeira].valor,

            cores[segunda].valor

        ],

        resposta:
            cores[primeira].valor

    };

}


// ==================================================
// CRIAR SEQUÊNCIA DE NÚMEROS
// ==================================================

function criarSequenciaNumeros() {

    const inicio =
        Math.floor(
            Math.random() * 4
        ) + 1;


    const diferenca =
        Math.floor(
            Math.random() * 3
        ) + 1;


    const numeros = [

        inicio,

        inicio + diferenca,

        inicio + diferenca * 2,

        inicio + diferenca * 3

    ];


    const resposta =
        inicio + diferenca * 4;


    return {

        visiveis:
            numeros,

        resposta:
            resposta

    };

}


// ==================================================
// CRIAR RODADA
// ==================================================

function criarRodada() {

    const tipo =
        tiposSequencia[
            Math.floor(
                Math.random() *
                tiposSequencia.length
            )
        ];


    if (tipo === "simbolos") {

        return criarSequenciaSimbolos();

    }


    if (tipo === "cores") {

        return criarSequenciaCores();

    }


    return criarSequenciaNumeros();

}


// ==================================================
// MOSTRAR SEQUÊNCIA
// ==================================================

function mostrarSequencia(rodada) {

    sequenciaElemento.innerHTML = "";


    rodada.visiveis.forEach(
        function (item) {

            const bloco =
                document.createElement("div");

            bloco.classList.add(
                "item-sequencia"
            );


            bloco.textContent =
                item;


            sequenciaElemento.appendChild(
                bloco
            );

        }
    );


    // Espaço final

    const faltando =
        document.createElement("div");

    faltando.classList.add(
        "item-sequencia",
        "faltando"
    );


    faltando.textContent =
        "?";


    sequenciaElemento.appendChild(
        faltando
    );

}


// ==================================================
// CRIAR OPÇÕES
// ==================================================

function criarOpcoes(resposta) {

    opcoesSequencia.innerHTML = "";


    const opcoes = [
        resposta
    ];


    // Criar duas alternativas

    while (opcoes.length < 3) {

        let alternativa;


        if (
            typeof resposta ===
            "number"
        ) {

            alternativa =
                resposta +
                (
                    Math.floor(
                        Math.random() * 5
                    ) + 1
                ) *
                (
                    Math.random() >
                    0.5
                        ? 1
                        : -1
                );

        } else {

            const tipoAlternativas = [
                "⭐",
                "❤️",
                "🔵",
                "🟢",
                "🟡",
                "🔺"
            ];


            alternativa =
                tipoAlternativas[
                    Math.floor(
                        Math.random() *
                        tipoAlternativas.length
                    )
                ];

        }


        if (
            !opcoes.includes(
                alternativa
            )
        ) {

            opcoes.push(
                alternativa
            );

        }

    }


    const embaralhadas =
        embaralhar(opcoes);


    embaralhadas.forEach(
        function (opcao) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "opcao-sequencia"
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


            opcoesSequencia.appendChild(
                botao
            );

        }
    );

}


// ==================================================
// INICIAR RODADA
// ==================================================

function iniciarRodada() {

    rodadaRespondida = false;

    feedback.textContent = "";

    feedback.className =
        "feedback";


    botaoProxima.style.display =
        "none";


    rodadaElemento.textContent =
        rodadaAtual;


    acertosElemento.textContent =
        acertos;


    const rodada =
        criarRodada();


    respostaAtual =
        rodada.resposta;


    mostrarSequencia(
        rodada
    );


    criarOpcoes(
        respostaAtual
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
            ".opcao-sequencia"
        );


    if (
        String(resposta) ===
        String(respostaAtual)
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
            700
        );

    }

}


// ==================================================
// PRÓXIMA
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

            opcoesSequencia.innerHTML = "";

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