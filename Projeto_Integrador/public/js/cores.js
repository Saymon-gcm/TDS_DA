// ==================================================
// JOGO DAS CORES
// ==================================================

const corAlvo =
    document.getElementById("corAlvo");

const nomeCor =
    document.getElementById("nomeCor");

const opcoesCores =
    document.getElementById("opcoesCores");

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


// ==================================================
// CORES
// ==================================================

const cores = [

    {
        nome: "Vermelho",
        valor: "#EF4444"
    },

    {
        nome: "Azul",
        valor: "#2563EB"
    },

    {
        nome: "Amarelo",
        valor: "#FACC15"
    },

    {
        nome: "Verde",
        valor: "#22C55E"
    },

    {
        nome: "Laranja",
        valor: "#F97316"
    },

    {
        nome: "Roxo",
        valor: "#A855F7"
    },

    {
        nome: "Rosa",
        valor: "#EC4899"
    },

    {
        nome: "Ciano",
        valor: "#06B6D4"
    }

];


let rodadaAtual = 1;

let acertos = 0;

let corAtual = null;

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
// ESCOLHER COR
// ==================================================

function escolherCor() {

    const indice =
        Math.floor(
            Math.random() * cores.length
        );

    return cores[indice];

}


// ==================================================
// CRIAR OPÇÕES
// ==================================================

function criarOpcoes() {

    opcoesCores.innerHTML = "";

    const opcoes = [
        corAtual
    ];


    while (opcoes.length < 3) {

        const novaCor =
            escolherCor();

        if (
            !opcoes.some(
                cor =>
                    cor.nome === novaCor.nome
            )
        ) {

            opcoes.push(novaCor);

        }

    }


    const opcoesEmbaralhadas =
        embaralhar(opcoes);


    opcoesEmbaralhadas.forEach(
        function (cor) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "cor-opcao"
            );


            botao.style.backgroundColor =
                cor.valor;


            botao.dataset.cor =
                cor.nome;


            botao.setAttribute(
                "aria-label",
                cor.nome
            );


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        cor,
                        botao
                    );

                }
            );


            opcoesCores.appendChild(
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


    corAtual =
        escolherCor();


    corAlvo.style.backgroundColor =
        corAtual.valor;


    nomeCor.textContent =
        corAtual.nome;


    criarOpcoes();

}


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    corEscolhida,
    botaoClicado
) {

    if (rodadaRespondida) {
        return;
    }


    const botoes =
        document.querySelectorAll(
            ".cor-opcao"
        );


    if (
        corEscolhida.nome ===
        corAtual.nome
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
// FINALIZAR
// ==================================================

function finalizarJogo() {

    setTimeout(
        function () {

            opcoesCores.innerHTML = "";

            corAlvo.style.backgroundColor =
                "#FFFFFF";

            nomeCor.textContent =
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
// INICIAR JOGO
// ==================================================

iniciarRodada();