document.addEventListener("DOMContentLoaded", () => {

    // ==========================================================
    // ELEMENTOS
    // ==========================================================

    const salaContainer = document.getElementById("salaContainer");

    const videoAluno = document.getElementById("videoAluno");
    const cameraMensagem = document.getElementById("cameraMensagem");

    const microfoneButton = document.getElementById("microfoneButton");
    const cameraButton = document.getElementById("cameraButton");
    const telaButton = document.getElementById("telaButton");
    const maoButton = document.getElementById("maoButton");
    const chatButton = document.getElementById("chatButton");
    const sairSala = document.getElementById("sairSala");

    const mensagemChat = document.getElementById("mensagemChat");
    const fecharChat = document.getElementById("fecharChat");
    const chatMensagens = document.getElementById("chatMensagens");
    const chatInput = document.getElementById("chatInput");
    const enviarChat = document.getElementById("enviarChat");


    // ==========================================================
    // ESTADO
    // ==========================================================

    let cameraStream = null;
    let microfoneStream = null;
    let telaStream = null;

    let cameraLigada = false;
    let microfoneLigado = false;
    let telaCompartilhada = false;
    let maoLevantada = false;


    // ==========================================================
    // VERIFICAR SUPORTE DO NAVEGADOR
    // ==========================================================

    function navegadorSuportaCamera() {

        if (!navigator.mediaDevices) {
            mostrarMensagemCamera(
                "⚠️ Este navegador não permite acesso à câmera."
            );

            return false;
        }

        if (!navigator.mediaDevices.getUserMedia) {
            mostrarMensagemCamera(
                "⚠️ Seu navegador não suporta acesso à câmera."
            );

            return false;
        }

        return true;
    }


    // ==========================================================
    // MENSAGEM DA CÂMERA
    // ==========================================================

    function mostrarMensagemCamera(mensagem) {

        if (!cameraMensagem) {
            return;
        }

        cameraMensagem.textContent = mensagem;
        cameraMensagem.style.display = "flex";
    }


    function esconderMensagemCamera() {

        if (!cameraMensagem) {
            return;
        }

        cameraMensagem.style.display = "none";
    }


    // ==========================================================
    // ATUALIZAR BOTÃO DA CÂMERA
    // ==========================================================

    function atualizarBotaoCamera() {

        if (!cameraButton) {
            return;
        }

        if (cameraLigada) {

            cameraButton.classList.add("ativo");

            cameraButton.setAttribute(
                "aria-label",
                "Desligar câmera"
            );

            cameraButton.title = "Desligar câmera";

        } else {

            cameraButton.classList.remove("ativo");

            cameraButton.setAttribute(
                "aria-label",
                "Ligar câmera"
            );

            cameraButton.title = "Ligar câmera";
        }
    }


    // ==========================================================
    // ATUALIZAR BOTÃO DO MICROFONE
    // ==========================================================

    function atualizarBotaoMicrofone() {

        if (!microfoneButton) {
            return;
        }

        if (microfoneLigado) {

            microfoneButton.classList.add("ativo");

            microfoneButton.setAttribute(
                "aria-label",
                "Desligar microfone"
            );

            microfoneButton.title = "Desligar microfone";

        } else {

            microfoneButton.classList.remove("ativo");

            microfoneButton.setAttribute(
                "aria-label",
                "Ligar microfone"
            );

            microfoneButton.title = "Ligar microfone";
        }
    }


    // ==========================================================
    // LIGAR CÂMERA
    // ==========================================================

    async function ligarCamera() {

        if (!navegadorSuportaCamera()) {
            return;
        }

        // Já está ligada
        if (cameraLigada && cameraStream) {
            return;
        }

        try {

            mostrarMensagemCamera("📷 Solicitando acesso à câmera...");

            /*
             * IMPORTANTE:
             * Pedimos SOMENTE a câmera.
             * O microfone não interfere mais na câmera.
             */
            cameraStream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: {
                        ideal: "user"
                    },

                    width: {
                        ideal: 1280
                    },

                    height: {
                        ideal: 720
                    }
                },

                audio: false
            });


            // Coloca a câmera no vídeo
            videoAluno.srcObject = cameraStream;

            videoAluno.muted = true;
            videoAluno.autoplay = true;
            videoAluno.playsInline = true;

            try {
                await videoAluno.play();
            } catch (erroVideo) {
                console.log(
                    "O vídeo será iniciado pelo navegador:",
                    erroVideo
                );
            }

            cameraLigada = true;

            esconderMensagemCamera();
            atualizarBotaoCamera();


        } catch (erro) {

            console.error(
                "ERRO AO ABRIR CÂMERA:",
                erro
            );

            cameraLigada = false;
            cameraStream = null;

            atualizarBotaoCamera();

            let mensagem = "❌ Não foi possível abrir a câmera.";

            if (erro.name === "NotAllowedError") {

                mensagem =
                    "🔒 Permissão da câmera bloqueada. Autorize a câmera no navegador.";

            } else if (erro.name === "NotFoundError") {

                mensagem =
                    "📷 Nenhuma câmera foi encontrada neste dispositivo.";

            } else if (erro.name === "NotReadableError") {

                mensagem =
                    "⚠️ A câmera está sendo usada por outro aplicativo.";

            } else if (erro.name === "SecurityError") {

                mensagem =
                    "🔒 O navegador bloqueou a câmera por segurança.";

            } else if (erro.name === "AbortError") {

                mensagem =
                    "⚠️ O acesso à câmera foi interrompido.";

            }

            mostrarMensagemCamera(mensagem);
        }
    }


    // ==========================================================
    // DESLIGAR CÂMERA
    // ==========================================================

    function desligarCamera() {

        if (cameraStream) {

            cameraStream.getTracks().forEach(track => {
                track.stop();
            });

            cameraStream = null;
        }

        if (videoAluno) {
            videoAluno.srcObject = null;
        }

        cameraLigada = false;

        mostrarMensagemCamera(
            "📷 Sua câmera está desligada"
        );

        atualizarBotaoCamera();
    }


    // ==========================================================
    // BOTÃO DA CÂMERA
    // ==========================================================

    if (cameraButton) {

        cameraButton.addEventListener("click", async (event) => {

            event.preventDefault();

            if (cameraLigada) {

                desligarCamera();

            } else {

                /*
                 * A câmera é solicitada SOMENTE após
                 * o usuário tocar no botão.
                 *
                 * Isso é importante principalmente
                 * no celular.
                 */
                await ligarCamera();
            }

        });
    }


    // ==========================================================
    // LIGAR MICROFONE
    // ==========================================================

    async function ligarMicrofone() {

        if (!navigator.mediaDevices ||
            !navigator.mediaDevices.getUserMedia) {

            alert(
                "Seu navegador não permite acesso ao microfone."
            );

            return;
        }

        if (microfoneLigado && microfoneStream) {
            return;
        }

        try {

            microfoneStream =
                await navigator.mediaDevices.getUserMedia({
                    video: false,
                    audio: true
                });

            microfoneLigado = true;

            atualizarBotaoMicrofone();

        } catch (erro) {

            console.error(
                "ERRO AO ABRIR MICROFONE:",
                erro
            );

            microfoneLigado = false;

            atualizarBotaoMicrofone();

            if (erro.name === "NotAllowedError") {

                alert(
                    "🔒 Permissão do microfone bloqueada. Autorize o microfone no navegador."
                );

            } else {

                alert(
                    "❌ Não foi possível acessar o microfone."
                );
            }
        }
    }


    // ==========================================================
    // DESLIGAR MICROFONE
    // ==========================================================

    function desligarMicrofone() {

        if (microfoneStream) {

            microfoneStream.getTracks().forEach(track => {
                track.stop();
            });

            microfoneStream = null;
        }

        microfoneLigado = false;

        atualizarBotaoMicrofone();
    }


    // ==========================================================
    // BOTÃO DO MICROFONE
    // ==========================================================

    if (microfoneButton) {

        microfoneButton.addEventListener("click", async (event) => {

            event.preventDefault();

            if (microfoneLigado) {

                desligarMicrofone();

            } else {

                await ligarMicrofone();
            }
        });
    }


    // ==========================================================
    // COMPARTILHAR TELA
    // ==========================================================

    async function compartilharTela() {

        if (!navigator.mediaDevices ||
            !navigator.mediaDevices.getDisplayMedia) {

            alert(
                "Seu navegador não suporta compartilhamento de tela."
            );

            return;
        }

        try {

            if (telaCompartilhada) {

                pararCompartilhamentoTela();

                return;
            }

            telaStream =
                await navigator.mediaDevices.getDisplayMedia({
                    video: true,
                    audio: false
                });

            const videoTelaProfessor =
                document.getElementById("videoTelaProfessor");

            if (videoTelaProfessor) {

                videoTelaProfessor.srcObject = telaStream;
                videoTelaProfessor.style.display = "block";
            }

            telaCompartilhada = true;

            if (telaButton) {
                telaButton.classList.add("ativo");
            }

            const track =
                telaStream.getVideoTracks()[0];

            if (track) {

                track.addEventListener(
                    "ended",
                    () => {
                        pararCompartilhamentoTela();
                    }
                );
            }

        } catch (erro) {

            console.error(
                "ERRO AO COMPARTILHAR TELA:",
                erro
            );
        }
    }


    function pararCompartilhamentoTela() {

        if (telaStream) {

            telaStream.getTracks().forEach(track => {
                track.stop();
            });

            telaStream = null;
        }

        const videoTelaProfessor =
            document.getElementById("videoTelaProfessor");

        if (videoTelaProfessor) {

            videoTelaProfessor.srcObject = null;
            videoTelaProfessor.style.display = "none";
        }

        telaCompartilhada = false;

        if (telaButton) {
            telaButton.classList.remove("ativo");
        }
    }


    if (telaButton) {

        telaButton.addEventListener(
            "click",
            compartilharTela
        );
    }


    // ==========================================================
    // LEVANTAR A MÃO
    // ==========================================================

    if (maoButton) {

        maoButton.addEventListener("click", () => {

            maoLevantada = !maoLevantada;

            maoButton.classList.toggle(
                "ativo",
                maoLevantada
            );
        });
    }


    // ==========================================================
    // ABRIR CHAT
    // ==========================================================

    if (chatButton) {

        chatButton.addEventListener("click", () => {

            if (mensagemChat) {

                mensagemChat.classList.add("aberto");

                if (chatInput) {
                    setTimeout(() => {
                        chatInput.focus();
                    }, 100);
                }
            }
        });
    }


    // ==========================================================
    // FECHAR CHAT
    // ==========================================================

    if (fecharChat) {

        fecharChat.addEventListener("click", () => {

            if (mensagemChat) {
                mensagemChat.classList.remove("aberto");
            }
        });
    }


    // ==========================================================
    // ENVIAR MENSAGEM
    // ==========================================================

    function enviarMensagem() {

        if (!chatInput || !chatMensagens) {
            return;
        }

        const texto = chatInput.value.trim();

        if (texto === "") {
            return;
        }

        const mensagem = document.createElement("div");

        mensagem.className = "mensagem-chat-usuario";

        mensagem.textContent = texto;

        chatMensagens.appendChild(mensagem);

        chatInput.value = "";

        chatMensagens.scrollTop =
            chatMensagens.scrollHeight;
    }


    if (enviarChat) {

        enviarChat.addEventListener(
            "click",
            enviarMensagem
        );
    }


    if (chatInput) {

        chatInput.addEventListener("keydown", event => {

            if (event.key === "Enter") {

                event.preventDefault();

                enviarMensagem();
            }
        });
    }


    // ==========================================================
    // SAIR DA SALA
    // ==========================================================

    if (sairSala) {

        sairSala.addEventListener("click", () => {

            pararDispositivos();

            window.history.back();
        });
    }


    // ==========================================================
    // PARAR TODOS OS DISPOSITIVOS
    // ==========================================================

    function pararDispositivos() {

        if (cameraStream) {

            cameraStream.getTracks().forEach(track => {
                track.stop();
            });

            cameraStream = null;
        }

        if (microfoneStream) {

            microfoneStream.getTracks().forEach(track => {
                track.stop();
            });

            microfoneStream = null;
        }

        if (telaStream) {

            telaStream.getTracks().forEach(track => {
                track.stop();
            });

            telaStream = null;
        }

        if (videoAluno) {
            videoAluno.srcObject = null;
        }

        const videoTelaProfessor =
            document.getElementById("videoTelaProfessor");

        if (videoTelaProfessor) {
            videoTelaProfessor.srcObject = null;
        }

        cameraLigada = false;
        microfoneLigado = false;
        telaCompartilhada = false;

        atualizarBotaoCamera();
        atualizarBotaoMicrofone();
    }


    // ==========================================================
    // QUANDO FECHAR / SAIR DA PÁGINA
    // ==========================================================

    window.addEventListener(
        "beforeunload",
        pararDispositivos
    );


    // ==========================================================
    // ESTADO INICIAL
    // ==========================================================

    atualizarBotaoCamera();
    atualizarBotaoMicrofone();

    mostrarMensagemCamera(
        "📷 Sua câmera está desligada"
    );

});