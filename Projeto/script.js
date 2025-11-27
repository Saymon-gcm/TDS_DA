function exibeCardComida() {
    const card = document.getElementById("comida");

    if (card.classList.contains("comidaDisable")) {
        card.classList.remove("comidaDisable");
    } else {
        card.classList.add('comidaDisable');
    }


}

function exibeCardBebida(){
    const card = document.getElementById("bebida");

    if (card.classList.contains("bebidaDisable")) {
        card.classList.remove("bebidaDisable");
    } else {
        card.classList.add('bebidaDisable');
    }
}