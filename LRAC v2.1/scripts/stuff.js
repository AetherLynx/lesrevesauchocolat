//SIDEBAR

//PAGE1 -> PAGE2

var prevPageX = document.referrer;
var times = localStorage.getItem("index") || -1;

window.addEventListener("load", () => {
    var urlParts = null;
    var actualPageX = window.location.href;

    urlParts = actualPageX.split('?');
    var actualPage = urlParts[0];

    urlParts = prevPageX.split('?');
    var prevPage = urlParts[0];

    if (prevPage == actualPage && actualPage != "adminprodmng.php") {
        times -= 1;
        localStorage.setItem("index", times)
    } else {
        times = -1
        localStorage.setItem("index", times)
    }
});


document.addEventListener("DOMContentLoaded", function () {

    var popup = document.getElementById("popup"); //popups :3 

    if (popup) { //so it stops giving errors when it doesnt exist lmao
        popup.addEventListener("animationend", () => {
            popup.remove();
        })
    }

    var backButton = document.getElementById("prevpageBt");
    if (backButton) {
        backButton.onclick = function () {
            history.go(times);
        };
    }
});

var open = false;
var notifs_open = false;

function toggleSidebar() {
    event.stopPropagation();
    document.getElementById("sidebar").style.transform = "translateX(0.7rem)"
    document.getElementById("sidebar").style.pointerEvents = "all"

    open = true;
}

//yo a veces me pego unas fumadas para meter estas pndjds a lo bien
function toggleNotifs() {
    closeSidebar();

    if (notifs_open) {
        closeNotifs();
        return;
    }

    event.stopPropagation();
    document.getElementById("sidebar_notifs").style.transform = "translateX(0.7rem)"
    document.getElementById("sidebar_notifs").style.pointerEvents = "all"

    notifs_open = true;
    refreshNotifs();
}

function closeSidebar() {
    document.getElementById("sidebar").style.transform = "translateX(25rem)"
    document.getElementById("sidebar").style.pointerEvents = "none"

    open = false;
}

function closeNotifs() {
    document.getElementById("sidebar_notifs").style.transform = "translateX(30rem)"
    document.getElementById("sidebar_notifs").style.pointerEvents = "none"

    notifs_open = false;
}

document.addEventListener('click', (event) => {
    var sidebar = document.getElementById('sidebar');
    var notifs_sidebar = document.getElementById('sidebar_notifs');

    if (open && !sidebar.contains(event.target) || notifs_open && !notifs_sidebar.contains(event.target)) {
        closeSidebar();
        closeNotifs();
    }
});

function goBack() {
    window.history.back();
}

function adjustWidth(input) {
    input.style.width = "auto"; // Reset width to auto to calculate the natural width of the input

    // Get the scroll width of the input
    var scrollWidth = input.scrollWidth;

    // Check if the scroll width exceeds the maximum width
    if (scrollWidth > 1000) {
        input.style.width = "1000px"; // Set the width to the maximum width
        input.style.whiteSpace = "normal"; // Allow text to wrap
    } else {
        input.style.width = scrollWidth + "px"; // Set the width to the scroll width
        input.style.whiteSpace = "nowrap"; // Prevent text from wrapping
    }
}

