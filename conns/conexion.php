<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrac_bd";
$conn = new mysqli($servername, $username, $password, $dbname);
?>
<script>
console.log("connected to <?php echo $dbname; ?>");
</script>