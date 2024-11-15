const mensaje_error = (msj) => {
  Swal.fire({
      title: "Error!",
      text: msj,
      icon: "warning",
      confirmButtonText: "Aceptar"
  });
};

const mensaje_exito = (msj) => {
  Swal.fire({
      title: "Correcto!",
      text: msj,
      icon: "success",
      confirmButtonText: "Aceptar"
  });
};

const iniciar_sesion = () => {
  let data = new FormData();
  data.append("usuario", $("#usuario").val());
  data.append("password", $("#password").val());
  data.append("metodo", "iniciar_sesion");
  
  fetch("./app/controller/Login.php", {
      method: "POST",
      body: data
  })
  .then(respuesta => respuesta.json())
  .then(respuesta => {
      if (respuesta[0] == 1) {
          mensaje_exito(respuesta[1]);
          setTimeout(() => {
              window.location = "inicio";
          }, 1500); // Espera un momento para que el mensaje se muestre antes de redirigir
      } else {
          mensaje_error(respuesta[1]);
      }
  });
};

$("#btn_iniciar").on('click', () => {
  iniciar_sesion();
});
