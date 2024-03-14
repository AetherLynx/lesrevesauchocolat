<?php
//global variables
$states_index = [
    "Pedido enviado",
    "Pedido recibido",
    "Pedido rechazado",
    "Creando pedido",
    "Pedido despachado",
    "Pedido entregado",
    "Confirmado como recibido"
];

function formatCOP($value)
{
    $x = number_format($value, 0, '', '.');
    return $x;
}

function setPopup($text, $location)
{
    $_SESSION["dynamic_errorPopup"] = "
            <div class='popup main-rowcenter' id='popup'>
                <div class='main-iconmr'>
                    <script>
                    document.write(warningb);
                    </script>
                </div>
                <p t='c'>$text</p>
            </div>
            ";
    echo <<<HTML
    <script>
        window.location.replace("$location");
    </script>
    HTML;
}

function renderPopup()
{
    if (isset($_SESSION["dynamic_errorPopup"])) {
        echo $_SESSION["dynamic_errorPopup"];
        unset($_SESSION["dynamic_errorPopup"]);
    }
}

function formatDate($value)
{
    $monthname = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $array = explode("-", $value);
    //2024-03-22 -> 2024, 03, 22 (Y/M/D)
    $day_c = intval($array[2]);
    $mont_i = (intval($array[1]) - 1);
    $frmt_m = $monthname[$mont_i];

    return "$day_c de $frmt_m, $array[0]";
}

function changeColors($co1, $co4, $co4u, $co4ba, $co4fa, $co3)
{
    echo "
        <script>
            document.documentElement.style.setProperty('--co1', '$co1')
            document.documentElement.style.setProperty('--co4', '$co4')
            document.documentElement.style.setProperty('--co4u', '$co4u')
            document.documentElement.style.setProperty('--co4ba', '$co4ba')
            document.documentElement.style.setProperty('--co4fa', '$co4fa')
            document.documentElement.style.setProperty('--co3', '$co3')
        </script>
        ";
}

function changeColorsPRESET($preset)
{
    switch ($preset) {
        case "brown":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff3f0')
                    document.documentElement.style.setProperty('--co4', '#BF7B69')
                    document.documentElement.style.setProperty('--co4u', '#BF7B69')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(191, 123, 105, 70%)')
                    document.documentElement.style.setProperty('--co4fa', 'rgba(191, 123, 105, 20%)')
                    document.documentElement.style.setProperty('--co3', '#f0af9e')
                </script>
                ";
            break;
        case "cyan":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#f5f9ff')
                    document.documentElement.style.setProperty('--co4', '#94ADD7')
                    document.documentElement.style.setProperty('--co4u', '#94ADD7')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(148, 173, 215, 70%)')
                    document.documentElement.style.setProperty('--co4fa', 'rgba(148, 173, 215, 20%)')
                    document.documentElement.style.setProperty('--co3', '#d2e0f7')
                </script>
                ";
            break;
        case "pink":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff7fa')
                    document.documentElement.style.setProperty('--co4', '#E63F74')
                    document.documentElement.style.setProperty('--co4u', '#E63F74')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(230, 63, 116, 70%)')
                    document.documentElement.style.setProperty('--co4fa', 'rgba(230, 63, 116, 20%)')
                    document.documentElement.style.setProperty('--co3', '#ffd1e0')
                </script>
                ";
            break;
        case "gray":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#f7fafc')
                document.documentElement.style.setProperty('--co4', '#7f8ca3')
                document.documentElement.style.setProperty('--co4u', '#7d8db0')
                document.documentElement.style.setProperty('--co4ba', 'rgba(121, 146, 173, 70%)')
                document.documentElement.style.setProperty('--co3', '#e6edf7')
            </script>
            ";
            break;
        case "dark":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#fafaff') //white main
                document.documentElement.style.setProperty('--co4', '#34324a') //strong main
                document.documentElement.style.setProperty('--co4u', '#161521') //darker strong main
                document.documentElement.style.setProperty('--co4b', '#252336') //dark strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(37, 35, 54, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co3', '#c8c8de') //secondary color / gradient
                document.documentElement.style.setProperty('--co4fa', 'rgba(37, 35, 54, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;
        case "purple":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#faf7ff')
                    document.documentElement.style.setProperty('--co4', '#8a79ad')
                    document.documentElement.style.setProperty('--co4u', '#8a79ad')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(138, 121, 173, 70%)')
                    document.documentElement.style.setProperty('--co3', '#ebe6f7')
                </script>
                ";
            break;
        case "lime":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#f6fff5') //white main
                document.documentElement.style.setProperty('--co4', '#81c986') //strong main
                document.documentElement.style.setProperty('--co4u', '#547856') //darker strong main
                document.documentElement.style.setProperty('--co4b', '#749676') //dark strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(116, 153, 119, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co3', '#d8e8d9') //secondary color / gradient
                document.documentElement.style.setProperty('--co4fa', 'rgba(116, 153, 119, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;
        case "blue":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#f7f7fc')
                document.documentElement.style.setProperty('--co2', '#f0f1ff')
                document.documentElement.style.setProperty('--co3', '#e6edf7')
                document.documentElement.style.setProperty('--co4', '#8d86cf')
                document.documentElement.style.setProperty('--co4ba', 'rgba(91, 84, 158, 70%)')
                document.documentElement.style.setProperty('--co4b', '#749676') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#547856') //darker strong main
                document.documentElement.style.setProperty('--co4fa', 'rgba(91, 84, 158, 70%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;
        default:
            echo "<script>alert('Categoria no encontrada!')</script>";
            break;
    }
}

function returnOrStIcon($value)
{
    switch ($value) {
        case "Pedido enviado":
            return "CUSTOM_STATE01";
        case "Pedido recibido":
            return "CUSTOM_STATE02";
        case "Pedido rechazado":
            return "CUSTOM_STATE030";
        case "Creando pedido":
            return "CUSTOM_STATE031";
        case "Pedido despachado":
            return "CUSTOM_STATE04";
        case "Pedido entregado":
            return "CUSTOM_STATE05";
        case "Confirmado como recibido":
            return "CUSTOM_STATE06";
    }
}

function randomString()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 16; $i++) {
        $randomString = $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function adminSetQuery()
{
    if (!isset($_SESSION["admin_curOrderby"])) {
        $_SESSION["admin_curOrderby"] = "0";
    }

    $query = $_SESSION["admin_curOrderby"];
    return $query;
}

function adminChecker()
{
    if (isset($_SESSION["data_isAdmin"])) {
        $isadmin = $_SESSION["data_isAdmin"];
        if ($isadmin == true) {
            echo "<script>console.log('user is admin!! :3')</script>";
            return $isadmin;
        } else {
            echo "<script>console.log('user isn't admin >:(')</script>";
            die();
        }
    }
}
