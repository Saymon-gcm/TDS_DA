// ==================================================
// JOGO DAS EMOÇÕES
// ==================================================

const emocaoAlvo =
    document.getElementById("emocaoAlvo");

const nomeEmocao =
    document.getElementById("nomeEmocao");

const opcoesEmocoes =
    document.getElementById("opcoesEmocoes");

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


const emocoes = [

    {
        nome: "Feliz",
        icone: "😊"
    },

    {
        nome: "Triste",
        icone: "😢"
    },

    {
        nome: "Irritado",
        icone: "😡"
    },

    {
        nome: "Assustado",
        icone: "😨"
    },

    {
        nome: "Surpreso",
        icone: "😲"
    },

    {
        nome: "Cansado",
        icone: "😴"
    }

];


let rodadaAtual = 1;

let acertos = 0;

let emocaoAtual = null;

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
// ESCOLHER EMOÇÃO
// ==================================================

function escolherEmocao() {

    const indice =
        Math.floor(
            Math.random() * emocoes.length
        );

    return emocoes[indice];

}


// ==================================================
// CRIAR OPÇÕES
// ==================================================

function criarOpcoes() {

    opcoesEmocoes.innerHTML = "";


    const opcoes = [
        emocaoAtual
    ];


    while (opcoes.length < 3) {

        const novaEmocao =
            escolherEmocao();


        if (
            !opcoes.some(
                emocao =>
                    emocao.nome === novaEmocao.nome
            )
        ) {

            opcoes.push(novaEmocao);

        }

    }


    const opcoesEmbaralhadas =
        embaralhar(opcoes);


    opcoesEmbaralhadas.forEach(
        function (emocao) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "emocao-opcao"
            );


            const icone =
                document.createElement("span");

            icone.classList.add(
                "icone-emocao"
            );

            icone.textContent =
                emocao.icone;


            const texto =
                document.createElement("span");

            texto.classList.add(
                "texto-emocao"
            );

            texto.textContent =
                emocao.nome;


            botao.appendChild(icone);

            botao.appendChild(texto);


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        emocao,
                        botao
                    );

                }
            );


            opcoesEmocoes.appendChild(
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


    emocaoAtual =
        escolherEmocao();


    emocaoAlvo.textContent =
        emocaoAtual.icone;


    nomeEmocao.textContent =
        emocaoAtual.nome;


    criarOpcoes();

}


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    emocaoEscolhida,
    botaoClicado
) {

    if (rodadaRespondida) {

        return;

    }


    const botoes =
        document.querySelectorAll(
            ".emocao-opcao"
        );


    if (
        emocaoEscolhida.nome ===
        emocaoAtual.nome
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

            opcoesEmocoes.innerHTML = "";

            emocaoAlvo.textContent =
                "🎉";

            nomeEmocao.textContent =
                "Fim do jogo";


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