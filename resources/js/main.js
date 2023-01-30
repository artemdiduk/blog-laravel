document.addEventListener('DOMContentLoaded', () => {
    let btnFormActive = document.querySelector(".btn.btn-primary.create");
    let form = document.getElementById("exampleModal");
    let btnClose = document.getElementById("btn-close");
    if (form) {
        btnFormActive.addEventListener("click", () => {
            form.classList.add("show");
            form.style.display = "block";
        });
    }
    if (form) {
        btnClose.addEventListener("click", () => {
            form.classList.remove("show");
            form.style.display = "none";
        });
    }

});
