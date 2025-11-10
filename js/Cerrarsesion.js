function mostrarModal() {
  Swal.fire({
    title: '¿Estás seguro que deseas cerrar sesión?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#2f2f78',
    cancelButtonColor: '#ff7317'
  }).then((result) => {
    if (result.isConfirmed) {
      cerrarSesion();
    }
  });
}

function cerrarSesion() {
  window.location.href = "logout.php"; 
}



