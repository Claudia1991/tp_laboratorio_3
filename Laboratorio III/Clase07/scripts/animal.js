function Animal(tipo, edad){
    let _tipo = tipo;
    this.edad = edad;
    //Getter
    this.getTipo = function(){
        return _tipo;
    }
    //Setter
    this.setTipo = function(value){
        _tipo = value;
    }
}

Animal.prototype.presentarse = function(){
    return `Soy un Animal de tipo ${this.getTipo()}.`;
}

export {Animal};