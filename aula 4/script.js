add();

function add(){
    var lista = document.getElementById('itens');

    var campo = document.getElementById('campo');

    var li = document.createElement('li');

    li.innerHTML = campo.value;
    
    lista.appendChild(li);

    campo.value = "";

    var div = document.createElement('div');
    
}