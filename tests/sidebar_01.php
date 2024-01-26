<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <style>
    body {
        margin: 0;
        overflow: hidden;
    }

    #blur-container {
        transition: filter 0.3s;
    }

    .blurred {
        filter: blur(4px);
    }

    #sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: width 0.3s;
        padding-top: 60px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    #sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    #sidebar a:hover {
        color: #f1f1f1;
    }

    #main {
        transition: margin-right 0.3s;
        padding: 16px;
    }

    #openBtn {
        font-size: 20px;
        cursor: pointer;
        position: fixed;
        right: 20px;
        top: 20px;
        background-color: #111;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
</head>

<body>

    <button id="openBtn" onclick="toggleSidebar()">☰ Open Sidebar</button>
    <div id="sidebar">
        <a href="#" onclick="closeSidebar()">Close</a>
        <!-- Add more sidebar content here -->
    </div>
    <div id="blur-container">


        <div id="main">
            <!-- Your main content goes here -->
            <h1>Your Main Content</h1>
        </div>
    </div>

    <script>
    function toggleSidebar() {
        document.getElementById("sidebar").style.width = "250px";
        document.getElementById("main").style.marginRight = "250px";
        document.getElementById("blur-container").classList.add("blurred");
    }

    function closeSidebar() {
        document.getElementById("sidebar").style.width = "0";
        document.getElementById("main").style.marginRight = "0";
        document.getElementById("blur-container").classList.remove("blurred");
    }
    </script>

</body>

</html>