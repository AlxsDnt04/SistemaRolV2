function mostrarAlertaSwal(tipo) {
  let config = {
    icon: "success",
    showConfirmButton: false,
    timer: 1800,
    position: "top-end",
    toast: true,
  };

  if (tipo === "1") {
    config.title = "¡Procedimiento exitoso!";
  } else if (tipo === "2") {
    config.title = "¡Eliminación exitosa!";
  } else if (tipo === "3") {
    config.title = "¡No hubo ningun cambio!";
  } else if (tipo === "error=1") {
    config.icon = "error";
    config.title = "¡Ha ocurrido un error!";
  } else if (tipo === "error=2") {
    config.icon = "error";
    config.title = "¡Usuario o contraseña incorrecto!";
  } else if (tipo === "error=empleado_con_roles") {
    config.icon = "error";
    config.title = "¡No se puede eliminar un empleado con roles o usuario asociado, Primero elimine la asociación!";
  } else {
    config.icon = "error";
    config.title = "¡Ha ocurrido un error desconocido!";
  }
  Swal.fire(config);
}
