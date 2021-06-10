export class AnuncioBienesRaices{
    constructor(id, titulo, transaccion, descripcion, precio, numeroBanios, numeroEstacionamiento, numeroDormitorios){
        this.titulo = titulo;
        this.transaccion = transaccion;
        this.descripcion = descripcion;
        this.precio = precio;
        this.numeroBanios = numeroBanios;
        this.numeroEstacionamiento = numeroEstacionamiento;
        this.numeroDormitorios = numeroDormitorios;
        this.id = id;
    }
    // saludar(){
    //     return `Hola, me llamo ${this._nombre} y tengo ${this._edad} años.` ;
    // }
}