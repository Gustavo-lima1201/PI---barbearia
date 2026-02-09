document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.querySelector(".menu-toggle");
  const menu = document.querySelector(".navigation ul");

  menuToggle.addEventListener("click", () => {
    menu.classList.toggle("show");
  });
});
