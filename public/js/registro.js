const iniciar_registro = () => {
    const nombre = $("#nombre").val().trim();
    const apellido = $("#apellido").val().trim();
    const usuario = $("#usuario").val().trim();
    const password = $("#password").val().trim();
    
    if (!nombre || !apellido || !usuario || !password) {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Todos los campos son obligatorios.'
        });
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(usuario)) {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Por favor ingresa un correo electrónico válido.'
        });
        return;
    }

    if (password.length < 8) {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'La contraseña debe tener al menos 8 caracteres.'
        });
        return;
    }

    let data = new FormData();
    data.append("nombre", nombre);
    data.append("apellido", apellido);
    data.append("usuario", usuario);
    data.append("password", password);
    data.append("metodo", "iniciar_registro");

    fetch("./app/controller/Registro.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if (respuesta[0] == 1) {
            Swal.fire({
                icon: 'success',
                title: '¡Registro exitoso!',
                text: respuesta[1]
            }).then(() => {
                window.location = "login";
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: respuesta[1]
            });
        }
    });
}

$("#btn_registro").on('click', () => {
    iniciar_registro();
});
