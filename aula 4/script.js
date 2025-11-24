function add() {
    var lista = document.getElementById('itens');
    var campo = document.getElementById('campo');

    if (campo.value.trim() === "") return;  

    var li = document.createElement('li');

    
    li.innerHTML = `${campo.value} <button onclick="apagar(this)"><img src="./Imagens/lixeira.png" alt="Excluir" style="width: 16px; height: 16px;"></button>`;

    lista.appendChild(li);

    campo.value = "";
}


function apagar(botao) {
    botao.parentElement.remove();
}