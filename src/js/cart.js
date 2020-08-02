class Product {
    constructor(id, nombre, precio) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio
        this.cantidad = 1;
    }
};


//const p = new Rectangle()

//const products = [];

class Carrito {

    constructor(){
        this.productos_count = 0;
        this.productos = [];
    }

    AgregarProducto(id, nombre, precio) {
        //productos.id === 'id';
        const prod = this.productos.find(pro => pro.id === id);
        if(prod != undefined) {
            prod.cantidad++;
        }
        else {
            const prod_nuevo = new Product(id, nombre, precio);
            this.productos.push(prod_nuevo);
        }
        
        this.productos_count++;
    }

    GenerarMensaje() {
        let mensaje = "Hola,%20Home%20Basic!%20Quiero%20pedir:%0A";
        let total = 0;
        for(var i = 0; i < this.productos.length; i++) {
            mensaje += this.productos[i].cantidad + "%20x%20" + this.productos[i].nombre.replace(" ", "%20") + "%20(" + this.productos[i].id + ")%20" + "%20a%20$";
            mensaje += this.productos[i].precio + ":%20$" + this.productos[i].precio * this.productos[i].cantidad + "%0A";
            total += this.productos[i].precio * this.productos[i].cantidad
        }

        mensaje += "%0A";
        mensaje += "Total:%20$" + total + ".";
        mensaje += "%0A";
        mensaje += "Pedido%20desde%20el%20catalogo%20online.";
    
        return mensaje;
        
    }

    MostrarContenido() {
        let contenido = "";
        let total = 0;
        for(var i = 0; i < this.productos.length; i++) {
            contenido += this.productos[i].cantidad + " x <strong>" + this.productos[i].nombre + "</strong> (" + this.productos[i].id + ") " + " a $";
            contenido += this.productos[i].precio + ": <strong>$" + this.productos[i].precio * this.productos[i].cantidad + "</strong>.<br>";
            total += this.productos[i].precio * this.productos[i].cantidad
        }

        contenido += "<br><strong>Total: $" + total + "</strong>";

        return contenido;
    }

    VaciarCarrito() {
        this.productos = [];
        this.productos_count = 0;
    }

};

var carro = new Carrito();