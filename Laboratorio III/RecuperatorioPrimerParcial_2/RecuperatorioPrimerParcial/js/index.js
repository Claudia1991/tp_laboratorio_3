import { AnuncioAutos } from '../models/AnuncioAuto.js';

/***/

//Variables
const listaAnuncios = JSON.parse(localStorage.getItem('listaAnuncios')) || [];

const tiempoDelay = 2000;
let contenedorTabla = null;
let formulario = null;
let tiposTransacciones = [];
let imagenPreview = null;
let imagenPreviewData = null;

//Init
window.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', handlerClick);

    document.getElementById('filtro').addEventListener('change', handlerSelect);
    
    document.getElementById('fotoAnuncio').addEventListener('change', handlerFiles);
    
    imagenPreview = document.getElementById('imagenPreview');
    
    contenedorTabla = document.getElementById('tablaAnuncios');

    renderizar(crearTabla(listaAnuncios), contenedorTabla);

    formulario = document.forms[0];

    formulario.addEventListener('submit', (e)=>{    e.preventDefault();});
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
        if (key !== 'id' && key !== 'imagen') {
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
            } else if(key !== 'imagen') {
                console.log(key)
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

function handlerSelect(e) {
    const filtro = document.getElementById('filtro').value;

    const anunciosFiltrados = obtenerAnunciosFiltradosTipoVenta(listaAnuncios, filtro);

    const preciosAnunciosFiltrados = obtenerPreciosAnuncios(anunciosFiltrados);

    document.getElementById('promedio').value = obtenerPromedioPrecios(preciosAnunciosFiltrados).toFixed(2);

    renderizar(crearTabla(anunciosFiltrados), contenedorTabla);
}

function handlerFiles(e){
    if(e.target.files && e.target.files[0]){
        crearPreviaImagen(e.target.files[0]);
    } 
}

function handlerClick(e) {
    if (e.target.matches('td')) {
        formulario.reset();

        const idElementoSeleccionado = e.target.parentNode.dataset.id;

        cargarElementoFormulario(idElementoSeleccionado);

    } else if (e.target.matches('#btnFormulario')) {
        if(validarFormularioCompleto(formulario)){

            if (!formulario.id.value) {
                console.log('Crear nuevo.')
                const dateNow = new Date();
                const anuncio = crearAuncio(dateNow.getTime(), formulario);
    
                habilitarAlertaCustom(1);
                setTimeout(() => {
                    /** Cargo a la lista */
                    listaAnuncios.push(anuncio);
                    /** Renderizo la tabla */
                    renderizar(crearTabla(listaAnuncios), contenedorTabla);
                    /** Guardo la info */
                    localStorage.setItem('listaAnuncios', JSON.stringify(listaAnuncios))
                    /** Limpiar formulario */
                    formulario.reset();
                    /** Limpio el array temporal */
                    limpiarImagenPrevia();
                    tiposTransacciones = [];
                    /** Oculto el mensaje custom */
                    document.getElementById('espinner').style.display = 'none';
                }, tiempoDelay);
    
            } else {
                console.log('/** Modifico el anuncio */');
                const anuncio = crearAuncio(formulario.id.value, formulario);
                /** Habilito el spinner magico */
                habilitarAlertaCustom(2)
                setTimeout(() => {
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
                    document.getElementById('btnFormulario').lastChild.innerText = 'Agregar';
                    /** Limpio el array temporal */
                    limpiarImagenPrevia();
                    tiposTransacciones = [];
                    /** Oculto el mensaje custom */
                    document.getElementById('espinner').style.display = 'none';
                }, tiempoDelay);
            }
        }else{
            return;
        }
    } else if (e.target.matches('#btnEliminar')) {
        if (confirm("¿Esta seguro que desea eliminar?")) {
            /** Muestro el mensaje custon por pantalla */
            habilitarAlertaCustom(3)
            setTimeout(() => {
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
                document.getElementById('btnEliminar').style.display = 'none';
                /** Cambio el value del formulario, ya que podria modificar el elemento */
                document.getElementById('btnFormulario').lastChild.innerText = 'Agregar';
                /** Limpio el array temporal */
                limpiarImagenPrevia();
                tiposTransacciones = [];
                /** Oculto el mensaje custom */
                document.getElementById('espinner').style.display = 'none';
            }, tiempoDelay);
        } else {
            alert('Acción cancelada.');
        }
    } else if(e.target.matches("[name='transaccion']")) {
        const valueCheckBox = e.srcElement.defaultValue;
        const checkBox = document.querySelector("[name='transaccion'][value='" + valueCheckBox + "']");
        /** Agrego el value a un array temporal, para luego realizar la carga */
        if (checkBox.checked) {
            /** Agrego el tipo de transaccion */
            tiposTransacciones.push(valueCheckBox)
        } else {
            /** Saco el tipo de transaccion */
            tiposTransacciones.splice(tiposTransacciones.indexOf(valueCheckBox), 1);
        }
    }else if (e.target.matches('#btnCerrarMensajeInformativo')){
        document.getElementById('mensajeInformativo').removeChild(document.querySelector('#mensajeInformativo').lastElementChild);
        document.getElementById('tablaAnuncios').style.display = 'block';
        document.getElementById('mensajeInformativo').style.display = 'none'; 
    }else{
        return;
    }
}

function habilitarAlertaCustom(tipoMensaje){
    document.getElementById('mensajeInformativo').appendChild(crearMensaje(tipoMensaje));
    document.getElementById('espinner').style.display = 'block';
    document.getElementById('tablaAnuncios').style.display = 'none';
    document.getElementById('mensajeInformativo').style.visibility = 'visible';
}

function cargarElementoFormulario(idElemento) {
    /** obtengo el elemento del array */
    const elementoSeleccionado = listaAnuncios.find(e => e.id == idElemento);
    /** Cargo los datos en el formulario */
    formulario.id.value = elementoSeleccionado.id;
    formulario.titulo.value = elementoSeleccionado.titulo;
    cargarTiposTransaccion(elementoSeleccionado.transaccion);
    formulario.descripcion.value = elementoSeleccionado.descripcion;
    formulario.precio.value = elementoSeleccionado.precio;
    formulario.puertas.value = elementoSeleccionado.puertas;
    formulario.km.value = elementoSeleccionado.km;
    formulario.potencia.value = elementoSeleccionado.potencia;
    if(elementoSeleccionado.imagen){
        imagenPreview.setAttribute('src', elementoSeleccionado.imagen);
        imagenPreview.style.visibility = 'visible';
    }else{
        imagenPreview.setAttribute('src', '');
        imagenPreview.style.visibility = 'hidden';
    }
    /** Habilito el boton de Eliminar */
    document.getElementById('btnEliminar').style.display = 'block';
    /** Cambio el value del formulario, ya que podria modificar el elemento */
    document.getElementById('btnFormulario').lastChild.innerText = 'Modificar';
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
    return new AnuncioAutos(id, titulo, transaccion, descripcion, precio, potencia, km, puertas,imagenPreviewData );
}

const crearMensaje = (tipoMensaje) => {
    let mensaje = '';
    switch (tipoMensaje) {
        case 1:
            mensaje = 'Se dió de alta el anuncio.';
            break;
        case 2:
            mensaje = 'Se modificó  el anuncio';
            break;
        case 3:
            mensaje = 'Se eliminó el anuncio.';
            break;
    }
    const p = document.createElement('p');
    p.innerText = mensaje;
    return p;
}

const limpiarImagenPrevia = () => {
    imagenPreview.setAttribute('src', '');
    imagenPreview.style.visibility = 'hidden';
}

const crearPreviaImagen = (file) => {
    const reader = new FileReader();
    limpiarImagenPrevia();
    reader.onload = (arg) => {
        imagenPreview.setAttribute('src', reader.result);
        imagenPreviewData = reader.result;
    }
    reader.readAsDataURL(file);
    imagenPreview.style.visibility = 'visible';
}

const validarFormularioCompleto = (formulario) => {
    const esFormularioValido = formulario.titulo.value && formulario.descripcion.value && formulario.precio.value && 
    formulario.puertas.value &&    formulario.km.value &&    formulario.potencia.value ;
    console.log(esFormularioValido);
    return esFormularioValido;
}

/** Filtros */
/** Map - Reduce - Filter */
const obtenerPromedioPrecios = (arrayPreciosAnuncios) => {
    /**Reduce para obtener la sumatoria del array de precios */
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