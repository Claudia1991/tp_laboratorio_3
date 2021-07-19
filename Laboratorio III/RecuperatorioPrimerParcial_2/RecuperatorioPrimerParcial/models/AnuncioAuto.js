import { Anuncio } from "./Anuncio.js";

export class AnuncioAutos extends Anuncio{
    constructor(id,titulo, transaccion, descripcion, precio, potencia, km, puertas, imagen){
        super(id, titulo, transaccion, descripcion, precio, imagen);
        this.potencia = potencia;
        this.km = km;
        this.puertas = puertas;
    }
}