<link rel="stylesheet" href="../style.css">
<title>Creación exitosa!</title>

<body>
    <?php
    include("conexion.php");

    if (isset($_POST["login"])) {
        unset($_SESSION["loggedin"]);
        $name = $_POST["name"];
        $pass = $_POST["pass"];

        $sql = "SELECT * FROM userdata WHERE name = '$name' AND pass = '$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["loggedin"] = true;
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["user_pass"] = $row["pass"];
            $_SESSION["user_mail"] = $row["mail"];
            $_SESSION["user_q"] = $row["question"];
            $_SESSION["user_qa"] = $row["qanswer"];
            $_SESSION["data_userinfoSet"] = true;
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
    } elseif (isset($_POST["search_recoverMail"])) {
        $recovMail = $_POST["recovMail"];

        $sql = "SELECT * FROM userdata WHERE mail='$recovMail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $recovQuestion = $row["question"];
            $recovQanswer = $row["qanswer"];
            $_SESSION["recov_isActive"] = true;
            $_SESSION["recov_recovMail"] = $recovMail;
            $_SESSION["recov_question"] = $recovQuestion;
            $_SESSION["recov_qanswer"] = $recovQanswer;
            header("location: ../recover.php");
        } else {
            $_SESSION["error_recovmail404"] = true;
            header("location: ../recover.php");
        }
    } elseif (isset($_POST["input_modify"])) {
        $input_qanswer = $_POST["input_qanswer"];
        $input_newpass = $_POST["input_newpass"];
        $recovMail = $_SESSION["recov_recovMail"];

        $sql = "SELECT * FROM userdata WHERE mail='$recovMail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $trueQanswer = $row["qanswer"];
            if ($input_qanswer == $trueQanswer) {
                $sql = "UPDATE userdata SET pass='$input_newpass' WHERE mail='$recovMail'";
                $result = $conn->query($sql);
                $_SESSION["info_passchangeMelo"] = true;

                unset($_SESSION["recov_isActive"]);
                unset($_SESSION["recov_recovMail"]);
                unset($_SESSION["recov_question"]);
                unset($_SESSION["recov_qanswer"]);

                header("location: ../login.php");
            } else {
                $_SESSION["error_answerNotmatched"] = true;
                header("location: ../recover.php");
            }
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