
document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.querySelector(".hamburger");
    const sidebar = document.querySelector("aside.dashboard-sidebar");

    hamburger.addEventListener("click", function(e) {
        e.preventDefault();
        sidebar.classList.toggle("collapsed");
    });
});

