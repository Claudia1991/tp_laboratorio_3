import { AnuncioAutos } from '../models/AnuncioAuto.js';

//Variables
const listaAnuncios = JSON.parse(localStorage.getItem('listaAnuncios')) || [];
/**Si el result del local storage es null, me devuelve []; sino devuelve el valor
 *  3 && 2 => si el primer operando es true, me devuelve el segundo operando
 */
const tiempoDelay = 3000;
let contenedorTabla = null;
let formulario = null;
let tiposTransacciones = [];

//Init
window.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', handlerClick);
    //Cargo la tabla con los datos del local storage
    document.getElementById('filtro').addEventListener('change', handlerSelect);
    /** Obtengo los checkbox y les agrego el event listener */
    const cbs = document.querySelectorAll('input[type=checkbox]');
    cbs.forEach(cb => cb.addEventListener('mouseover', handlerCheckbox));
    contenedorTabla = document.getElementById('tablaAnuncios');
    renderizar(crearTabla(listaAnuncios), contenedorTabla);
    formulario = document.forms[0];
})

//Funciones de Renderizacion
function renderizar(lista, contenedor) {
    //Primero lo vacio
    if (contenedor) {
        while (contenedor.hasChildNodes()) {
            contenedor.removeChild(contenedor.firstChild);
        }
        //Luego agrego
        if (lista) {
            contenedor.appendChild(lista);
        }
    }
}

function crearTabla(items) {
    const table = document.createElement('table');
    table.appendChild(crearThead(items[0]));
    table.appendChild(crearTBody(items));
    return table;
}

function crearThead(item) {
    const thead = document.createElement('thead');
    const tr = document.createElement('tr');
    for (const key in item) {
        if (key !== 'id') {
            const th = document.createElement('th');
            const texto = document.createTextNode(key);
            th.appendChild(texto);
            tr.appendChild(th);
        }
    }
    thead.appendChild(tr);
    return thead;
}

