//SIDEBAR

document.addEventListener("DOMContentLoaded", function () {

    var popup = document.getElementById("popup"); //popups :3 

    popup.addEventListener("animationend", () => {
        popup.remove();
    })
});

var open = false;

function toggleSidebar() {
    event.stopPropagation();
    document.getElementById("sidebar").style.transform = "translateX(0rem)"
    document.getElementById("sidebar").style.filter = "opacity(100%)"
    document.getElementById("sidebar").style.pointerEvents = "all"

    open = true;
}

function closeSidebar() {
    document.getElementById("sidebar").style.transform = "translateX(20rem)"
    document.getElementById("sidebar").style.filter = "opacity(0%)"
    document.getElementById("sidebar").style.pointerEvents = "none"

    open = false;
}

document.addEventListener('click', (event) => {
    var sidebar = document.getElementById('sidebar');

    if (open && !sidebar.contains(event.target)) {
        closeSidebar();
    }
});

function goBack() {
    window.history.back();
}
