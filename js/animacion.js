for (let i = 0; i < 40; i++) {
  let s = document.createElement("div");
  s.classList.add("spark");
  s.style.left = Math.random() * 100 + "%";
  s.style.top = (Math.random() * 100 + 20) + "%";
  s.style.animationDelay = Math.random() * 5 + "s";
  s.style.transform = `scale(${Math.random() * 1.2})`;
  document.getElementById("sparkles").appendChild(s);
}