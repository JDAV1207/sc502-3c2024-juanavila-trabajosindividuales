const productosJSON = `[
    { "nombre": "PC", "categoria": "Electrónica", "precio": 300000 },
    { "nombre": "TV", "categoria": "Electrónica", "precio": 250000 },
    { "nombre": "Silla", "categoria": "Muebles", "precio": 50000 },
    { "nombre": "Cama", "categoria": "Muebles", "precio": 150000 },
    { "nombre": "PS5", "categoria": "Electrónica", "precio": 450000 },
    { "nombre": "Manzana", "categoria": "Comida", "precio": 1500 },
    { "nombre": "Uvas", "categoria": "Comida", "precio": 2000 }
]`;

const productos = JSON.parse(productosJSON);

function mostrarProductos(filtroCategoria = '') {
    let resultado = '<table border="1"><tr><th>Nombre</th><th>Categoría</th><th>Precio</th></tr>';

    productos.forEach((producto) => {
        if (filtroCategoria === '' || producto.categoria === filtroCategoria) {
            resultado += `<tr>
                <td>${producto.nombre}</td>
                <td>${producto.categoria}</td>
                <td>${producto.precio}</td>
            </tr>`;
        }
    });

    resultado += '</table>';

    document.getElementById('listaProductos').innerHTML = resultado;
}

mostrarProductos();

document.getElementById('filtrarCategoria').addEventListener('change', function() {
    mostrarProductos(this.value);
});