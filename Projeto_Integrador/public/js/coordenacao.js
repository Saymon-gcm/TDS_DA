// ==================================================
// JOGO DE COORDENAÇÃO MOTORA
// ==================================================

const areaJogo = document.getElementById("areaJogo");
const objeto = document.getElementById("objeto");
const alvo = document.getElementById("alvo");

const rodadaElemento = document.getElementById("rodada");
const acertosElemento = document.getElementById("acertos");

const feedback = document.getElementById("feedback");
const botaoProxima = document.getElementById("proxima");

const resultado = document.getElementById("resultado");
const resultadoTexto = document.getElementById("resultadoTexto");
const jogarNovamente = document.getElementById("jogarNovamente");


// ==================================================
// CONFIGURAÇÕES
// ==================================================

const TOTAL_RODADAS = 10;

const TOTAL_PAREDES = 5;

const BOLA_TAMANHO = 55;

const ALVO_TAMANHO = 70;


// ==================================================
// VARIÁVEIS
// ==================================================

let rodadaAtual = 1;

let acertos = 0;

let arrastando = false;

let offsetX = 0;

let offsetY = 0;

let bolaX = 20;

let bolaY = 20;

let alvoX = 0;

let alvoY = 0;

let paredes = [];


// ==================================================
// UTILITÁRIO
// ==================================================

function aleatorio(min, max) {

    return Math.floor(
        Math.random() * (max - min + 1)
    ) + min;

}


// ==================================================
// INICIAR RODADA
// ==================================================

function iniciarRodada() {

    arrastando = false;

    feedback.textContent = "";

    feedback.className = "feedback";

    botaoProxima.style.display = "none";

    objeto.style.display = "flex";

    alvo.style.display = "flex";

    objeto.style.pointerEvents = "auto";

    rodadaElemento.textContent = rodadaAtual;

    acertosElemento.textContent = acertos;


    gerarParedes();

    posicionarBola();

    posicionarAlvo();

}


// ==================================================
// GERAR PAREDES ALEATÓRIAS
// ==================================================

function gerarParedes() {

    const elementos =
        document.querySelectorAll(".parede");


    paredes = [];


    elementos.forEach(function (elemento, indice) {

        let horizontal =
            Math.random() > 0.5;


        let parede;


        if (horizontal) {

            parede = {

                x: aleatorio(
                    90,
                    areaJogo.clientWidth - 300
                ),

                y: aleatorio(
                    90,
                    areaJogo.clientHeight - 90
                ),

                width: aleatorio(
                    140,
                    300
                ),

                height: 18

            };

        } else {

            parede = {

                x: aleatorio(
                    100,
                    areaJogo.clientWidth - 100
                ),

                y: aleatorio(
                    80,
                    areaJogo.clientHeight - 220
                ),

                width: 18,

                height: aleatorio(
                    100,
                    220
                )

            };

        }


        paredes.push(parede);


        elemento.style.left =
            `${parede.x}px`;

        elemento.style.top =
            `${parede.y}px`;

        elemento.style.width =
            `${parede.width}px`;

        elemento.style.height =
            `${parede.height}px`;

    });

}


// ==================================================
// POSICIONAR BOLA
// ==================================================

function posicionarBola() {

    bolaX = 20;

    bolaY = 20;


    objeto.style.left =
        `${bolaX}px`;

    objeto.style.top =
        `${bolaY}px`;

}


// ==================================================
// POSICIONAR ALVO
// ==================================================

function posicionarAlvo() {

    const largura =
        areaJogo.clientWidth;

    const altura =
        areaJogo.clientHeight;


    let tentativas = 0;


    do {

        alvoX =
            aleatorio(
                Math.floor(largura * 0.60),
                largura - ALVO_TAMANHO - 20
            );


        alvoY =
            aleatorio(
                30,
                altura - ALVO_TAMANHO - 20
            );


        tentativas++;

    } while (
        (
            colideComParedes(
                alvoX,
                alvoY,
                ALVO_TAMANHO,
                ALVO_TAMANHO
            )
        ) &&
        tentativas < 100
    );


    alvo.style.left =
        `${alvoX}px`;

    alvo.style.top =
        `${alvoY}px`;

}


