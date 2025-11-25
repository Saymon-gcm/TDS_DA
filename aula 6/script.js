var nome = localStorage.getItem('nome');//getitem = buscar item
var input = document.getElementById('campo'); //getelementbyid = buscar elemento
input.value = nome;

function salvar(){
    var nome = input.value;

    localStorage.setItem('nome',nome);
}

function excluir(){
    localStorage.removeItem('nome');
    input.value ="";
}
const pessoas = ["Guilherme","Maria","Jose","Darlana","Saymon","Ariel"];

function mostra{
    console.log = (pessoas);

    for(var i = 0; i <= 5; i++){
        const h1 = document.createElement("h1");
        h1.innerHTML = pessoas[i];
        document.body.appendChild(h1);
    }
}
