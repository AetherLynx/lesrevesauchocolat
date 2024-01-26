let open = false;

function toggleSidebar() {
    document.getElementById("sidebar").style.width = "20%";
    document.getElementById("main").style.filter = "opacity(100%)";
    document.getElementById("blur-container").classList.add("blurred");

    open = true;
}

function closeSidebar() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("main").style.filter = "opacity(0%)";
    document.getElementById("blur-container").classList.remove("blurred");

    open = false;
}

function outsideClick(event) {
    if (open === true) {
        closeSidebar();
    }
}