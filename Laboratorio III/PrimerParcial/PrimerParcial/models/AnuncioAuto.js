import { Anuncio } from "./Anuncio.js";

export class AnuncioAutos extends Anuncio{
    constructor(id,titulo, transaccion, descripcion, precio, potencia, km, puertas){
        super(id, titulo, transaccion, descripcion, precio);
        this.potencia = potencia;
        this.km = km;
        this.puertas = puertas;
    }
}