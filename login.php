<?php
// login.php
session_start();

// datos de ejemplo (puedes cargar desde BD si quieres)
$usuario_correcto = "admin";
$password_correcto = "12345";

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if ($usuario === $usuario_correcto && $password === $password_correcto) {
    $_SESSION['admin'] = $usuario;
    header("Location: app/View/citas.php");

    exit;
} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Usuario o contraseña incorrectos',
        confirmButtonText: 'Aceptar'
    }).then(function() {
        window.location = '/Iniciar_sesion.html';
    });
    </script>
    ";
}
