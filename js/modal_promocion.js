
document.addEventListener("DOMContentLoaded", () => {
  const botones = document.querySelectorAll(".verMas");

  botones.forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("modalTitulo").textContent = btn.dataset.titulo;
        document.getElementById("modalDescripcion").textContent = btn.dataset.descripcion;
        document.getElementById("modalPrecio").textContent = btn.dataset.precio;
        document.getElementById("modalVigencia").textContent = btn.dataset.vigencia;
        document.getElementById("modalImagen").src = btn.dataset.imagen;
    });
  });
});
