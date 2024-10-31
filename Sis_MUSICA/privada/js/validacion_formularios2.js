"use strict";

function validar() {
    // Determinar el formulario que se está enviando
    if (document.formu.ci) {
        validarPersona();
    } else if (document.formu.nombre && document.formu.duracion) {
        validarCancion();
    } else if (document.formu.id_usuario_visita && document.formu.valoracion) {
        validarValoracion();
    } else if (document.formu.nombre && document.formu.fec_creacion) {
        validarListaReproduccion();
    } else if (document.formu.nom_usuario) {
        validarUsuario();
    } else if (document.formu.tipo && document.formu.descripcion) {
        validarInstrumento();
    }
}

function validarPersona() {
    // Obtener los valores de los campos
    var nombres = document.formu.nombres.value.trim();
    var ap = document.formu.ap.value.trim();
    var am = document.formu.am.value.trim();
    var ci = document.formu.ci.value.trim();
    var direccion = document.formu.direccion.value.trim();
    var telefono = document.formu.telefono.value.trim();
    var genero = document.formu.genero.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar CI
    if (ci === "") {
        mostrarError('ci', 'El CI es obligatorio');
        isValid = false;
    } else {
        mostrarExito('ci');
    }

    // Validar Apellido
    if (am === "" && ap === "") {
        mostrarError('ap', 'Uno de los apellidos debe ser llenado');
        isValid = false;
    } else {
        if (ap !== "" && !v1.test(ap)) {
            mostrarError('ap', 'El apellido paterno es incorrecto');
            isValid = false;
        } else {
            mostrarExito('ap');
        }
        if (am !== "" && !v1.test(am)) {
            mostrarError('am', 'El apellido materno es incorrecto');
            isValid = false;
        } else {
            mostrarExito('am');
        }
    }

    // Validar Nombres
    if (!v1.test(nombres)) {
        mostrarError('nombres', 'El nombre es incorrecto o el campo está vacío');
        isValid = false;
    } else {
        mostrarExito('nombres');
    }

    // Validar Dirección
    if (direccion === "") {
        mostrarError('direccion', 'La dirección es obligatoria');
        isValid = false;
    } else {
        mostrarExito('direccion');
    }

    // Validar Teléfono
    if (telefono === "") {
        mostrarError('telefono', 'El teléfono es obligatorio');
        isValid = false;
    } else {
        mostrarExito('telefono');
    }

    // Validar Género
    if (genero === "") {
        mostrarError('genero', 'El género es obligatorio');
        isValid = false;
    } else {
        mostrarExito('genero');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

function validarCancion() {
    // Obtener los valores de los campos
    var nombre = document.formu.nombre.value.trim();
    var duracion = document.formu.duracion.value.trim();
    var anio_lanza = document.formu.anio_lanza.value.trim();
    var id_albun = document.formu.id_albun.value.trim();
    var id_genero = document.formu.id_genero.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar Nombre
    if (!v1.test(nombre)) {
        mostrarError('nombre', 'El nombre de la canción es obligatorio');
        isValid = false;
    } else {
        mostrarExito('nombre');
    }

    // Validar Duración
    if (duracion === "" || duracion === "00:00") {
        mostrarError('duracion', 'La duración es obligatoria');
        isValid = false;
    } else {
        mostrarExito('duracion');
    }

    // Validar Año Lanzamiento
    if (anio_lanza === "") {
        mostrarError('anio_lanza', 'El año de lanzamiento es obligatorio');
        isValid = false;
    } else {
        mostrarExito('anio_lanza');
    }

    // Validar Álbum
    if (id_albun === "") {
        mostrarError('id_albun', 'El álbum es obligatorio');
        isValid = false;
    } else {
        mostrarExito('id_albun');
    }

    // Validar Género
    if (id_genero === "") {
        mostrarError('id_genero', 'El género es obligatorio');
        isValid = false;
    } else {
        mostrarExito('id_genero');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

function validarValoracion() {
    // Obtener los valores de los campos
    var id_usuario_visita = document.formu.id_usuario_visita.value.trim();
    var id_cancion = document.formu.id_cancion.value.trim();
    var valoracion = document.formu.valoracion.value.trim();
    var comentario = document.formu.comentario.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar Usuario de Visita
    if (id_usuario_visita === "") {
        mostrarError('id_usuario_visita', 'Debe seleccionar un usuario');
        isValid = false;
    } else {
        mostrarExito('id_usuario_visita');
    }

    // Validar Canción
    if (id_cancion === "") {
        mostrarError('id_cancion', 'Debe seleccionar una canción');
        isValid = false;
    } else {
        mostrarExito('id_cancion');
    }

    // Validar Valoración
    if (valoracion === "") {
        mostrarError('valoracion', 'Debe seleccionar una valoración');
        isValid = false;
    } else {
        mostrarExito('valoracion');
    }

    // Validar Comentario
    if (comentario === "") {
        mostrarError('comentario', 'El comentario es obligatorio');
        isValid = false;
    } else {
        mostrarExito('comentario');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

function validarListaReproduccion() {
    // Obtener los valores de los campos
    var id_usuario_visita = document.formu.id_usuario_visita.value.trim();
    var nombre = document.formu.nombre.value.trim();
    var fec_creacion = document.formu.fec_creacion.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar Usuario de Visita
    if (id_usuario_visita === "") {
        mostrarError('id_usuario_visita', 'Debe seleccionar un usuario');
        isValid = false;
    } else {
        mostrarExito('id_usuario_visita');
    }

    // Validar Nombre de la Lista de Reproducción
    if (!v1.test(nombre)) {
        mostrarError('nombre', 'El nombre es incorrecto o el campo está vacío');
        isValid = false;
    } else {
        mostrarExito('nombre');
    }

    // Validar Fecha de Creación
    if (fec_creacion === "") {
        mostrarError('fec_creacion', 'Debe seleccionar una fecha de creación');
        isValid = false;
    } else {
        mostrarExito('fec_creacion');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

function validarUsuario() {
    // Obtener los valores de los campos
    var nom_usuario = document.formu.nom_usuario.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar Nombre de Usuario
    if (nom_usuario === "") {
        mostrarError('nom_usuario', 'Falta llenar el nombre de usuario');
        isValid = false;
    } else {
        mostrarExito('nom_usuario');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

function validarInstrumento() {
    // Obtener los valores de los campos
    var nombre = document.formu.nombre.value.trim();
    var tipo = document.formu.tipo.value.trim();
    var descripcion = document.formu.descripcion.value.trim();

    // Inicializar la variable de validación
    var isValid = true;

    // Limpiar mensajes previos de error e iconos
    limpiarErrores();

    // Validar Nombre
    if (!v1.test(nombre)) {
        mostrarError('nombre', 'El nombre es incorrecto o el campo está vacío');
        isValid = false;
    } else {
        mostrarExito('nombre');
    }

    // Validar Tipo
    if (!v1.test(tipo)) {
        mostrarError('tipo', 'El tipo es incorrecto o el campo está vacío');
        isValid = false;
    } else {
        mostrarExito('tipo');
    }

    // Validar Descripción
    if (descripcion !== "" && !v1.test(descripcion)) {
        mostrarError('descripcion', 'La descripción es incorrecta');
        isValid = false;
    } else {
        mostrarExito('descripcion');
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        document.formu.submit();
    }
}

// Función para limpiar errores e iconos previos
function limpiarErrores() {
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('.input-icon').forEach(el => el.remove());
    document.querySelectorAll('input, select').forEach(el => el.classList.remove('input-error', 'input-success'));
}

function mostrarError(campoId, mensaje) {
    var campo = document.getElementById(campoId);
    campo.classList.add('input-error');

    var error = document.createElement('div');
    error.className = 'error-message';
    error.textContent = mensaje;

    var icono = document.createElement('span');
    icono.className = 'input-icon error-icon';
    campo.parentNode.appendChild(icono);

    campo.parentNode.appendChild(error);
}

function mostrarExito(campoId) {
    var campo = document.getElementById(campoId);
    campo.classList.add('input-success');

    var icono = document.createElement('span');
    icono.className = 'input-icon success-icon';
    campo.parentNode.appendChild(icono);
}
