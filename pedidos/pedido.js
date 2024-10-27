// Función para agregar nuevos productos
function agregarProducto() {
    const container = document.getElementById('productosContainer');
    const template = document.getElementById('productoTemplate').innerHTML;
    container.insertAdjacentHTML('beforeend', template);
    actualizarTotal(); // Actualiza el total después de agregar un nuevo producto
}

// Función para eliminar la fila del producto
function eliminarProducto(button) {
    const row = button.closest('.producto-row'); // Encuentra la fila más cercana
    row.remove(); // Elimina la fila del DOM
    actualizarTotal(); // Actualiza el total después de eliminar un producto
}

// Función para actualizar el total del pedido
function actualizarTotal() {
    let total = 0;

    // Selecciona todos los productos y cantidades
    const productos = document.querySelectorAll('select[name="txtProductos[]"]');
    const cantidades = document.querySelectorAll('input[name="cantidades[]"]');

    // Recorre cada producto seleccionado
    productos.forEach((producto, index) => {
        const precio = parseFloat(producto.options[producto.selectedIndex].dataset.precio) || 0;
        const cantidad = parseFloat(cantidades[index].value) || 0;

        // Suma al total el precio multiplicado por la cantidad
        total += precio * cantidad;
    });

    // Actualiza el total en el input de total
    document.getElementById('txtTotal').value = total.toFixed(2); // Muestra dos decimales
}
