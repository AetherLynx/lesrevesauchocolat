<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Example</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
.popup {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}
</style>

<body>

    <button id="openPopupBtn">Open Popup</button>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span id="closePopupBtn" class="close">&times;</span>
            <h1>Clicked!</h1>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<script>
const openPopupBtn = document.getElementById("openPopupBtn");
const closePopupBtn = document.getElementById("closePopupBtn");
const popup = document.getElementById("popup");

openPopupBtn.addEventListener("click", function() {
    popup.style.display = "block";
});

closePopupBtn.addEventListener("click", function() {
    popup.style.display = "none";
});

// Close the popup when clicking outside of it
window.addEventListener("click", function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
});
</script>