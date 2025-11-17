function selectImage(element) {
  const centerImage = document.getElementById("centerImage");
  centerImage.src = element.src;

  const title = document.getElementById("imageTitle");
  
  const desc = document.getElementById("imageDesc");
  
  title.style.opacity = 0;
  setTimeout(() => {
    title.textContent = element.dataset.title;
    title.style.opacity = 1;
  }, 200);

  document.querySelectorAll('.circle img').forEach(img => img.classList.remove('selected'));
  element.classList.add('selected');
}

const botones = document.querySelectorAll('#grupoTamanos button');
  const imagen = document.getElementById('imagenSeleccion');

  botones.forEach(boton => {
    boton.addEventListener('click', () => {
      botones.forEach(b => b.classList.remove('active'));
      boton.classList.add('active');
      imagen.src = boton.getAttribute('data-img');
    });
  });
