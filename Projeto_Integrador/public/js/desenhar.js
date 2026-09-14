// ==================================================
// JOGO DE DESENHAR
// ==================================================

const canvas = document.getElementById("canvasDesenho");
const contexto = canvas.getContext("2d");


// ==================================================
// CONFIGURAÇÕES
// ==================================================

let desenhando = false;

let corAtual = "#000000";

let tamanhoAtual = 8;

let usandoBorracha = false;


// ==================================================
// AJUSTAR TAMANHO DO CANVAS
// ==================================================

function ajustarCanvas() {

    const largura = canvas.clientWidth;
    const altura = canvas.clientHeight;

    const imagemAnterior = document.createElement("canvas");

    imagemAnterior.width = canvas.width;
    imagemAnterior.height = canvas.height;

    const contextoAnterior =
        imagemAnterior.getContext("2d");

    contextoAnterior.drawImage(canvas, 0, 0);


    canvas.width = largura * window.devicePixelRatio;
    canvas.height = altura * window.devicePixelRatio;


    canvas.style.width = largura + "px";
    canvas.style.height = altura + "px";


    contexto.setTransform(
        window.devicePixelRatio,
        0,
        0,
        window.devicePixelRatio,
        0,
        0
    );


    if (imagemAnterior.width > 0) {

        contexto.drawImage(
            imagemAnterior,
            0,
            0,
            imagemAnterior.width,
            imagemAnterior.height,
            0,
            0,
            largura,
            altura
        );

    }

}


ajustarCanvas();


window.addEventListener(
    "resize",
    ajustarCanvas
);


// ==================================================
// PEGAR POSIÇÃO DO TOQUE/MOUSE
// ==================================================

function obterPosicao(evento) {

    const retangulo =
        canvas.getBoundingClientRect();

    return {

        x: evento.clientX - retangulo.left,

        y: evento.clientY - retangulo.top

    };

}


// ==================================================
// COMEÇAR DESENHO
// ==================================================

canvas.addEventListener(
    "pointerdown",
    function (evento) {

        desenhando = true;

        const posicao =
            obterPosicao(evento);

        contexto.beginPath();

        contexto.moveTo(
            posicao.x,
            posicao.y
        );

        contexto.lineCap = "round";

        contexto.lineJoin = "round";

        contexto.lineWidth =
            tamanhoAtual;


        if (usandoBorracha) {

            contexto.strokeStyle = "white";

        } else {

            contexto.strokeStyle =
                corAtual;

        }

        canvas.setPointerCapture(
            evento.pointerId
        );

    }
);


// ==================================================
// DESENHAR
// ==================================================

canvas.addEventListener(
    "pointermove",
    function (evento) {

        if (!desenhando) {
            return;
        }


        const posicao =
            obterPosicao(evento);


        contexto.lineTo(
            posicao.x,
            posicao.y
        );


        contexto.stroke();

    }
);


// ==================================================
// PARAR DESENHO
// ==================================================

canvas.addEventListener(
    "pointerup",
    pararDesenho
);


canvas.addEventListener(
    "pointercancel",
    pararDesenho
);


function pararDesenho() {

    desenhando = false;

    contexto.closePath();

}


// ==================================================
// ESCOLHER COR
// ==================================================

const botoesCor =
    document.querySelectorAll(".cor");


botoesCor.forEach(
    function (botao) {

        botao.addEventListener(
            "click",
            function () {

                corAtual =
                    botao.dataset.cor;

                usandoBorracha = false;


                botoesCor.forEach(
                    function (item) {

                        item.classList.remove(
                            "selecionada"
                        );

                    }
                );


                botao.classList.add(
                    "selecionada"
                );

            }
        );

    }
);


// ==================================================
// TAMANHO DO PINCEL
// ==================================================

const tamanhoPincel =
    document.getElementById(
        "tamanhoPincel"
    );


tamanhoPincel.addEventListener(
    "input",
    function () {

        tamanhoAtual =
            Number(this.value);

    }
);


// ==================================================
// BORRACHA
// ==================================================

const botaoBorracha =
    document.getElementById(
        "borracha"
    );


botaoBorracha.addEventListener(
    "click",
    function () {

        usandoBorracha =
            !usandoBorracha;


        if (usandoBorracha) {

            botaoBorracha.textContent =
                "✏️ Pincel";

        } else {

            botaoBorracha.textContent =
                "🧹 Borracha";

        }

    }
);


// ==================================================
// LIMPAR
// ==================================================

const botaoLimpar =
    document.getElementById(
        "limpar"
    );


botaoLimpar.addEventListener(
    "click",
    function () {

        contexto.clearRect(
            0,
            0,
            canvas.width,
            canvas.height
        );

    }
);