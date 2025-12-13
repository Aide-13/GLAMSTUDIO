<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: Iniciar_sesion.html");
    exit();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "Nutria1720*", "glam_studio");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_POST["guardar"])) {

    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);
    $fecha = $_POST["fecha"];

    $archivo = "";
    if (!empty($_FILES["archivo"]["name"])) {
        $archivo = "uploads/" . uniqid() . "_" . basename($_FILES["archivo"]["name"]);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
    }

    $sql = $conn->prepare("INSERT INTO promociones (titulo, descripcion, precio, fecha_fin, archivo) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssdss", $titulo, $descripcion, $precio, $fecha, $archivo);
    $sql->execute();
}

if (isset($_POST["editar"])) {

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);
    $fecha = $_POST["fecha"];

    if (!empty($_FILES["archivo"]["name"])) {
        $archivo = "uploads/" . uniqid() . "_" . basename($_FILES["archivo"]["name"]);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

        $sql = $conn->prepare("UPDATE promociones 
                               SET titulo=?, descripcion=?, precio=?, fecha_fin=?, archivo=? 
                               WHERE id=?");
        $sql->bind_param("ssdssi", $titulo, $descripcion, $precio, $fecha, $archivo, $id);

    } else {

        $sql = $conn->prepare("UPDATE promociones 
                               SET titulo=?, descripcion=?, precio=?, fecha_fin=? 
                               WHERE id=?");
        $sql->bind_param("ssdsi", $titulo, $descripcion, $precio, $fecha, $id);
    }

    $sql->execute();
}

if (isset($_POST["borrar"])) {
    $id = $_POST["id"];
    $sql = $conn->prepare("DELETE FROM promociones WHERE id=?");
    $sql->bind_param("i", $id);
    $sql->execute();
}

$promos = $conn->query("SELECT * FROM promociones ORDER BY creado DESC");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Romanesco&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style._contenido.css">
    <link rel="stylesheet" href="css/boton_shine.css">
    <title>J&G GLAMSTUDIO - Contenido</title>
</head>
<body>
  
    <nav class="navbar navbar-expand-lg navbar-primary  fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="Imagenes/logo.png" width="45px" alt=""></a>
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
            <li class="barra nav-item p-3"><a class="nav-link text-white" href="app/View/citas.php">Agenda de Citas</a></li>
            <li class="barra nav-item p-3"><a class="nav-link text-white" href="contenido.php">Contenido</a></li>
          </ul>
          <button class=" btn nav-item btn-shine" onclick="mostrarModal()"><i class="bi bi-box-arrow-right"></i></button>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row text-center pt-5 pb-2" style="background: #171614;">
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

  <div class="container-fluid">
    <!--Sección 2-->
    <div class="contenido seccion_2 d-none d-lg-block">
      <h3 class="titulo_2">Contenido de la Página</h3>
      
      <!--Formulario-->
      <form action="contenido.php" method="POST" enctype="multipart/form-data">
        <div class=" formulario">
          <div>
            <label for="" class="dato">Título contenido:</label>
            <input name="titulo" type="text" class="campo_1" placeholder="Ingresa el título de tú contenido">
          </div>
          <p class="nota_1">Detalles del contenido</p>

          <div>
            <label for="" class="dato">Descripción:</label>
            <div>
              <textarea name="descripcion" class="campo_2" placeholder="Ingresa la descripción del contenido (120 palabras)"></textarea>
            </div>
          </div>
          
          <div class="precio">
            <label for="" class="dato">Precio:</label>
            <input name="precio" type="text" class="campo_3" placeholder="$0.00">
          </div>

          <p class="nota_2">Ingresa la fecha limite del contenido</p>
          <div>
            <label for="" class="dato">Disponible hasta:</label>
            <input name="fecha" type="date" class="campo_4">
          </div>
          <div class="col-6 my-4">
            <label for="" class="dato me-1">Archivo: </label>
            <input name="archivo" type="file" id="archivo" class="form-control">
          </div>
          <button type="submit" class="guardar" name="guardar">Guardar</button>
        </div>
        <img class="imagen_1 d-none d-lg-block" src="Imagenes/promocion.png" alt="">
      </form>
    </div>

    <!--moviles-->
    <div class="col m-sm-3 m-5 d-block d-lg-none">
      <h3 class="titulo_2">Contenido de la Página</h3>
      
      <!--Formulario-->
      <form action="contenido.php" method="POST" enctype="multipart/form-data">
        <div class="formulario">
          <div class="my-4">
            <label for="" class="dato_1 form-label">Título contenido:</label>
            <input name="titulo" type="text" class="campo form-control" placeholder="Ingresa el título de tú contenido">
          </div>

          <p class="nota p-0 my-3">Detalles del contenido</p>

          <div class="my-4">
            <label for="" class="dato_1 form-label">Descripción:</label>
            <div>
              <textarea name="descripcion" class="campo form-control" placeholder="Ingresa la descripción del contenido (120 palabras)"></textarea>
            </div>
          </div>
          
          <div class="my-4">
            <label for="" class="dato_1 form-label">Precio:</label>
            <input name="precio" type="text" class="campo form-control" placeholder="$0.00">
          </div>

          <p class="nota p-0 my-3">Ingresa la fecha limite del contenido</p>

          <div class="my-4">
            <label for="" class="dato_1 form-label">Disponible hasta:</label>
            <input name="fecha" type="date" class="campo form-control">
          </div>
          <div class=" my-4">
            <label for="" class="dato me-1">Archivo: </label>
            <input name="archivo" type="file" id="archivo" class="form-control">
          </div>
          <div class="d-block d-lg-none d-flex justify-content-end">
            <button type="submit" class="guardar_1" name="guardar">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="tabla table-light">
                        <th>Titulo contenido</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Fecha de disponibilidad</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($p = $promos->fetch_assoc()): ?>
                <tr>
                    <td><?= $p["titulo"] ?></td>
                    <td><?= $p["descripcion"] ?></td>
                    <td>$<?= $p["precio"] ?></td>
                    <td><?= $p["fecha_fin"] ?></td>
                    <td><img src="<?= $p["archivo"] ?>" width="80"></td>

                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditar<?= $p['id'] ?>">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEliminar<?= $p['id'] ?>">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
$promos->data_seek(0);
while ($v = $promos->fetch_assoc()):
?>

<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditar<?= $v['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Promoción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" value="<?= $v['id'] ?>">

                <label class="form-label">Título</label>
                <input name="titulo" type="text" class="form-control" value="<?= $v['titulo'] ?>">

                <label class="form-label mt-3">Descripción</label>
                <textarea name="descripcion" class="form-control"><?= $v['descripcion'] ?></textarea>

                <label class="form-label mt-3">Precio</label>
                <input name="precio" type="number" class="form-control" value="<?= $v['precio'] ?>">

                <label class="form-label mt-3">Fecha límite</label>
                <input name="fecha" type="date" class="form-control" value="<?= $v['fecha_fin'] ?>">

                <label class="form-label mt-3">Archivo</label>
                <input type="file" name="archivo" class="form-control">

                <img src="<?= $v['archivo'] ?>" width="120" class="mt-3">
            </div>

            <div class="modal-footer">
                <button type="submit" name="editar" class="btn btn-light botones">Actualizar</button>
                <button type="button" class="btn btn-light botones" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </form>
    </div>
</div>


<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modalEliminar<?= $v['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Eliminar Promoción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>¿Seguro que deseas eliminar <strong><?= $v['titulo'] ?></strong>?</p>
                <input type="hidden" name="id" value="<?= $v['id'] ?>">
            </div>

            <div class="modal-footer">
                <button type="submit" name="borrar" class="btn btn-light botones">Eliminar</button>
                <button type="button" class="btn btn-light botones" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </form>
    </div>
</div>

<?php endwhile; ?>



    <footer class="mt-5 pt-4" style="background: #171614;">
        <div class="container-fluid">
      
        <div class="text-center ">
            <p class="mb-2 fw-semibold text-white">Todos los derechos son reservados</p>
        </div>

        <div class="d-flex justify-content-evenly flex-wrap">
          
            <div class="col-auto">
            <img src="Imagenes/logo.png" alt="logo" width="100px">
            <a href="#" class="text-decoration-none text-white fw-bold">J&G GLAMSTUDIO</a>
            </div>
          
          <div class="vr d-none d-md-block" style="height: 100px;"></div>
          
          <div class="col-auto text-center">
            <div class="col">
              <a href="index.php" class="text-decoration-none text-white"><p class="mb-1">Inicio</p></a>
              <a href="quienes_somos.html" class="text-decoration-none text-white"><p class="mb-1">Quienes Somos</p></a>
            </div>
            <div class="row">
              <a href="Servicios.html" class="text-decoration-none text-white"><p class="mb-1">Nuestros Servicios</p></a>
              <a href="agendar_cita.html" class="text-decoration-none text-white"><p>Reserva tu cita</p></a>
            </div>
          </div>
          
          <div class="vr d-none d-md-block" style="height: 100px;"></div>
          
          <div class="col-auto">
          <a href="https://wa.me/5517746761?text=Hola" class="text-decoration-none text-white"><p><img src="Imagenes/whatsapp.png" alt="whatsapp" width="20px" class="mx-2">Tel. 55 1774 6761</p></a> 
          <a href="https://www.instagram.com/jglam_studio?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-decoration-none text-white"><p><img src="Imagenes/instagram.png" alt="instagram" width="20px" class="mx-2">jglam_studio</p></a>
          <a href="https://www.facebook.com/profile.php?id=61579641932700&sk=about" class="text-decoration-none text-white"><p><img src="Imagenes/facebook.png" alt="facebook" width="20px" class="mx-2">J&Glam Studio</p></a>
        </div>
        </div>
      </div>
    </footer>


</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/Cerrarsesion.js"></script>
<script src="js/foot.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>


