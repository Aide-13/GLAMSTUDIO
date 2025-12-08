  const botones = document.querySelectorAll('#grupoTamanos button');
  const imagen = document.getElementById('imagenSeleccion');

  botones.forEach(boton => {
    boton.addEventListener('click', () => {
      botones.forEach(b => b.classList.remove('active'));
      boton.classList.add('active');
      imagen.src = boton.getAttribute('data-img');
    });
  });
