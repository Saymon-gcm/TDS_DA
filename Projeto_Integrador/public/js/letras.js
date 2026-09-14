// ==================================================
// JOGO DAS LETRAS
// ==================================================

const letraAlvo =
    document.getElementById("letraAlvo");

const opcoesLetras =
    document.getElementById("opcoesLetras");

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

const letrasDisponiveis = [
    "A",
    "B",
    "C",
    "D",
    "E",
    "F",
    "G",
    "H",
    "I",
    "J"
];


let rodadaAtual = 1;

let acertos = 0;

let respostaAtual = "";

let rodadaRespondida = false;


// ==================================================
// EMBARALHAR
// ==================================================

function embaralhar(array) {

    return [...array].sort(
        () => Math.random() - 0.5
    );

}


// ==================================================
// ESCOLHER LETRA
// ==================================================

function escolherLetra() {

    const indice =
        Math.floor(
            Math.random() *
            letrasDisponiveis.length
        );

    return letrasDisponiveis[indice];

}


// ==================================================
// CRIAR OPÇÕES
// ==================================================

function criarOpcoes() {

    opcoesLetras.innerHTML = "";

    const letras = [
        respostaAtual
    ];


    while (letras.length < 3) {

        const novaLetra =
            escolherLetra();

        if (!letras.includes(novaLetra)) {

            letras.push(novaLetra);

        }

    }


    const letrasEmbaralhadas =
        embaralhar(letras);


    letrasEmbaralhadas.forEach(
        function (letra) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "letra-opcao"
            );

            botao.textContent = letra;


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        letra,
                        botao
                    );

                }
            );


            opcoesLetras.appendChild(
                botao
            );

        }
    );

}


// ==================================================
// NOVA RODADA
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


    respostaAtual =
        escolherLetra();


    letraAlvo.textContent =
        respostaAtual;


    criarOpcoes();

}


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    letra,
    botaoClicado
) {

    if (rodadaRespondida) {

        return;

    }


    const botoes =
        document.querySelectorAll(
            ".letra-opcao"
        );


    if (letra === respostaAtual) {

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


        if (rodadaAtual < TOTAL_RODADAS) {

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
// FINALIZAR JOGO
// ==================================================

function finalizarJogo() {

    setTimeout(
        function () {

            opcoesLetras.innerHTML = "";

            letraAlvo.textContent =
                "🎉";


            feedback.textContent = "";


            botaoProxima.style.display =
                "none";


            resultado.style.display =
                "block";


            resultadoTexto.textContent =
                `Você acertou ${acertos} de ${TOTAL_RODADAS} de rodadas.`;

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