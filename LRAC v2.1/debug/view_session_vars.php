<?php
include "../conns/conexion.php";
include "../phpfuncs/main.php";

//adminconnChecker();

echo <<<HTML
<style>
    
    * {
        box-sizing: border-box;
        font-size: 24px;
        font-family: "Arial";
        margin: 2px;
    }
    
    body {
        width: 100vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    p {
        width: 100%;
        text-align: left;
    }

</style>
HTML;

echo "<pre>";
echo var_dump($_SESSION);
echo "</pre";


echo <<<HTML
    <br>
    <h2>Session variables description</h2>
    <p>["data_curPage"] = is set in conexion.php, basename of the current page.</p>
    <p>["loggedin"] = is set in access.php or logout.php, states if user is logged in (can be null).</p>
    <p>["user_DATO"] = user related data, is set when logged in and refreshed every time conexion.php is loaded.</p>
    <p>["data_userinfoSet"] = states if the user session variables were set succesfully. (never used)</p>
    <p>["data_isAdmin"] = states if user is an admin or not, set in access.php</p>
    <p>["admin_curOrderby"] = the current orderBy filter in adminorders.php.</p>
    <p>["ADMIN_curModifProd"] = ("jueputa un error") - is set when modifying a product as admin, used to tell the sql query which product to modify.</p>
    <p>(should've used a URLparam instead)</p>
HTML;
