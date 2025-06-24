function mostrarAlertaSwal(tipo) {
  let config = {
    icon: 'success',
    showConfirmButton: false,
    timer: 1800,
    position: 'top-end',
    toast: true,
  };

  if (tipo === '1') {
    config.title = '¡Procedimiento exitoso!';
  } else if (tipo === '2') {
    config.title = '¡Eliminación exitosa!';
    } else if (tipo === 'error=1') {
    config.icon = 'error';
    config.title = '¡Ha ocurrido un error!';
    } else if (tipo === 'error=2') {
    config.icon = 'error';
    config.title = '¡Usuario o contraseña incorrecto!';
    } else {
    return;
  }

  Swal.fire(config);
}

