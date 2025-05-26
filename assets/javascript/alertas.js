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
  } else {
    return;
  }

  Swal.fire(config);
}
