// Script para buscar usuario en input
document.getElementById('busquedaUsuario').addEventListener('keyup', function() {
  const filtro = this.value.toLowerCase();
  const filas = document.querySelectorAll('table tbody tr');
  filas.forEach(fila => {
    const usuario = fila.cells[0]?.textContent.toLowerCase() || '';
    if (usuario.includes(filtro)) {
      fila.style.display = '';
    } else {
      fila.style.display = 'none';
    }
  });
});
