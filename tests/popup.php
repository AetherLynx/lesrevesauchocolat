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
        opacity: 0;
        /* Initially set opacity to 0 */
        transition: opacity 0.3s ease-in-out;
        /* Add a transition effect for opacity */
    }

    .popup.show {
        display: block;
        opacity: 1;
        /* Set opacity to 1 when popup is shown */
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
        popup.classList.add("show"); // Add the "show" class to display the popup with fade-in transition
    });

    closePopupBtn.addEventListener("click", function() {
        popup.classList.remove("show"); // Remove the "show" class to hide the popup with fade-out transition
    });

    // Close the popup when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target == popup) {
            popup.classList.remove("show"); // Remove the "show" class to hide the popup with fade-out transition
        }
    });
</script>