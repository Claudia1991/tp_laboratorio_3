import {AnuncioAutos} from '../models/AnuncioAuto.js';

//Variables
const endpoint = 'http://localhost:3000/anuncios';
let listaAnuncios = [];
let contenedorTabla = null;
let formulario = null;
let formularioFiltro = null;

//Init
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', handlerClick);
    //Cargo la tabla con los datos del json-server 
    contenedorTabla = document.getElementById('tablaAnuncios');
    formulario = document.forms[0];
    formularioFiltro = document.forms[1];
    getAnuncios();
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
    let idInt = 1;
    for (const key in item) {
        if (key !== 'id') {
            const cb = document.createElement("INPUT");
            cb.setAttribute("type", "checkbox");
            cb.setAttribute("data-idColumn", idInt);
            cb.checked = true;
            cb.addEventListener('mouseover', handlerCheckbox);
            const th = document.createElement('th');
            const texto = document.createTextNode(key);
            th.appendChild(cb);
            th.appendChild(texto);
            tr.appendChild(th);
            idInt++;
        }
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

const crearAnuncio = (formulario) => {
    const titulo = formulario.titulo.value;
    const transaccion = formulario.transaccion.value;
    const descripcion = formulario.descripcion.value;
    const precio = parseInt(formulario.precio.value);
    const puertas = parseInt(formulario.puertas.value);
    const km = parseInt(formulario.km.value);
    const potencia = parseInt(formulario.potencia.value);
    return new AnuncioAutos(titulo, transaccion, descripcion, precio, potencia, km, puertas);
}

function agregarModificarElemento(){
    /** Obtengo el formulario */
    const anuncio = crearAnuncio(formulario);
    /** Creo el elemento */
    if (!formulario.id.value) {
        postAnuncios(JSON.stringify(anuncio));
        /** Limpiar formulario */
        formulario.reset();
    } else {
        const id = parseInt(formulario.id.value);
        /** Limpiar formulario */
        formulario.reset();
        putAnuncio(id, JSON.stringify(anuncio));
        /** Actualizo los botoñes */
        /** Deshabilito el boton de Eliminar */
        document.getElementById('btnEliminar').style.display = 'none';
        /** Cambio el value del formulario, ya que podria modificar el elemento */
        document.getElementById('btnFormulario').innerText = 'Agregar';
    }
}

function eliminarElemento(){
    /** Previamente */
    if (confirm("¿Esta seguro que desea eliminar?")) {
        const idEliminar = formulario.id.value;
        /** Llamada api */
        deleteAnuncio(idEliminar);
        /** Limpiar formulario */
        formulario.reset();
        alert('Elemento eliminado con exito.!');
    } else {
        formulario.reset();
    }
}

/** Manejador de eventos */
function handlerClick(e) {
    e.preventDefault();
    if (e.target.matches('td')) {
        const idElementoSeleccionado = e.target.parentNode.dataset.id;
        cargarElementoFormulario(idElementoSeleccionado);
    } else if (e.target.matches('#btnFormulario')) {
        agregarModificarElemento();
    } else if (e.target.matches('#btnEliminar')) {
        eliminarElemento();
    }else if (e.target.matches('#aplicarFiltro')) {
        /** obtengo el tipo de filtro y el numero del precio */
        const tipoFiltro = formularioFiltro.tipoFiltro.value;
        const precio = parseInt(formularioFiltro.numeroFiltro.value);
        console.log(listaAnuncios);
        let listaFiltradaTipoVenta = obtenerAnunciosFiltradosTipoVenta(listaAnuncios, tipoFiltro);
        let listaFiltradaPrecio = obtenerAnunciosFiltradosPrecioVenta(listaFiltradaTipoVenta, precio);
        /** Actulizar la grilla */
        document.getElementById('promedioPrecios').value = obtenerPromedioPrecios(obtenerPreciosAnuncios(listaFiltradaPrecio));
        renderizar(crearTabla(listaFiltradaPrecio), contenedorTabla);
    }else {
        return;
    }
}

function handlerCheckbox(e){
    /** Si esta checkeado, visibility=visible, visibility=hidden */
    /** Traigo todos los tr del body */
    e.preventDefault();
    const trs = document.querySelectorAll('tbody tr');
    const idcheckBox = e.target.dataset.idcolumn;
    const checkBox = document.querySelector("[data-idcolumn='" + idcheckBox + "']");
    checkBox.checked = !checkBox.checked;
    trs.forEach(element => {
        if(checkBox.checked){
            element.children[idcheckBox-1].style.visibility = "visible";
        }else{
            element.children[idcheckBox-1].style.visibility = "hidden";
        }
    });
}

function cargarElementoFormulario(idElemento) {
    /** obtengo el elemento del array */
    const elementoSeleccionado = listaAnuncios.find(e => e.id == idElemento);
    /** Obtengo el formulario */
    const formulario = document.forms[0];
    /** Cargo los datos en el formulario */
    formulario.id.value = elementoSeleccionado.id;
    formulario.titulo.value = elementoSeleccionado.titulo;
    formulario.transaccion.value = elementoSeleccionado.transaccion;
    formulario.descripcion.value = elementoSeleccionado.descripcion;
    formulario.precio.value = elementoSeleccionado.precio;
    formulario.puertas.value = elementoSeleccionado.puertas;
    formulario.km.value = elementoSeleccionado.km;
    formulario.potencia.value = elementoSeleccionado.potencia;
    /** Habilito el boton de Eliminar */
    document.getElementById('btnEliminar').style.display='block';
    /** Cambio el value del formulario, ya que podria modificar el elemento */
    document.getElementById('btnFormulario').innerText= 'Modificar';
}

const createSpinner = () => {
    const spinner = document.createElement('img');
    spinner.setAttribute('src', './assets/spinner.gif')
    spinner.setAttribute('alt', "Imagen Spinner")
    return spinner;
}

/** Funciones de Api */
/** Comandito => json-server -w -d 2000 db.json */

/** GET */
const getAnuncios = () => {
    document.querySelector('.spinner').appendChild(createSpinner());
    fetch(endpoint)
        .then((response) => {
            return response.ok ? response.json() : Promise.reject(response.statusText);
        }).then(res => {
            listaAnuncios = res;
            console.log(listaAnuncios);
            document.getElementById('promedioPrecios').value = obtenerPromedioPrecios(obtenerPreciosAnuncios(listaAnuncios));
            renderizar(crearTabla(listaAnuncios), contenedorTabla);
        })
        .catch((error) => {
            console.error(error);
        }).finally(() => {
            document.querySelector('.spinner').removeChild(document.querySelector('.spinner').firstElementChild);
        });
}

/** POST */
const postAnuncios = (data) => {
    document.querySelector('.spinner').appendChild(createSpinner());
    fetch(endpoint, { method: "post", body: data, headers: { 'Content-Type': 'application/json' } })
        .then((response) => {
            console.log(response);
            return response.ok ? response.json() : Promise.reject(response.statusText);
        })
        .catch((error) => {
            console.error(error);
        }).finally(() => {
            document.querySelector('.spinner').removeChild(document.querySelector('.spinner').firstElementChild);
        });
}

/** PUT */
const putAnuncio = (id, body) => {
    document.querySelector('.spinner').appendChild(createSpinner());
    fetch(endpoint+"/"+id, { method: "put", body: body, headers: { 'Content-Type': 'application/json' } })
        .then((response) => {
            return response.ok ? response.json() : Promise.reject(response.statusText);
        })
        .catch((error) => {
            console.error(error);
        }).finally(() => {
            document.querySelector('.spinner').removeChild(document.querySelector('.spinner').firstElementChild);
        });
}

/** DELETE */
const deleteAnuncio = (id) => {
    document.querySelector('.spinner').appendChild(createSpinner());
    fetch(endpoint+"/"+id, {method:"delete"})
        .then((response) => {
            return response.ok ? response.json() : Promise.reject(response.statusText);
        })
        .catch((error) => {
            console.error(error);
        }).finally(() => {
            document.querySelector('.spinner').removeChild(document.querySelector('.spinner').firstElementChild);
        });
}

/** Filtros */
/** Map - Reduce - Filter */
const obtenerPromedioPrecios = (arrayPreciosAnuncios) => {
    /**Reduce para obtener la sumatoria del array de precios */
    return arrayPreciosAnuncios.reduce( ( p, c ) => p + c, 0 ) / arrayPreciosAnuncios.length;
}

const obtenerPreciosAnuncios = (arrayAnuncios) => {
    /** Map para  obtener el array de precios de los anuncios */
    return arrayAnuncios.map(a => a.precio);
}

const obtenerAnunciosFiltradosTipoVenta = (arrayAnuncios, filtro) => {
    /** Filter para filtrar por el tipo de transazzion */
    return filtro != 'Todos' ? arrayAnuncios.filter(a => a.transaccion == filtro) : arrayAnuncios;
}

const obtenerAnunciosFiltradosPrecioVenta = (arrayAnuncios, filtro) => {
    /** Filter para filtrar por precio menores o iguales al precio pasado por giltro */
    return arrayAnuncios.filter(a => a.precio <= filtro);
}