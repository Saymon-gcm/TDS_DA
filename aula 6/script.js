const dados = localStorage.getItem("dados");
const input = document.getElementById("campo");

// input.value = dados;

function salvar() {
    pessoas.push(input.value)

    const h1 = document.createElement("h1");

    h1.innerHTML = input.value;

    document.body.appendChild(h1);
    SalvaNaMemoriaDoNavegador()
}

function excluir() {
    localStorage.removeItem("dados");
    input.value = "";
}


function SalvaNaMemoriaDoNavegador(){
    localStorage.setItem("dados", JSON.stringify(pessoas));
}

const pessoas = JSON.parse(dados);

Mostra();


function Mostra() {

    console.log(pessoas);

    for (var i = 0; i < pessoas.length; i++) {
        const h1 = document.createElement("h1");

        h1.innerHTML = pessoas[i];

        document.body.appendChild(h1);
    }
}