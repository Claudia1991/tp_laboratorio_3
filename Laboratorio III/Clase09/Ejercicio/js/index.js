import { marcas } from '../data/data.js';

console.log(marcas);

//Json como texto
console.log(JSON.stringify(marcas));

//texto como JSON
console.log(JSON.parse(JSON.stringify(marcas)));

window.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnLista').addEventListener('click', handlerLoadList);

    // document.getElementById('btnLista').addEventListener('click', () => {

    // });
})

function crearLista(lista) {
    const ul = document.createElement('ul');
    lista.forEach(element => {
        const li = document.createElement('li');
        const content = document.createTextNode(element.marca);
        li.appendChild(content);
        ul.appendChild(li);
    });
    return ul;
}

function renderizarLista(lista, contenedor) {
    //contenedor.innerText = "";
    //Primero lo vacio
    while (contenedor.hasChildNodes()) {
        contenedor.removeChild(contenedor.firstChild);
    }
    //Luego agrego
    if(lista){
        contenedor.appendChild(lista);
    }
}

function handlerLoadList(e) {
    const contenedor = document.getElementById('divLista');
    const lista = crearLista(marcas);
    renderizarLista(lista, contenedor);
    const emisor = e.target;
    emisor.textContent = "Eliminar lista";
    emisor.removeEventListener('click', handlerLoadList);
    emisor.addEventListener('click', handlerDeleteList)
}

function handlerDeleteList(e){
    const contenedor = document.getElementById('divLista');
    renderizarLista(null,contenedor );
    const emisor = e.target;
    emisor.textContent = "Crear lista";
    emisor.addEventListener('click', handlerLoadList);
}