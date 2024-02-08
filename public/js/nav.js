document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector(".menu-btn");
    const navbarUl = document.querySelector(".navbar ul");

    menuBtn.addEventListener("click", function () {
        navbarUl.classList.toggle("show");
    });
});