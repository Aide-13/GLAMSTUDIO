function mostrarModal() {
  Swal.fire({
    title: '¿Estás seguro que deseas cerrar sesión?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#c08e22',
    cancelButtonColor: '#888484'
  }).then((result) => {
    if (result.isConfirmed) {
      cerrarSesion();
    }
  });
}

function cerrarSesion() {
  window.location.href = "logout.php";
}