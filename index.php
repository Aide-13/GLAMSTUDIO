<?php
$conn = new mysqli("localhost", "root", "", "glam_studio");

$promos = $conn->query("
    SELECT * FROM promociones 
    WHERE fecha_fin >= CURDATE()
    ORDER BY fecha_fin ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="google-site-verification" content="5aOCZBopG_tZdllzD0cLEu7EG7iOpQvFFu80vbyahxU" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Romanesco&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Poppins:wght@200;300;400;600;700&family=Raleway:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_index.css">
  <link rel="stylesheet" href="css/whatsapp.css">
  <title>J&G GLAMSTUDIO - Inicio</title>
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-primary  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html"><img src="Imagenes/logo.png" width="45px" alt=""></a>
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
          <li class="barra nav-item p-3"><a class="nav-link text-white" href="index.php">Inicio</a></li>
          <li class="barra nav-item p-3"><a class="nav-link text-white" href="quienes_somos.html">Quienes Somos</a></li>
          <li class="barra nav-item p-3"><a class="nav-link text-white" href="Servicios.html">Nuestros Servicios</a></li>
        </ul>
        <button class=" btn btn-light nav-item" id="citas"> <a class="nav-link" href="agendar_cita.html">Reserva una Cita</a></button>
      </div>
    </div>
  </nav>
  
  <!-- SECCIÓN 1 -->
  <div class="container-fluid  seccion_1  m-0 p-0">
    <div class="row d-flex justify-content-evenly">
      <div class="col-5 d-none d-md-block text-center mt-5">
        <img src="Imagenes/Imagen1_pagina inicio.png" width="350px" class="img-fluid mt-5">
      </div>
      <div class="col-7 text-white text-center p-0 mt-5">
        <div class="col">
          <p class="texto_1">J <span class="texto_2">&</span> G</p>
        </div>
        <div class="col titulo " >
          <p class="m-0">GLAM STUDIO</p>
        </div>
        <div class="col subtitulo ">
          <p>TU BELLEZA, NUESTRO ARTE</p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- SECCIÓN 2 -->
  <div class="container-fluid seccion_2 m-0 text-md-end">
    <div class="row d-flex align-items-center ">
      <div class="col d-none d-lg-block contenido m-0 p-0">
        <p class="subtitulo_1">GlamStudio: donde comienza <br> tu transformación</p>
        <p class="texto_4 mt-md-4">Descubre un lugar donde cada detalle importa y cada estilo 
          cuenta. Te invitamos a explorar nuestra página, conocer nuestros servicios y 
          dejarte inspirar por el encanto de J&G GlamStudio, donde la belleza se 
          convierte en arte.
        </p>
      </div>
      <div class="col my-md-0 d-block d-lg-none contenido m-5 p-0 text-black">
        <p class="subtitulo_2">GlamStudio: donde comienza <br> tu transformación</p>
        <p class="texto_42 mt-md-4">Descubre un lugar donde cada detalle importa y cada estilo 
          cuenta. Te invitamos a explorar nuestra página, conocer nuestros servicios y 
          dejarte inspirar por el encanto de J&G GlamStudio, donde la belleza se 
          convierte en arte.
        </p>
      </div>
      <div class="col-md-8 p-0">
        <img src="Imagenes/Extenciones.png" style="max-width: 985px;" alt="" class="img-fluid extension">
      </div>
    </div>
  </div>
  
  <hr>
  
  <!-- SECCIÓN 3 -->
  <div class="container-fluid">
    <h3 class="titulo_2">Nuestras Promociones</h3>
    <div class="row seccion_3 justify-content-around text">
        <?php while($p = $promos->fetch_assoc()){ ?>
            <div class="col col-sm-8 promocion d-flex align-items-center p-0 m-3">
                <div class="col-4">
                    <img src="<?= $p['archivo'] ?>" width="150" class="">
                </div>
                <div class="col-8 text-center">
                    <p class="mt-4"><?= nl2br($p['titulo']) ?></p>
                    <button
                    class="btn btn-link verMas"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPromocion"
                    
                    data-titulo="<?php echo htmlspecialchars($p['titulo']); ?>"
                    data-descripcion="<?php echo htmlspecialchars($p['descripcion']); ?>"
                    data-precio="<?php echo $p['precio']; ?>"
                    data-vigencia="<?php echo $p['fecha_fin']; ?>"
                    data-imagen="<?php echo $p['archivo']; ?>"
                    >Ver más...</button>
                    <div class="cita_1 mt-2">
                        <a href="agendar_cita.html" class="agendar_1">
                            <button>Agenda tu cita</button>
                        </a>
                    </div>
                    <p class="text-secondary mt-2">
                        Válido hasta el <?= date("d-m-Y", strtotime($p["fecha_fin"])) ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade align-items-center" id="modalPromocion" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
      <div class="row g-0">
        <div class="col-md-6">
          <img id="modalImagen" src="" class="img-fluid h-100" style="object-fit: cover;">
        </div>
        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
          <div class="text-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div>
            <h4 class="fw-bold" id="modalTitulo"></h4>

            <p class="mt-2" id="modalDescripcion"></p>

            <button class="btn w-100 mt-3" 
              style="background-color:#c8a451; color:white; font-size:18px; font-weight:600;">
              Por solo <span id="modalPrecio"></span> MXN
            </button>

            <p class="text-center mt-3" style="font-size:14px;">
              Válido hasta el <span id="modalVigencia"></span>
            </p>
          </div>
          <a href="agendar_cita.html">
            <button class="btn w-100 mt-3"
            style="background-color:#c8a451; color:white; font-size:18px; font-weight:600;">
            Agenda tu cita
            </button>
          </a>
          

        </div>
      </div>

    </div>
  </div>
</div>


<a href="https://wa.me/5517746761?text=Hola" class="float-wa" target="_blank">
    <i class="fa fa-whatsapp" style="margin-top:16px;"></i>
</a>
  
  <footer class="pt-4 text-white" style="background: #171614;">
    <div class="container-fluid ">
      <div class="text-center ">
        <p class="mb-2 fw-semibold">Todos los derechos son reservados</p>
      </div>
      <div class="d-flex justify-content-evenly flex-wrap">
        <div class="col-auto">
          <img src="Imagenes/icono.png" alt="logo" width="100px">
          <a href="#" class="text-decoration-none fw-bold" style="color: #C6A04F;">J&G GLAMSTUDIO</a>
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
          <a href="#" class="text-decoration-none text-white"><p><img src="Imagenes/whatsapp.png" alt="whatsapp" width="20px" class="mx-2">Tel. 55 1774 6761</p></a> 
          <a href="#" class="text-decoration-none text-white"><p><img src="Imagenes/instagram.png" alt="instagram" width="20px" class="mx-2">jglam_studio</p></a>
          <a href="#" class="text-decoration-none text-white"><p><img src="Imagenes/facebook.png" alt="facebook" width="20px" class="mx-2">J&Glam Studio</p></a>
        </div>
      </div>
    </div>
  </footer>


<script src="js/bootstrap.bundle.js"></script>
<script src="js/modal_promocion.js"></script>
</body>
</html>
