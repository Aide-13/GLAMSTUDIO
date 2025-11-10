document.addEventListener("DOMContentLoaded", () => {
  const nav = document.querySelector("nav");
  const footer = document.querySelector("footer");

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        nav.style.top = "-120px"; 
      } else {
        nav.style.top = "0"; 
      }
    });
  }, {
    threshold: 0.1
  });

  observer.observe(footer);
});