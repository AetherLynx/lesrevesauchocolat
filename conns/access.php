<link rel="stylesheet" href="../style.css">
<title>Creación exitosa!</title>

<body>
    <?php
    include("conexion.php");
    session_start();
    if (isset($_POST["login"])) {
        unset($_SESSION["loggedin"]);
        $name = $_POST["name"];
        $pass = $_POST["pass"];

        $sql = "SELECT * FROM userdata WHERE name = '$name' AND pass = '$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $_SESSION["loggedin"] = true;
            $_SESSION["name"] = $name;
            $_SESSION["pass"] = $pass;
            header("location: ../main.php");
        } else {
            $_SESSION["error_logincr"] = true;
            header("location: ../login.php");
        }
    } elseif (isset($_POST["signin"])) {
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        $mail = $_POST["mail"];
        $question = $_POST["question"];
        $qanswer = $_POST["qanswer"];

        $sql = "SELECT * FROM userdata WHERE mail='$mail'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "
        <div class='innerbody' style='height:100vh'>
            <h1>Ya existe un usuario con ese correo.</h1>
            <p>Por favor vuelve a intentarlo.</p>
            <a class='butt' href='../signin.php'>Registro de usuario</a>
        </div>
        ";
        } else {
            createAccount($name, $pass, $mail, $question, $qanswer);
        }
    }

    function createAccount($name, $pass, $mail, $question, $qanswer)
    {
        include("conexion.php");
        $sql = "INSERT INTO userdata (name, pass, mail, question, qanswer) VALUES ('$name', '$pass', '$mail', '$question', '$qanswer')";
        if ($conn->query($sql) === TRUE) {
            echo "
        <div class='innerbody' style='height=100vh'>
            <h1>Gracias por registrarte " . $name . ".</h1>
            <a class='butt' href='../login.php'>Iniciar sesión</a>
        </div>
        ";
        } else {
            echo "
        <div class='innerbody' style='height=100vh'>
            <h1>Hubo un error registrándote.</h1>
            <p>Por favor vuelve a intentarlo.</p>
            <a class='butt' href='../signin.php'>Registro de usuario</a>
        </div>
        ";
        }
        $conn->close();
    }
    ?>
</body>