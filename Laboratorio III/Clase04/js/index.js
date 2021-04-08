window.addEventListener('DOMContentLoaded', () => {

    console.log("Inicio");

    setTimeout(function () {
        console.log("Consolo log desde el set time out - 3 segundos");
    }, 3000);

    console.log("Fin");

    function buttonClick() {
        alert("Consolo log desde el click!");
    }
    let boton = document.getElementById('btnBoton');
    boton.addEventListener('click', buttonClick);

});