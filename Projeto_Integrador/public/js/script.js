const perfil = document.getElementById("perfil");
const menu = document.getElementById("menuPerfil");

perfil.addEventListener("click", function(e){

    e.stopPropagation();

    if(menu.style.display === "block"){
        menu.style.display = "none";
    }else{
        menu.style.display = "block";
    }

});

document.addEventListener("click", function(){

    menu.style.display = "none";

});

const botao = document.getElementById("notificacaoButton");
const caixa = document.getElementById("caixaMensagem");

// Abre/fecha ao clicar no botão
botao.addEventListener("click", (event) => {
    event.stopPropagation(); // Impede que o clique chegue ao documento
    caixa.classList.toggle("mostrar");
});

// Impede que clicar dentro da caixa a feche
caixa.addEventListener("click", (event) => {
    event.stopPropagation();
});

// Fecha ao clicar fora
document.addEventListener("click", () => {
    caixa.classList.remove("mostrar");
});

function falar(texto, botao) {

    // =========================================
    // FAZER O NAVEGADOR FALAR
    // =========================================

    const mensagem = new SpeechSynthesisUtterance();

    mensagem.text = texto;

    mensagem.lang = "pt-BR";

    mensagem.rate = 0.9;

    mensagem.pitch = 1;

    window.speechSynthesis.cancel();

    window.speechSynthesis.speak(mensagem);


    // =========================================
    // PEGAR A IMAGEM DO CARD CLICADO
    // =========================================

    const imagem = botao.querySelector("img");

    if (!imagem) {
        return;
    }


    // =========================================
    // PEGAR O MODAL
    // =========================================

    const modal = document.getElementById("modalImagem");

    const imagemAmpliada =
        document.getElementById("imagemAmpliada");


    // =========================================
    // COLOCAR A IMAGEM NO MODAL
    // =========================================

    imagemAmpliada.src = imagem.src;

    imagemAmpliada.alt = imagem.alt;


    // =========================================
    // ABRIR MODAL
    // =========================================

    modal.classList.add("ativo");

}
const modalImagem =
    document.getElementById("modalImagem");

const fundoModal =
    document.querySelector(".fundo-modal");

if (modalImagem && fundoModal) {

    fundoModal.addEventListener("click", function () {

        modalImagem.classList.remove("ativo");

    });

}

const botaoNotificacao = document.getElementById("notificacaoButton");

if (botaoNotificacao) {

    botaoNotificacao.addEventListener("click", async () => {

        console.log("Permissão antes:", Notification.permission);

        if (!("Notification" in window)) {
            alert("Este navegador não suporta notificações.");
            return;
        }

        if (Notification.permission === "default") {

            const permissao = await Notification.requestPermission();

            console.log("Resposta do navegador:", permissao);

            if (permissao === "granted") {

                new Notification("AutiWorld 🧩", {
                    body: "Notificações ativadas!"
                });

            }

        }

        else if (Notification.permission === "granted") {

            console.log("Já está permitida.");

            new Notification("AutiWorld 🧩", {
                body: "Já está ativada."
            });

        }

        else {

            console.log("Está bloqueada.");

            alert("As notificações estão bloqueadas.");

        }

    });

}

function abrirSOS() {

    const resposta = confirm(
        "🚨 EMERGÊNCIA!\n\n" +
        "Deseja enviar uma mensagem de emergência " +
        "pelo WhatsApp para o responsável?"
    );

    if (!resposta) {
        return;
    }

    // ==========================================
    // VERIFICAR TELEFONE
    // ==========================================

    if (!telefoneResponsavel) {

        alert(
            "❌ Não foi encontrado um número de telefone " +
            "cadastrado para o responsável."
        );

        return;
    }

    // ==========================================
    // MENSAGEM
    // ==========================================

    const mensagem =
        "❗ALERTA AUTIWORLD!\n\n" +
        "Uma situação de emergência foi acionada no AutiWorld.\n\n" +
        "Por favor, entre em contato com o usuário o mais rápido possível.";

    // ==========================================
    // CRIAR LINK DO WHATSAPP
    // ==========================================

    const url =
        "https://wa.me/" +
        telefoneResponsavel +
        "?text=" +
        encodeURIComponent(mensagem);

    // ==========================================
    // ABRIR WHATSAPP
    // ==========================================

    window.open(url, "_blank");
}