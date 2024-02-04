<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrac_bd";
$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION["data_curPage"] = basename($_SERVER['PHP_SELF'], '.php');

if ($_SESSION["data_curPage"] != "recover") {
    unset($_SESSION["recov_isActive"]);
}
?>
<script>
    console.log("db: connected to <?php echo $dbname; ?>");
</script>