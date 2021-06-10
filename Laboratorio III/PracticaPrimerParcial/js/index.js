import {AnuncioBienesRaices} from '../models/AnuncioBienesRaices.js';

//Variables
const listaAnuncios = JSON.parse(localStorage.getItem('listaAnuncios')) || [];
/**Si el result del local storage es null, me devuelve []; sino devuelve el valor
 *  3 && 2 => si el primer operando es true, me devuelve el segundo operando
 */
let contenedorTabla = null;

//Init
window.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', handlerClick);
    //Cargo la tabla con los datos del local storage
    contenedorTabla = document.getElementById('tablaAnuncios');
    renderizar(crearTabla(listaAnuncios), contenedorTabla);

})

//Funciones de Renderizacion
function renderizar(lista, contenedor) {
    //Primero lo vacio
    if(contenedor){
        while (contenedor.hasChildNodes()) {
            contenedor.removeChild(contenedor.firstChild);
        }
        //Luego agrego
        if(lista){
            contenedor.appendChild(lista);
        }
    }
}

function crearTabla(items){
    const table = document.createElement('table');
    table.appendChild(crearThead(items[0]));
    table.appendChild(crearTBody(items));
    table.classList.add('table', 'table-dark', 'table-striped');
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

function handlerClick(e) {
    e.preventDefault();
    if(e.target.matches('td')) {
        const idElementoSeleccionado = e.target.parentNode.dataset.id;
        cargarElementoFormulario(idElementoSeleccionado);
        /** Cambio el boton por el texto modificar */

    }else if(e.target.matches('#btnFormulario')){
        /** Obtengo el formulario */
        const formulario = document.forms[0];        
        /** Creo el elemento */
        let dateNow = new Date();
        const id = dateNow.getTime();
        const titulo = formulario.titulo.value;
        const transaccion = formulario.transaccion.value;
        const descripcion = formulario.descripcion.value;
        const precio = formulario.precio.value;
        const banio = formulario.banio.value;
        const estacionamiento = formulario.estacionamiento.value;
        const dormitorios = formulario.dormitorios.value;
        const anuncio = new AnuncioBienesRaices(id,titulo, transaccion, descripcion, precio, banio, estacionamiento, dormitorios);
        
        /** Cargo a la lista */
        listaAnuncios.push(anuncio);
        /** Renderizo la tabla */
        renderizar(crearTabla(listaAnuncios), contenedorTabla);
        /** Guardo la info */
        localStorage.setItem('listaAnuncios', JSON.stringify(listaAnuncios))
        /** Limpiar formulario */
        formulario.reset();
    }else if(e.target.matches('#btnEliminar')){

    }else{
        return;
    }
}



function cargarElementoFormulario(idElemento) {
    /** obtengo el elemento del array */
    const elementoSeleccionado = listaAnuncios.find(e => e.id == idElemento);
    /** Obtengo el formulario */
    const formulario = document.getElementById(idElemento);
    /** Cargo los datos en el formulario */
    formulario.id = elementoSeleccionado.id;
    formulario.titulo = elementoSeleccionado.titulo;
    //formulario.titulo = elementoSeleccionado.titulo;
    formulario.descripcion = elementoSeleccionado.descripcion;
    formulario.precio = elementoSeleccionado.precio;
    formulario.banio = elementoSeleccionado.banio;
    formulario.estacionamiento = elementoSeleccionado.estacionamiento;
    formulario.dormitorios = elementoSeleccionado.dormitorios;
}