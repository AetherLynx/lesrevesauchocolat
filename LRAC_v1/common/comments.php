<?php
$user = true;
if (!isset($_SESSION["loggedin"])) {
    $user = false;
}

$category = $_SESSION["data_curPage"];

switch ($category) {
    case "viewproduct":
        $query = $_GET["id"];
        break;
    case "userprofile":
        $query = $_GET["user"];
        break;
    case "usercomments":
        $query = $_GET["user"];
        break;
}

if ($user) {
    $userpfp = $_SESSION["user_pfp"];
}

if ($category != "usercomments") {
    if ($user) {
        echo <<<HTML
            <div class='main-maxw main-column'>
                <div class='main-rowstart main-maxw'>
                    <script>
                    icon("2.5em", "2.5em", "textbubble");
                    </script>
                    <h1>Comentarios</h1>
                </div>
            <form action="conns/createpost.php?category=$category&query=$query" method='post' class='main-maxw main-rowstart main-aligncenter'>
                <img src="files/userpfp/$userpfp" class='img-postpfp'>
                <div>
                    <input type="text" id='comm-input' placeholder='Escribe un comentario...' oninput="adjustWidth(this)" name="content" autocomplete="off">
                    <button class='icontext main-buttonpadding' type='submit' name='createcomment'>
                        <script>
                        icon('2em', '2em', "send")
                        </script>
                        <p>Publicar</p>
                    </button>
                </div>
            </form>
        HTML;
    } else {
        echo <<<HTML
            <div class='main-maxw main-column'>
                <div class='main-rowstart main-maxw'>
                    <script>
                    icon("2.5em", "2.5em", "textbubble");
                    </script>
                    <h1>Comentarios</h1>
                </div>
        HTML;
    }
} else {
    $sql = "SELECT prefColor FROM userdata WHERE userid='$query'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $color = $row["prefColor"];
        if ($color != "default") {
            changeColorsPRESET($color);
        }
    }

    echo <<<HTML
    <div class='main-maxw main-column'>
        <div class='main-rowstart main-maxw'>
            <script>
            icon("2.5em", "2.5em", "textbubble");
            </script>
            <h1>Comentarios del usuario</h1>
        </div>
    HTML;
}

loadComments($category, $query, $conn, $user);

function loadComments($page, $query, $conn, $user)
{
    if ($page != "usercomments") {
        $sql = "SELECT * FROM posts WHERE postcategory='$page' AND postwhere='$query'";
        $result = $conn->query($sql);

        if (!$result->num_rows > 0) {
            echo <<<HTML
                <h2>No se encontraron comentarios.</h2>
            </div>
        HTML;
            die();
        }
    } else {
        $sql = "SELECT * FROM posts WHERE userid='$query'";
        $result = $conn->query($sql);

        if (!$result->num_rows > 0) {
            echo <<<HTML
                <h2>No se encontraron comentarios.</h2>
            HTML;
            die();
        }
    }

    while ($row = $result->fetch_assoc()) {
        $postid = $row["postid"];
        $userid = $row["userid"];
        $content = $row["content"];
        $postdate = $row["postdate"];
        $postcategory = $row["postcategory"];
        $postwhere = $row["postwhere"];

        $actdate = formatDate($postdate);

        $sql = "SELECT name, pfp FROM userdata WHERE userid='$userid'";
        $result2 = $conn->query($sql);
        $row2 = $result2->fetch_assoc();

        $username = $row2["name"];
        $CommenterPfp = $row2["pfp"];

        $canDelete = null;
        $from = null;

        if ($page == "usercomments") {
            switch ($postcategory) {
                case 'viewproduct':
                    $urlUC = "viewproduct.php?id=$postwhere&sc=5&was=$query";
                    break;
                case 'userprofile':
                    $urlUC = "userprofile.php?user=$postwhere";
                    break;
            }

            $from = "
                <a href='$urlUC' class='icontext'>
                    <script>
                        icon('2em', '2em', 'textbubble')
                    </script>
                    <p>Ir al post original</p>
                </a>
            ";
        }
        if ($user) {
            if ($userid == $_SESSION["user_id"]) {
                $canDelete = "
                <a href='conns/deletepost.php?post=$postid&category=$page&query=$query' class='icontext'>
                    <script>
                        icon('2em', '2em', 'eraser')
                    </script>
                    <p>Eliminar comentario</p>
                </a>
            ";
            }
        }


        echo <<<HTML
            <div class='main-column main-start main-darkcont2'>
                <div class='main-maxw main-rowstart main-aligncenter main-maxw'>
                    <img src="files/userpfp/$CommenterPfp" class='img-postpfp'>
                    <div class='main-nm main-maxw'>
                        <h2 class='main-nmb'>$username</h2>
                        <p class='main-nmt'>$actdate</p>
                        <div class="up-biocont" isComment>
                            <p>$content</p>
                        </div>
                    </div>
                </div>
                <div class='main-row'>
                    $from
                    <a href='userprofile.php?user=$userid' class='icontext'>
                        <script>
                        icon('2em', '2em', 'lupa')
                        </script>
                        <p>Mirar perfil de $username</p>
                    </a>
                    $canDelete
                </div>
            </div>
        HTML;
    }

    echo "</div>";
}
