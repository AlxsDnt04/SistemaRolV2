//FUNCION PARA CALCULAR INGRESOS
function calcularIngreso() {
  const sueldo = parseFloat(document.getElementById("sueldo").value);
  const hora_25 = parseFloat(document.getElementById("hora25").value);
  const hora_50 = parseFloat(document.getElementById("hora50").value);
  const hora_100 = parseFloat(document.getElementById("hora100").value);
  const bonos = parseFloat(document.getElementById("bonos").value);

  const hora_normal = parseFloat((sueldo / 160).toFixed(2)); //hora normal
  const total_hora_25 = hora_normal * hora_25 * 1.25; //calculo al 25%
  document.getElementById("temp_total_25").value = total_hora_25.toFixed(2); // Mostrar el total al 25% en el campo correspondiente
  const total_hora_50 = hora_normal * hora_50 * 1.5; //calculos al 50%
  document.getElementById("temp_total_50").value = total_hora_50.toFixed(2); // Mostrar el total al 50% en el campo correspondiente
  const total_hora_100 = hora_normal * hora_100 * 2; //calculos al 100%
  document.getElementById("temp_total_100").value = total_hora_100.toFixed(2); // Mostrar el total al 100% en el campo correspondiente
  //calculo total (sueldo + bonos + hora25 + hora50 + hora100)
  const total_ingresos =
    sueldo + total_hora_25 + total_hora_50 + total_hora_100 + bonos;
  document.getElementById("temp_total_ingresos").value = total_ingresos.toFixed(2); // Mostrar el total de ingresos en el campo correspondiente
}
//FUNCION PARA CALCULAR EGRESOS
function calcularEgresos() {
  /* calculo IESS */
  const sueldo = parseFloat(document.getElementById("sueldo").value);
  const TotalIess = (sueldo * 0.45) / 100; // Calculo del IESS (4.5% del sueldo)
  document.getElementById("iess").value = TotalIess; // Mostrar el IESS en el campo correspondiente
  /* suma egresos */
  const multas = parseFloat(document.getElementById("multas").value);
  const atrasos = parseFloat(document.getElementById("atrasos").value);
  const alimentacion = parseFloat(
    document.getElementById("alimentacion").value
  );
  const anticipo = parseFloat(document.getElementById("anticipo").value);
  const otros = parseFloat(document.getElementById("otros").value);
  // Calcular el total de egresos
  const total_egresos =
    TotalIess + multas + atrasos + alimentacion + anticipo + otros;
  document.getElementById("totalEgresos").value = total_egresos; // Mostrar el total de egresos en el campo correspondiente
}
//FUNCION PARA CALCULAR EL NETO A PAGAR
function netoAPagar() {
  const total_ingresos = parseFloat(
    document.getElementById("temp_total_ingresos").value
  );
  const total_egresos = parseFloat(
    document.getElementById("totalEgresos").value
  );
  // Calcular el total a pagar
  const total_a_pagar = total_ingresos - total_egresos;
  document.getElementById("total_a_pagar").value = total_a_pagar; // Mostrar el total a pagar en el campo correspondiente
}

// Evento para el botón de calcular
document.getElementById("btnCalcular").addEventListener("click", () => {
  calcularIngreso();
  calcularEgresos();
  netoAPagar();
});
