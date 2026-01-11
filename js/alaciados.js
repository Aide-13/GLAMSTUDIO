
function selectTecnica(element) {
  document.querySelectorAll('.item-text').forEach(e => e.classList.remove('active'));
  element.classList.add('active');
}

function selectTecnica(element) {
  document.querySelectorAll('.item-text')
    .forEach(e => e.classList.remove('active'));
  element.classList.add('active');
  document.getElementById('imageTitle').textContent =
    element.dataset.title;

  document.getElementById('imageDesc').textContent =
    element.dataset.desc;
}
