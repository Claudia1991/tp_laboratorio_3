import {Animal} from './animal.js';

function Mascota(nombre, edad, tipo, vacunada = false){
    Animal.call(this, tipo, edad);
    let _nombre = nombre;
    this.vacunada = vacunada;

    //Getter
    this.getNombre = function(){
        return _nombre;
    }
    //Setter
    this.setNombre = function (value){
        _nombre = value;
    }
}

Mascota.prototype.informarHambre = function(){
    console.log(`${this.getNombre()} tiene hambre.`);
}

Mascota.prototype.presentarse = function()
{
    let mensaje = Animal.prototype.presentarse.call(this);
    return mensaje + " y me llamo " + this.getNombre();
}

export {Mascota};