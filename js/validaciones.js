document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formRegistro');
    if (!form) {
        return;
    }

    form.addEventListener('submit', function (e) {
        const correo = form.querySelector('[name="correo"]');
        const pass = form.querySelector('[name="contrasena"]');
        const confirmar = form.querySelector('[name="confirmar"]');

        if (!correo.value.includes('@')) {
            e.preventDefault();
            alert('Ingresa un correo válido.');
            return;
        }

        if (pass.value.length < 6) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 6 caracteres.');
            return;
        }

        if (pass.value !== confirmar.value) {
            e.preventDefault();
            alert('Las contraseñas no coinciden.');
        }
    });
});
