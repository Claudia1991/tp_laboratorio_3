export class AnuncioBienesRaices{
    constructor(titulo, transaccion, descripcion, precio, numeroBanios, numeroEstacionamiento, numeroDormitorios){
        this.titulo = titulo;
        this.transaccion = transaccion;
        this.descripcion = descripcion;
        this.precio = precio;
        this.numeroBanios = numeroBanios;
        this.numeroEstacionamiento = numeroEstacionamiento;
        this.numeroDormitorios = numeroDormitorios;
    }

    set id(value){
        this.id = value;
    }
}