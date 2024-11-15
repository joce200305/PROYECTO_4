document.getElementById('form_editar_usuario').addEventListener('submit', function (e) {
    e.preventDefault();

    let nombre = document.getElementById('nombre').value;
    let apellido = document.getElementById('apellido').value;
    let usuario = document.getElementById('usuario').value;

    
    if (!nombre || !apellido || !usuario) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor complete todos los campos obligatorios.'
        });
        return; 
    }

    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('apellido', apellido);
    formData.append('usuario', usuario);
    formData.append('metodo', 'editar_usuario'); 

    
    fetch("./app/controller/editar-usuario.php", {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => {
          if (data[0] == 1) {
              Swal.fire({
                  icon: 'success',
                  title: 'Éxito',
                  text: 'Datos actualizados correctamente.'
              });
              
          } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Error al actualizar los datos: ' + data[1]
              });
          }
      })
      .catch(error => {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al enviar la solicitud: ' + error
          });
      });
});