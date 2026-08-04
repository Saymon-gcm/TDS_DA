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

function falar(texto) {

    // Cria uma nova mensagem de voz
    const mensagem = new SpeechSynthesisUtterance();

    // Define o texto que será falado
    mensagem.text = texto;

    // Define o idioma para português do Brasil
    mensagem.lang = "pt-BR";

    // Velocidade da fala
    mensagem.rate = 0.9;

    // Tom da voz
    mensagem.pitch = 1;

    // Para uma fala anterior, caso exista
    window.speechSynthesis.cancel();

    // Faz o navegador falar
    window.speechSynthesis.speak(mensagem);
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
        "🚨 Emergência!\n\nDeseja ligar para o responsável?"
    );

    if (!resposta) {

        return;

    }

    if (navigator.vibrate) {

        navigator.vibrate([300,150,300]);

    }

    window.location.href = "tel:+55" + telefoneResponsavel;

}