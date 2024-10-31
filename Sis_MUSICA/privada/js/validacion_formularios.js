"use strict";

// Configuración de validación para cada formulario
const validaciones = {
    persona: {
        fields: ['nombres', 'ap', 'am', 'ci', 'direccion', 'telefono', 'genero'],
        rules: {
            ci: { required: true },
            ap: { required: false, pattern: /^[A-Za-z]+$/ },
            am: { required: false, pattern: /^[A-Za-z]+$/ },
            nombres: { required: true, pattern: /^[A-Za-z]+$/ },
            direccion: { required: true },
            telefono: { required: true },
            genero: { required: true }
        }
    },
    cancionNuevo: {
        fields: ['nombre', 'anio_lanza', 'id_albun', 'id_genero'],
        rules: {
            nombre: { required: true, pattern: /\.(mp3|wav)$/i }, // Obligatorio para nuevo
            anio_lanza: { required: true },
            id_albun: { required: true },
            id_genero: { required: true }
        }
    },
    cancionModificar: {
        fields: ['nombre', 'anio_lanza', 'id_albun', 'id_genero'],
        rules: {
            nombre: { required: false, pattern: /\.(mp3|wav)$/i }, // Opcional para modificar
            anio_lanza: { required: true },
            id_albun: { required: true },
            id_genero: { required: true }
        }
    },
    valoracion: {
        fields: ['id_usuario_visita', 'id_cancion', 'valoracion', 'comentario'],
        rules: {
            id_usuario_visita: { required: true },
            id_cancion: { required: true },
            valoracion: { required: true },
            comentario: { required: true }
        }
    },
    listaReproduccion: {
        fields: ['id_usuario_visita', 'nombre', 'fec_creacion'],
        rules: {
            id_usuario_visita: { required: true },
            nombre: { required: true, pattern: /^[A-Za-z ]+$/ },
            fec_creacion: { required: true }
        }
    },
    usuario: {
        fields: ['nom_usuario'],
        rules: {
            nom_usuario: { required: true }
        }
    },
    instrumento: {
        fields: ['nombre', 'tipo', 'descripcion'],
        rules: {
            nombre: { required: true, pattern: /^[A-Za-z ]+$/ },
            tipo: { required: true, pattern: /^[A-Za-z ]+$/ },
            descripcion: { required: false, pattern: /^[A-Za-z ]+$/ }
        }
    },
    usuarioPrincipal: { 
        fields: ['usuario_principal', 'clave', 'id_persona'],
        rules: {
            usuario_principal: { required: true },
            clave: { required: true },
            id_persona: { required: true }
        }
    }
};

// Función principal de validación
function validar() {
    // Determinar el formulario que se está enviando
    let formType;
    if (document.formu.ci) formType = 'persona';
    else if (document.formu.usuario_principal) formType = 'usuarioPrincipal';
    else if (document.formu.nombre && document.formu.anio_lanza) {
        formType = document.formu.id_cancion ? 'cancionModificar' : 'cancionNuevo'; // Determina si es nuevo o modificar
    }
    else if (document.formu.id_usuario_visita && document.formu.valoracion) formType = 'valoracion';
    else if (document.formu.nombre && document.formu.fec_creacion) formType = 'listaReproduccion';
    else if (document.formu.nom_usuario) formType = 'usuario';
    else if (document.formu.tipo && document.formu.descripcion) formType = 'instrumento';

    if (!formType) return;

    // Validar el formulario según el tipo
    validateForm(formType);
}


// Función de validación general
function validateForm(formType) {
    const { fields, rules } = validaciones[formType];
    let isValid = true;

    limpiarErrores();

    fields.forEach(field => {
        const value = document.formu[field].value.trim();
        const rule = rules[field];

        // Validación específica para el campo de archivo de música
        if (field === "nombre") {
            if (formType === 'cancionModificar' && value === "" && !document.formu.nombre.files.length) {
                mostrarExito(field, "ya selecciono un archivo");
                isValid = true;
            } else if (formType === 'cancionNuevo' && !value && !document.formu.nombre.files.length) {
                mostrarError(field, "El campo 'Archivo de Música' es obligatorio.");
                isValid = false;
            } else if (value && !rule.pattern.test(value)) {
                mostrarError(field, "Debe seleccionar un archivo de música válido (.mp3, .wav)");
                isValid = false;
            }
        }

        if (rule.required && value === "") {
            mostrarError(field, `El campo ${field} es obligatorio`);
            isValid = false;
        } else if (!rule.required && value !== "" && rule.pattern && !rule.pattern.test(value)) {
            mostrarError(field, `El campo ${field} es incorrecto`);
            isValid = false;
        } else if (rule.required && rule.pattern && !rule.pattern.test(value)) {
            mostrarError(field, `El campo ${field} es incorrecto`);
            isValid = false;
        } else {
            mostrarExito(field);
        }
    });

    if (isValid) document.formu.submit();
}


// Función para limpiar errores e iconos previos
function limpiarErrores() {
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('.input-icon').forEach(el => el.remove());
    document.querySelectorAll('input, select').forEach(el => el.classList.remove('input-error', 'input-success'));
}

function mostrarError(campoId, mensaje) {
    const campo = document.getElementById(campoId);
    campo.classList.add('input-error');

    const error = document.createElement('div');
    error.className = 'error-message';
    error.textContent = mensaje;

    const icono = document.createElement('span');
    icono.className = 'input-icon error-icon';
    campo.parentNode.appendChild(icono);

    campo.parentNode.appendChild(error);
}

function mostrarExito(campoId) {
    const campo = document.getElementById(campoId);
    campo.classList.add('input-success');

    const icono = document.createElement('span');
    icono.className = 'input-icon success-icon';
    campo.parentNode.appendChild(icono);
}