function crearTBody(items) {
    const tbody = document.createElement('tbody');
    items.forEach(item => {
        const tr = document.createElement('tr');
        for (const key in item) {
            if (key === 'id') {
                tr.setAttribute('data-id', item[key]);
            } else {
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

function handlerCheckbox(e) {
    e.preventDefault();
    const valueCheckBox = e.srcElement.defaultValue;
    const checkBox = document.querySelector("[name='transaccion'][value='" + valueCheckBox + "']");
    checkBox.checked = !checkBox.checked;
    /** Agrego el value a un array temporal, para luego realizar la carga */
    if (checkBox.checked) {
        /** Agrego el tipo de transaccion */
        tiposTransacciones.push(valueCheckBox)
    } else {
        /** Saco el tipo de transaccion */
        tiposTransacciones.splice(tiposTransacciones.indexOf(valueCheckBox), 1);
    }
}

function handlerSelect(e) {
    const filtro = document.getElementById('filtro').value;
    const anunciosFiltrados = obtenerAnunciosFiltradosTipoVenta(listaAnuncios, filtro);
    const preciosAnunciosFiltrados = obtenerPreciosAnuncios(anunciosFiltrados);
    document.getElementById('promedio').value = obtenerPromedioPrecios(preciosAnunciosFiltrados).toFixed(2);
    renderizar(crearTabla(anunciosFiltrados), contenedorTabla);
}

function handlerClick(e) {
    e.preventDefault();
    
    if (e.target.matches('td')) {
        formulario.reset();
        const idElementoSeleccionado = e.target.parentNode.dataset.id;
        cargarElementoFormulario(idElementoSeleccionado);
        /** Cambio el boton por el texto modificar */
    } else if (e.target.matches('#btnFormulario')) {
        /** Creo el elemento */
        if (!formulario.id.value) {
            console.log('/** Creo el anuncio */');
            /** Creo el anuncio */
            const dateNow = new Date();
            const anuncio = crearAuncio(dateNow.getTime(), formulario);
            /** Habilito el spinner magico */

            /** Muestro el mensaje custon por pantalla */
            document.getElementById('mensajeInformativo').appendChild(crearMensaje(1));
            document.getElementById('espinner').style.display = 'block';
            setTimeout(() => {
                document.getElementById('mensajeInformativo').removeChild(document.querySelector('#mensajeInformativo').firstElementChild);
                document.getElementById('espinner').style.display = 'none';
                /** Cargo a la lista */
                listaAnuncios.push(anuncio);
                /** Renderizo la tabla */
                renderizar(crearTabla(listaAnuncios), contenedorTabla);
                /** Guardo la info */
                localStorage.setItem('listaAnuncios', JSON.stringify(listaAnuncios))
                /** Limpiar formulario */
                formulario.reset();
                /** Limpio el array temporal */
                tiposTransacciones = [];
            }, tiempoDelay);

        } else {
            console.log('/** Modifico el anuncio */');
            const anuncio = crearAuncio(formulario.id.value, formulario);
            /** Habilito el spinner magico */
            document.getElementById('espinner').style.display = 'block';
            /** Muestro el mensaje custon por pantalla */
            document.getElementById('mensajeInformativo').appendChild(crearMensaje(2));
            setTimeout(() => {
                /** Oculto el mensaje custom */
                document.getElementById('mensajeInformativo').removeChild(document.querySelector('#mensajeInformativo').firstElementChild);
                document.getElementById('espinner').style.display = 'none';
                /** Cargo a la lista */
                const index = listaAnuncios.findIndex(e => e.id == anuncio.id);
                /** Elimino el elemento del array */
                listaAnuncios.splice(index, 1);
                /** Agrego el elemento modificado */
                listaAnuncios.push(anuncio);
                /** Renderizo la tabla */
                renderizar(crearTabla(listaAnuncios), contenedorTabla);
                /** Guardo la info */
                localStorage.setItem('listaAnuncios', JSON.stringify(listaAnuncios))
                /** Limpiar formulario */
                formulario.reset();
                /** Actualizo los botoñes */
                /** Deshabilito el boton de Eliminar */
                document.getElementById('btnEliminar').style.display = 'none';
                /** Cambio el value del formulario, ya que podria modificar el elemento */
                document.getElementById('btnFormulario').innerText = 'Agregar';
                /** Limpio el array temporal */
                tiposTransacciones = [];
            }, tiempoDelay);
        }
    } else if (e.target.matches('#btnEliminar')) {
        /** Previamente */
        if (confirm("¿Esta seguro que desea eliminar?")) {
            document.getElementById('espinner').style.display = 'block';
            /** Muestro el mensaje custon por pantalla */
            document.getElementById('mensajeInformativo').appendChild(crearMensaje(3));
            setTimeout(() => {
                /** Oculto el mensaje custom */
                document.getElementById('mensajeInformativo').removeChild(document.querySelector('#mensajeInformativo').firstElementChild);
                document.getElementById('espinner').style.display = 'none';
                const idEliminar = formulario.id;
                const index = listaAnuncios.findIndex(e => e.id == idEliminar);
                /** Elimino el elemento del array */
                listaAnuncios.splice(index, 1);
                /** Renderizo la tabla */
                renderizar(crearTabla(listaAnuncios), contenedorTabla);
                /** Guardo la info */
                localStorage.setItem('listaAnuncios', JSON.stringify(listaAnuncios))
                /** Limpiar formulario */
                formulario.reset();
                /** Acomodar los botones al eliminar */
                /** Actualizo los botoñes */
                /** Deshabilito el boton de Eliminar */
                document.getElementById('btnEliminar').style.display = 'none';
                /** Cambio el value del formulario, ya que podria modificar el elemento */
                document.getElementById('btnFormulario').innerText = 'Agregar';
                /** Limpio el array temporal */
                tiposTransacciones = [];
            }, tiempoDelay);
        } else {
            alert('Acción cancelada.');
            formulario.reset();
        }

    } else {
        return;
    }
}

function cargarElementoFormulario(idElemento) {
    /** obtengo el elemento del array */
    const elementoSeleccionado = listaAnuncios.find(e => e.id == idElemento);

    console.log(elementoSeleccionado.transaccion);
    /** Cargo los datos en el formulario */
    formulario.id.value = elementoSeleccionado.id;
    formulario.titulo.value = elementoSeleccionado.titulo;
    cargarTiposTransaccion(elementoSeleccionado.transaccion);
    formulario.descripcion.value = elementoSeleccionado.descripcion;
    formulario.precio.value = elementoSeleccionado.precio;
    formulario.puertas.value = elementoSeleccionado.puertas;
    formulario.km.value = elementoSeleccionado.km;
    formulario.potencia.value = elementoSeleccionado.potencia;
    /** Habilito el boton de Eliminar */
    document.getElementById('btnEliminar').style.display = 'block';
    /** Cambio el value del formulario, ya que podria modificar el elemento */
    document.getElementById('btnFormulario').innerText = 'Modificar';
}

const cargarTiposTransaccion = (arrayTransaccion) => {
    arrayTransaccion.forEach(transaccion => {
        const checkBox = document.querySelector("[name='transaccion'][value='" + transaccion + "']");
        checkBox.checked = true;
    });
    tiposTransacciones = arrayTransaccion;
}

const crearAuncio = (id, formulario) => {
    const titulo = formulario.titulo.value;
    const transaccion = tiposTransacciones;
    const descripcion = formulario.descripcion.value;
    const precio = parseInt(formulario.precio.value);
    const puertas = formulario.puertas.value;
    const km = formulario.km.value;
    const potencia = formulario.potencia.value;
    return new AnuncioAutos(id, titulo, transaccion, descripcion, precio, potencia, km, puertas);
}

const crearMensaje = (tipoMensaje) => {
    let mensaje = '';
    switch (tipoMensaje) {
        case 1:
            mensaje = 'Se dio de alta el anuncio.';
            break;
        case 2:
            mensaje = 'Se modifico  el anuncio';
            break;
        case 3:
            mensaje = 'Se elimino el anuncio';
            break;
    }
    const p = document.createElement('p');
    p.innerText = mensaje;
    return p;
}

/** Filtros */
/** Map - Reduce - Filter */
const obtenerPromedioPrecios = (arrayPreciosAnuncios) => {
    /**Reduce para obtener la sumatoria del array de precios */
    console.log(arrayPreciosAnuncios);
    return arrayPreciosAnuncios.reduce((p, c) => p + c, 0) / arrayPreciosAnuncios.length;
}

const obtenerPreciosAnuncios = (arrayAnuncios) => {
    /** Map para  obtener el array de precios de los anuncios */
    return arrayAnuncios.map(a => a.precio);
}

const obtenerAnunciosFiltradosTipoVenta = (arrayAnuncios, filtro) => {
    /** Filter para filtrar por el tipo de transazzion */
    return filtro != 'Todos' ? arrayAnuncios.filter(a => a.transaccion.includes(filtro)) : arrayAnuncios;
}

const obtenerAnunciosFiltradosPrecioVenta = (arrayAnuncios, filtro) => {
    /** Filter para filtrar por precio menores o iguales al precio pasado por giltro */
    return arrayAnuncios.filter(a => a.precio <= filtro);
}