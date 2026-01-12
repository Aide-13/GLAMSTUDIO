
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

  eye.classList.add("blink");
  setTimeout(() => eye.classList.remove("blink"), 300);
}

const elemento = document.querySelector('.pestanas');
const descripcion = document.querySelector('#descripcion');

descripcion.innerHTML = elemento.dataset.desc;