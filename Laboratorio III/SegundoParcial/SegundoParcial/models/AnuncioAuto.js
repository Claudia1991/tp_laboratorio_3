import { Anuncio } from "./Anuncio.js";

export class AnuncioAutos extends Anuncio{
    constructor(titulo, transaccion, descripcion, precio, potencia, km, puertas){
        super(titulo, transaccion, descripcion, precio);
        this.potencia = potencia;
        this.km = km;
        this.puertas = puertas;
    }

    set id(value){
        this.id = value;
    }
}