var nome = localStorage.getItem('nome');//getitem = buscar item
var input = document.getElementById('campo'); //getelementbyid = buscar elemento
input.value = nome;

function salvar(){
    var nome = input.value;

    localStorage.setItem('nome',nome);
}