// ==================================================
// COLISÃO COM RETÂNGULO
// ==================================================

function colide(
    a,
    b
) {

    return (

        a.x < b.x + b.width &&

        a.x + a.width > b.x &&

        a.y < b.y + b.height &&

        a.y + a.height > b.y

    );

}


// ==================================================
// COLISÃO COM PAREDES
// ==================================================

function colideComParedes(
    x,
    y,
    width,
    height
) {

    const objetoAtual = {

        x: x,

        y: y,

        width: width,

        height: height

    };


    for (const parede of paredes) {

        if (
            colide(
                objetoAtual,
                parede
            )
        ) {

            return true;

        }

    }


    return false;

}


// ==================================================
// COMEÇAR ARRASTE
// ==================================================

objeto.addEventListener(
    "pointerdown",
    function (evento) {

        evento.preventDefault();


        arrastando = true;


        const areaRect =
            areaJogo.getBoundingClientRect();


        offsetX =
            evento.clientX -
            areaRect.left -
            bolaX;


        offsetY =
            evento.clientY -
            areaRect.top -
            bolaY;


        objeto.setPointerCapture(
            evento.pointerId
        );

    }
);


// ==================================================
// MOVIMENTO
// ==================================================

objeto.addEventListener(
    "pointermove",
    function (evento) {

        if (!arrastando) {

            return;

        }


        evento.preventDefault();


        const areaRect =
            areaJogo.getBoundingClientRect();


        let novoX =
            evento.clientX -
            areaRect.left -
            offsetX;


        let novoY =
            evento.clientY -
            areaRect.top -
            offsetY;


        const maxX =
            areaJogo.clientWidth -
            BOLA_TAMANHO;


        const maxY =
            areaJogo.clientHeight -
            BOLA_TAMANHO;


        novoX =
            Math.max(
                0,
                Math.min(
                    novoX,
                    maxX
                )
            );


        novoY =
            Math.max(
                0,
                Math.min(
                    novoY,
                    maxY
                )
            );


        // Movimento horizontal

        if (
            !colideComParedes(
                novoX,
                bolaY,
                BOLA_TAMANHO,
                BOLA_TAMANHO
            )
        ) {

            bolaX = novoX;

        }


        // Movimento vertical

        if (
            !colideComParedes(
                bolaX,
                novoY,
                BOLA_TAMANHO,
                BOLA_TAMANHO
            )
        ) {

            bolaY = novoY;

        }


        objeto.style.left =
            `${bolaX}px`;

        objeto.style.top =
            `${bolaY}px`;

    }
);


// ==================================================
// SOLTAR BOLA
// ==================================================

objeto.addEventListener(
    "pointerup",
    function () {

        if (!arrastando) {

            return;

        }


        arrastando = false;


        if (chegouAoAlvo()) {

            completarRodada();

        }

    }
);


// ==================================================
// CANCELAR
// ==================================================

objeto.addEventListener(
    "pointercancel",
    function () {

        arrastando = false;

    }
);


// ==================================================
// VERIFICAR ALVO
// ==================================================

function chegouAoAlvo() {

    const bola = {

        x: bolaX,

        y: bolaY,

        width: BOLA_TAMANHO,

        height: BOLA_TAMANHO

    };


    const alvoAtual = {

        x: alvoX,

        y: alvoY,

        width: ALVO_TAMANHO,

        height: ALVO_TAMANHO

    };


    return colide(
        bola,
        alvoAtual
    );

}


// ==================================================
// COMPLETAR
// ==================================================

function completarRodada() {

    acertos++;

    acertosElemento.textContent =
        acertos;


    feedback.textContent =
        "🎉 Muito bem!";

    feedback.className =
        "feedback acerto";


    objeto.style.pointerEvents =
        "none";


    if (
        rodadaAtual <
        TOTAL_RODADAS
    ) {

        botaoProxima.style.display =
            "inline-block";

    } else {

        finalizarJogo();

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

            objeto.style.display =
                "none";

            alvo.style.display =
                "none";


            resultado.style.display =
                "block";


            resultadoTexto.textContent =
                `Você completou ${acertos} de ${TOTAL_RODADAS} rodadas.`;

        },
        500
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