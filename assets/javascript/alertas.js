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
  } else if (tipo === "empleado_con_roles") {
    config.icon = "error";
    config.timer = 6000;
    config.title = "¡No se puede eliminar un empleado con roles o usuario asociado, Primero elimine la asociación!";
    config.position = "top-end";
    config.showConfirmButton = true;
  } else if (tipo === "usuario_existente") {
    config.icon = "error";
    config.timer = 4000;
    config.title = "¡El usuario ya está registrado. Por favor, elige otro.!";
  } else if (tipo === "cedula_existente") {
    config.icon = "error";
    config.title = "¡La cédula ya está registrada.!";
    config.timer = 4000;
  } else {
    config.icon = "error";
    config.title = "¡Ha ocurrido un error desconocido!";
  }
  Swal.fire(config);
}

