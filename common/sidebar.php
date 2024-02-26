<script src="scripts/stuff.js"></script>
<div id="sidebar">
    <div id="main">
        <img type="banner" src="files/lrac_banner.png">

        <div class="sideitem main-start">
            <a href="userconfig.php">
                <icon>
                    <img src="files/userpfp/<?php echo $_SESSION["user_pfp"] ?>" type="sideIcon" class='main-nm'>
                </icon>
                <div>
                    <p class='main-textcenter main-nmb main-nmt main-textleft' style='max-width: 10rem;'><?php echo $_SESSION["user_name"] ?></p>
                    <p s="sub">Configurar cuenta</p>
                </div>
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
            <a>
                <icon>
                    <script>
                        document.write(lupa)
                    </script>
                </icon>
                Buscar otros usuarios
            </a>
        </div>

        <div class="sideitem">
            <a href='ordersquery.php'>
                <icon>
                    <script>
                        document.write(track)
                    </script>
                </icon>
                Consultar pedido activo
            </a>
        </div>

        <?php
        if ($_SESSION["data_isAdmin"]) {
            echo "
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
                ";
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