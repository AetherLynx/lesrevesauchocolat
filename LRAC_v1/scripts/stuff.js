//SIDEBAR

//PAGE1 -> PAGE2

var prevPage = document.referrer;
var times = localStorage.getItem("index") || -1;

window.addEventListener("load", () => {
    var actualPage = window.location.href;
    if (prevPage == actualPage) {
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

