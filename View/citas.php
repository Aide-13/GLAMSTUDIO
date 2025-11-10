<?php
require_once __DIR__ . '/../controller/CitaController.php';
$controller = new CitaController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['guardar'])) {
        $controller->guardar($_POST);
    } elseif (isset($_POST['borrar'])) {
        $controller->eliminar($_POST['id']);
    }
}

$citas = $controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/Imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/Agenda.css">
    <title>Agenda de Citas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-primary  fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html"><img src="/Imagenes/logo.png" width="45px" alt=""></a>
        <button class="navbar-toggler text-light" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#navbarNav" 
        aria-controls="navbarNav" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto me-3 ">
            <li class="barra nav-item p-3"><a class="nav-link text-white" href="#">Agenda de Citas</a></li>
            <li class="barra nav-item p-3"><a class="nav-link text-white" href="#">Contenido</a></li>
          </ul>
          <button class=" btn btn-light nav-item" id="citas"> <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i></a></button>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row text-center pt-5 pb-2" style="background: #C6A04F;">
            <div class="col">
                <div class="col titulo px-5" >
                    <p class="m-0">GLAM STUDIO</p>
                </div>
                <div class="col subtitulo ">
                    <p>TU BELLEZA, NUESTRO ARTE</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 fuente">
      <div class="row d-flex justify-content-between flex-wrap ">
        <div class="col-auto fw-bold seccion">
          <p>Agenda de Citas</p>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-outline-dark"data-bs-toggle="modal" data-bs-target="#modalSolicitar">Agregar Nueva Cita</button>
        </div>
      </div>
    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre Completo</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $citas->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre'] . ' ' . $fila['apellidos']) ?></td>
                    <td><?= htmlspecialchars($fila['servicio']) ?></td>
                    <td><?= htmlspecialchars($fila['fecha']) ?></td>
                    <td><?= htmlspecialchars($fila['hora']) ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                            <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="bi bi-pencil"></i></button>
                            <button name="borrar" class="btn btn-sm btn-outline-dark"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" action="" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalles de la cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input class="form-control" type="text" name="nombre" id="nombre" readonly>
            </div>
            <div class="mb-3">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input class="form-control" type="text" name="apellidos" id="apellidos" readonly>
            </div>
            <div class="row mb-3">
              <label for="telefono" class="form-label">Telefono</label>
              <div class="col-2">
                <input class="form-control" type="text" value="+52" readonly>
              </div>
              <div class="col-10">
                <input class="form-control" type="tel" name="telefono" id="telefono" readonly>
              </div>
            </div>
            <div class="mb-3">
              <label for="servicio" class="form-label">Servicio de Interés</label>
              <select name="servicio" id="servicio" class="form-control">
                <option value="Selecciona motivo de tu cita">Selecciona motivo de tu cita</option>
                <option value="Extensiones de Cabello">Extensiones de Cabello</option>
                <option value="Uñas">Uñas</option>
                <option value="Pedicure">Pedicure</option>
                <option value="Diseño de Cejas">Diseño de Cejas</option>
                <option value="Extensionesde Pestañas">Extensiones de Pestañas</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Cuentanos los detalles para tu cita"></textarea>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control">
              </div>
              <div class="col-6">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" name="fecha" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="guardar" class="btn btn-light botones"><i class="bi bi-pencil text-black"></i> Modificar</button>
              <button type="button" class="btn btn-light botones" data-bs-dismiss="modal"> <i class="bi bi-trash text-black"></i>Borrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>


    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" action="" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Eliminar cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p>¿Seguro que deseas eliminar esta Cita?</p>
          </div>
          <div class="modal-footer">
            <button type="submit" name="borrar" class="btn btn-light botones">Eliminar</button>
            <button type="button" class="btn btn-light botones" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Consultar -->
    <div class="modal fade" id="modalConsultar" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Consultar Cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Nombre:</strong></p>
            <p><strong>Apellidos:</strong></p>
            <p><strong>Telefono:</strong></p>
            <p><strong>Servicio:</strong></p>
            <p><strong>Descripción:</strong></p>
            <p><strong>Fecha:</strong></p>
            <p><strong>Hora:</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light botones" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Agregar-->
    <div class="modal fade" id="modalSolicitar" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" action="" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalles de la cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input class="form-control" type="text" name="nombre" id="nombre" required>
            </div>
            <div class="mb-3">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input class="form-control" type="text" name="apellidos" id="apellidos" required>
            </div>
            <div class="row mb-3">
              <label for="telefono" class="form-label">Telefono</label>
              <div class="col-2">
                <input class="form-control" type="text" value="+52" readonly>
              </div>
              <div class="col-10">
                <input class="form-control" type="tel" name="telefono" id="telefono" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="servicio" class="form-label">Servicio de Interés</label>
              <select name="servicio" id="servicio" class="form-control">
                <option value="Selecciona motivo de tu cita">Selecciona motivo de tu cita</option>
                <option value="Extensiones de Cabello">Extensiones de Cabello</option>
                <option value="Uñas">Uñas</option>
                <option value="Pedicure">Pedicure</option>
                <option value="Diseño de Cejas">Diseño de Cejas</option>
                <option value="Extensionesde Pestañas">Extensiones de Pestañas</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Cuentanos los detalles para tu cita"></textarea>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control">
              </div>
              <div class="col-6">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" name="fecha" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="guardar" class="btn btn-light botones">Agregar</button>
              <button type="button" class="btn btn-light botones" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
      
    <footer class="mt-5 pt-4" style="background: #C6A04F;">
      <div class="container">
      
        <div class="text-center ">
          <p class="mb-2 fw-semibold">Todos los derechos son reservados</p>
        </div>

        <div class="d-flex justify-content-evenly flex-wrap">
          
          <div class="col-auto">
            <img src="/Imagenes/logo_lg.png" alt="logo" width="100px">
            <a href="#" class="text-decoration-none text-black fw-bold">J&G GLAMSTUDIO</a>
          </div>
          
          <div class="vr d-none d-md-block" style="height: 100px;"></div>
          
          <div class="col-auto text-center">
            <div class="col">
              <a href="#" class="text-decoration-none text-black"><p class="mb-1">Inicio</p></a>
              <a href="#" class="text-decoration-none text-black"><p class="mb-1">Quienes Somos</p></a>
            </div>
            <div class="row">
              <a href="#" class="text-decoration-none text-black"><p class="mb-1">Nuestros Servicios</p></a>
              <a href="#" class="text-decoration-none text-black"><p>Reserva tu cita</p></a>
            </div>
          </div>
          
          <div class="vr d-none d-md-block" style="height: 100px;"></div>
          
          <div class="col-auto">
            <a href="#" class="text-decoration-none text-black"><p><img src="/Imagenes/whatsapp.png" alt="whatsapp" width="20px" class="mx-2">Tel. 55 1774 6761</p></a> 
            <a href="#" class="text-decoration-none text-black"><p><img src="/Imagenes/instagram.png" alt="instagram" width="20px" class="mx-2">jglam_studio</p></a>
            <a href="#" class="text-decoration-none text-black"><p><img src="/Imagenes/facebook.png" alt="facebook" width="20px" class="mx-2">J&Glam Studio</p></a>
          </div>
        </div>
      </div>
    </footer>

</body>
<script src="/js/bootstrap.bundle.js"></script>
</html>
