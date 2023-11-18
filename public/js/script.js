function toggleButton() {
    let toggler = document.getElementById("toggler-icon");
    let close = document.getElementById("material-symbol");

    let isExpanded = document.getElementById("navbarNav").getAttribute("aria-expanded");

    if (isExpanded === "true") {
        toggler.style.display = "inline-block";
        close.style.display = "none";
    } else {
        toggler.style.display = "none";
        close.style.display = "inline-block";
    }
}



