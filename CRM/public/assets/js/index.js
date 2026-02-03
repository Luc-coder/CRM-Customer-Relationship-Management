document.addEventListener("DOMContentLoaded", function () {
    const msg = document.querySelector(".success");

    if (msg) {
        setTimeout(() => {
            msg.style.display = "none";
        }, 4000);
    }
});