import { marcas } from '../data/data.js';
import { personas } from '../data/dataPerson.js';

console.log(marcas);

//Json como texto
console.log(JSON.stringify(marcas));

//texto como JSON
console.log(JSON.parse(JSON.stringify(marcas)));

window.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnLista').addEventListener('click', handlerLoadList);
    document.addEventListener('click', handlerClick);

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

function renderizar(lista, contenedor) {
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

// function handlerLoadList(e) {
//     const contenedor = document.getElementById('divLista');
//     const lista = crearLista(marcas);
//     renderizar(lista, contenedor);
//     const emisor = e.target;
//     emisor.textContent = "Eliminar lista";
//     emisor.removeEventListener('click', handlerLoadList);
//     emisor.addEventListener('click', handlerDeleteList)
// }

// function handlerDeleteList(e){
//     const contenedor = document.getElementById('divLista');
//     renderizar(null,contenedor );
//     const emisor = e.target;
//     emisor.textContent = "Crear lista";
//     emisor.addEventListener('click', handlerLoadList);
// }

function handlerLoadList(e) {
    const contenedor = document.getElementById('divTable');
    const table = crearTabla(personas);
    renderizar(table, contenedor);
    const emisor = e.target;
    emisor.textContent = "Eliminar lista";
    emisor.removeEventListener('click', handlerLoadList);
    emisor.addEventListener('click', handlerDeleteList)
}

function handlerDeleteList(e){
    const contenedor = document.getElementById('divTable');
    renderizar(null,contenedor );
    const emisor = e.target;
    emisor.textContent = "Crear lista";
    emisor.addEventListener('click', handlerLoadList);
}

function crearTabla(items){
    const table = document.createElement('table');
    table.appendChild(crearThead(items[0]));
    table.appendChild(crearTBody(items));
    return table;
}

function crearThead(item){
    const thead = document.createElement('thead');
    const tr = document.createElement('tr');
    for (const key in item) {
        const th = document.createElement('th');
        const texto = document.createTextNode(key);
        th.appendChild(texto);
    }
    thead.appendChild(tr);
    return thead;
}

function crearTBody(items){
    const tbody = document.createElement('tbody');
    items.forEach(item =>{
        const tr = document.createElement('tr');
        for (const key in item) {
            if(key === 'id'){
                tr.setAttribute('data-id', item[key]);
            }else{
                const td = document.createElement('td');
                const texto = document.createTextNode(item[key]);
                td.appendChild(texto);
                tr.appendChild(td);
            }
        }
        tbody.appendChild(tr);
    });
    return tbody;
}

function handlerClick(e){
    console.log(e.target);
    if(!e.target.matches('td')) return;

    const id = e.target.parentNode.firstElementChild.textContent;
    const idOtro = e.target.parentNode.dataset.id;
    console.log(id);
    console.log('Otro id',idOtro);
}