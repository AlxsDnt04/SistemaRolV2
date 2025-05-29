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


Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
  }
});