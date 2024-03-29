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
    header("location: $location");
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
                document.documentElement.style.setProperty('--co4fa', 'rgba(121, 146, 173, 20%)')
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
                    document.documentElement.style.setProperty('--co4fa', 'rgba(138, 121, 173, 20%)')
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
        case "strongcyan":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#f7ffff') //white main
                document.documentElement.style.setProperty('--co3', '#e1f9fa') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#6ed7db') //strong main
                document.documentElement.style.setProperty('--co4b', '#5cbbcc') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#4d97b3') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(92, 187, 204, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(92, 187, 204, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;
        case "orange": //HOLIDRIVVEEEE :sob: :sob:
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#FBF3EB') //white main
                document.documentElement.style.setProperty('--co3', '#ffede0') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#FF8C33') //strong main
                document.documentElement.style.setProperty('--co4b', '#FD6904') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#DD5500') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(230, 107, 55, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(230, 107, 55, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;

        case "pinkie":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#fff7ff') //white main
                document.documentElement.style.setProperty('--co3', '#ffe6ff') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#df9ee8') //strong main
                document.documentElement.style.setProperty('--co4b', '#c77fc2') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#b870ac') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(199, 127, 194, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(199, 127, 194, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;

        case "mint":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#ebfff6') //white main
                document.documentElement.style.setProperty('--co3', '#d6ffed') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#7be0b5') //strong main
                document.documentElement.style.setProperty('--co4b', '#5ebf93') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#327858') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(94, 191, 147, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(94, 191, 147, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;

        case "red":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#fff5f5') //white main
                document.documentElement.style.setProperty('--co3', '#ffadad') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#ff3d3d') //strong main
                document.documentElement.style.setProperty('--co4b', '#c42929') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#941e1e') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(196, 41, 41, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(196, 41, 41, 30%)') //darker darker alpha main (make it same as sidebar)
            </script>
            ";
            break;

        case "lily":
            echo "
            <script>
                document.documentElement.style.setProperty('--co1', '#f8f5ff') //white main
                document.documentElement.style.setProperty('--co3', '#efe8ff') //secondary color / gradient
                document.documentElement.style.setProperty('--co4', '#9c81cc') //strong main
                document.documentElement.style.setProperty('--co4b', '#755da1') //dark strong main
                document.documentElement.style.setProperty('--co4u', '#604a87') //darker strong main
                document.documentElement.style.setProperty('--co4ba', 'rgba(117, 93, 161, 70%)') //dark alpha (sidebar) main
                document.documentElement.style.setProperty('--co4fa', 'rgba(117, 93, 161, 30%)') //darker darker alpha main (make it same as sidebar)
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
            echo "<h1>No puedes ver esto porque no eres administrador.</h1>";
            die();
        }
    }
}

function adminconnChecker()
{
    if (isset($_SESSION["data_isAdmin"])) {
        $isadmin = $_SESSION["data_isAdmin"];
        if ($isadmin == true) {
            echo "<script>console.log('user is admin!! :3')</script>";
            return $isadmin;
        } else {
            echo "No puedes hacer esta solicitud porque no eres un administrador.";
            echo "<script>console.log('user isn't admin >:(')</script>";
            die();
        }
    }
}
