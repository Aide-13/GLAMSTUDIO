// --- Carrusel de pestañas ---
function selectImagePestanas(element) {
  const centerImage = document.getElementById("centerImagePestanas");
  const title = document.getElementById("imageTitlePestanas");
  const desc = document.getElementById("imageDescPestanas");

  centerImage.src = element.src;
  title.textContent = element.dataset.title;
  desc.textContent = element.dataset.desc;

  document.querySelectorAll(".circle .item").forEach(img => img.classList.remove("selected"));
  element.classList.add("selected");
}

// --- Carrusel de cejas ---
function selectImageCejas(element) {
  const centerImage = document.getElementById("centerImageCejas");
  const title = document.getElementById("imageTitleCejas");
  const desc = document.getElementById("imageDescCejas");
  const eye = document.querySelector(".eye");

  centerImage.src = element.src;
  title.textContent = element.dataset.title;
  desc.textContent = element.dataset.desc;

  document.querySelectorAll(".circle .item").forEach(img => img.classList.remove("selected"));
  element.classList.add("selected");

  // 👁️ Efecto de parpadeo breve al seleccionar
  eye.classList.add("blink");
  setTimeout(() => eye.classList.remove("blink"), 300);
}
