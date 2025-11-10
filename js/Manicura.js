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
