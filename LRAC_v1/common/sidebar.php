<script src="scripts/stuff.js"></script>
<div id="sidebar">
    <div id="main">
        <div class='main-center'>
            <img type="sidebarBanner" src="files/lrac_banner.png">
        </div>

        <div class="sideitem main-start">
            <?php
            echo "
                <a href='userprofile.php?user={$_SESSION["user_id"]}'>
                    <icon>
                        <img src='files/userpfp/{$_SESSION["user_pfp"]}' type='sideIcon' class='main-nm'>
                    </icon>
                    <div>
                        <p class='main-textcenter main-nmb main-nmt main-textleft' style='max-width: 10rem;'>{$_SESSION["user_name"]}</p>
                        <p s='sub'>Ver perfil</p>
                    </div>
                </a>
            ";
            ?>
        </div>


        <div class="sideitem">
            <a href="cakemaker.php">
                <icon>
                    <script>
                    icon("1.3em", "1.3em", "brush");
                    </script>
                </icon>
                Creador de pasteles
            </a>
        </div>

        <div class="sideitem">
            <a href="catalogue.php?filter=0">
                <icon>
                    <script>
                    document.write(bread)
                    </script>
                </icon>
                Catálogo de productos
            </a>
        </div>

        <div class="sideitem">
            <a href='shopcart.php'>
                <icon>
                    <script>
                    document.write(cartn)
                    </script>
                </icon>
                Tu carrito de compras
            </a>
        </div>

        <div class="sideitem">
            <a href='ordersquery.php'>
                <icon>
                    <script>
                    document.write(track)
                    </script>
                </icon>
                Tus pedidos
            </a>
        </div>

        <div class="sideitem">
            <a href="main.php">
                <icon>
                    <script>
                    document.write(business)
                    </script>
                </icon>
                Sobre nosotros
            </a>
        </div>

        <div class="sideitem">
            <a href='usersindex.php'>
                <icon>
                    <script>
                    document.write(lupa)
                    </script>
                </icon>
                Buscar otros usuarios
            </a>
        </div>

        <?php
        if ($_SESSION["data_isAdmin"]) {
            echo <<<HTML
                    <div class='sideitem'>
                        <a href='adminindex.php'>
                            <icon>
                                <script>
                                    document.write(admin)
                                </script>
                            </icon>
                            Portal de administradores
                        </a>
                    </div>
                    HTML;
        }
        ?>

        <div class="sideitem">
            <a href="conns/logout.php">
                <icon>
                    <script>
                    document.write(logout)
                    </script>
                </icon>
                Cerrar sesión
            </a>
        </div>

    </div>
</div>