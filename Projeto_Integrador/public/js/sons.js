// ==================================================
// JOGO DOS SONS
// ==================================================

const botaoSom =
    document.getElementById("tocarSom");

const opcoesSons =
    document.getElementById("opcoesSons");

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
// SONS
// ==================================================

const sons = [

    {
        id: 1,
        nome: "Cachorro",
        icone: "🐶",
        arquivo:
            "../../public/sounds/cachorro.mp3"
    },

    {
        id: 2,
        nome: "Gato",
        icone: "🐱",
        arquivo:
            "../../public/sounds/gato.mp3"
    },

    {
        id: 3,
        nome: "Vaca",
        icone: "🐮",
        arquivo:
            "../../public/sounds/vaca.mp3"
    },

    {
        id: 4,
        nome: "Pássaro",
        icone: "🐦",
        arquivo:
            "../../public/sounds/passaro.mp3"
    },

    {
        id: 5,
        nome: "Carro",
        icone: "🚗",
        arquivo:
            "../../public/sounds/carro.mp3"
    },

    {
        id: 6,
        nome: "Trem",
        icone: "🚂",
        arquivo:
            "../../public/sounds/trem.mp3"
    }

];


let rodadaAtual = 1;

let acertos = 0;

let somAtual = null;

let audioAtual = null;

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
// ESCOLHER SOM
// ==================================================

function escolherSom() {

    const indice =
        Math.floor(
            Math.random() *
            sons.length
        );

    return sons[indice];

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


    somAtual =
        escolherSom();


    criarOpcoes();


    // Toca automaticamente ao iniciar

    tocarSom();

}


// ==================================================
// CRIAR OPÇÕES
// ==================================================

function criarOpcoes() {

    opcoesSons.innerHTML = "";


    const opcoes = [
        somAtual
    ];


    while (opcoes.length < 3) {

        const novoSom =
            escolherSom();


        if (
            !opcoes.some(
                som =>
                    som.id === novoSom.id
            )
        ) {

            opcoes.push(novoSom);

        }

    }


    const opcoesEmbaralhadas =
        embaralhar(opcoes);


    opcoesEmbaralhadas.forEach(
        function (som) {

            const botao =
                document.createElement("button");


            botao.type = "button";

            botao.classList.add(
                "som-opcao"
            );


            const icone =
                document.createElement("span");

            icone.classList.add(
                "icone-som"
            );

            icone.textContent =
                som.icone;


            const nome =
                document.createElement("span");

            nome.classList.add(
                "nome-som"
            );

            nome.textContent =
                som.nome;


            botao.appendChild(
                icone
            );

            botao.appendChild(
                nome
            );


            botao.addEventListener(
                "click",
                function () {

                    verificarResposta(
                        som,
                        botao
                    );

                }
            );


            opcoesSons.appendChild(
                botao
            );

        }
    );

}


// ==================================================
// TOCAR SOM
// ==================================================

function tocarSom() {

    if (!somAtual) {
        return;
    }


    if (audioAtual) {

        audioAtual.pause();

        audioAtual.currentTime = 0;

    }


    audioAtual =
        new Audio(
            somAtual.arquivo
        );


    audioAtual.play()
        .catch(
            function (erro) {

                console.log(
                    "Não foi possível tocar o áudio.",
                    erro
                );

            }
        );

}


// ==================================================
// BOTÃO OUVIR NOVAMENTE
// ==================================================

botaoSom.addEventListener(
    "click",
    tocarSom
);


// ==================================================
// VERIFICAR RESPOSTA
// ==================================================

function verificarResposta(
    somEscolhido,
    botaoClicado
) {

    if (rodadaRespondida) {
        return;
    }


    const botoes =
        document.querySelectorAll(
            ".som-opcao"
        );


    if (
        somEscolhido.id ===
        somAtual.id
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

            opcoesSons.innerHTML = "";

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