<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrac_bd";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

$_SESSION["data_curPage"] = basename($_SERVER['PHP_SELF'], '.php');
/*
echo "<script>console.log('page: " . $_SESSION["data_curPage"] . "')</script>";
echo "<script>console.log('data: recov_isActive: " . $_SESSION["recov_isActive"] . "')</script>";
*/

if ($_SESSION["data_curPage"] != "recover") {
    unset($_SESSION["recov_isActive"]);
    /*echo "<script>console.log('data: not recover page')</script>";*/
}
?>
<script>
    console.log("db: connected to <?php echo $dbname; ?>");
</script>