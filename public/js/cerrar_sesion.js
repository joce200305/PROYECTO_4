const cerrar_sesion = () => {
    let data = new FormData();
    data.append("metodo", "cerrar_sesion");

    fetch("./app/controller/Login.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        // Mostrar SweetAlert con el mensaje de la respuesta
        Swal.fire({
            title: '¡Hasta luego!',
            text: respuesta[1],
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir después de que el usuario haga clic en "Aceptar"
            window.location = "login";
        });
    });
}

$("#btn_cerrar").on('click', () => {
    cerrar_sesion();
});