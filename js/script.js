window.onload = function() {
    const cuerpoTabla = document.getElementById('tablaUsuarios').getElementsByTagName('tbody')[0];
    const entradaFiltro = document.getElementById('entradaFiltro');

    // Relleno de la tabla.
    function llenarTabla(datos) {
        cuerpoTabla.innerHTML = '';
        for (let i = 0; i < datos.length; i++) {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${datos[i].nombre}</td>
                <td>${datos[i].apellidos}</td>
                <td>${datos[i].telefono}</td>
                <td>${datos[i].email}</td>
                <td>${datos[i].sexo}</td>
                <td><button class="botonEliminar">X</button></td>
            `;
            cuerpoTabla.appendChild(fila);
        }
        const botonesEliminar = document.getElementsByClassName('botonEliminar');
        for (let i = 0; i < botonesEliminar.length; i++) {
            botonesEliminar[i].onclick = function() {
                this.parentElement.parentElement.remove();
            };
        }
    }

    // Filtrado.
    function filtrarTabla() {
        const textoFiltro = entradaFiltro.value.toLowerCase();
        if (textoFiltro.length < 3) {
            llenarTabla(usuarios);
            return;
        }

        const datosFiltrados = usuarios.filter(usuario =>
            usuario.nombre.toLowerCase().includes(textoFiltro) ||
            usuario.apellidos.toLowerCase().includes(textoFiltro)
        );

        llenarTabla(datosFiltrados);
    }

    llenarTabla(usuarios);
    entradaFiltro.oninput = filtrarTabla;
};