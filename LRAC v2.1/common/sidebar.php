<script src="scripts/stuff.js"></script>

<div id="sidebar">
    <div id="main">
        <div class='main-rowcenter main-10pxm'>
            <img class='main-nm' type="sidebarBanner" src="files/lrac_banner.png">
        </div>

        <div class="sideitem">
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
        <div class="sideitem main-rowcenter">
            <a href="userconfig.php" class='main-rowcenter main-iconmr0'>
                <script>
                icon("1.8rem", "1.8rem", "config")
                </script>
                <p>Ajustes</p>
            </a>
            <?php
            if ($_SESSION["data_isAdmin"]) {
                echo <<<HTML
                    <a href='adminindex.php' class='main-rowcenter main-iconmr0' style='margin-left: 10px;'>
                        <script>
                            icon("1.8rem", "1.8rem", "admin")
                        </script>
                        <p>Admin</p>
                    </a>
                    HTML;
            }
            ?>
        </div>

        <div class="sideitem">
            <a href="index.php" sb='domargins'>
                <script>
                document.write(business)
                </script>
                <p>Página principal</p>
            </a>
        </div>

        <div class="sideitem">
            <a href="shopcart.php" sb='domargins'>
                <script>
                document.write(cartn);
                </script>
                <p>Carrito de compras</p>
            </a>
        </div>

        <div class="sideitem">
            <a href="catalogue.php?filter=0" sb='domargins'>
                <script>
                document.write(bread)
                </script>
                <p>Catálogo de productos</p>
            </a>
        </div>

        <div class="sideitem">
            <a href="cakemaker.php" sb='domargins'>
                <script>
                icon("1.3em", "1.3em", "brush");
                </script>
                <p>Creador de pasteles</p>
            </a>
        </div>

        <div class="sideitem">
            <a href='usersindex.php' sb='domargins'>
                <script>
                document.write(lupa)
                </script>
                <p>Ver usuarios</p>
            </a>
        </div>

        <div class="sideitem">
            <a href='threads.php' sb='domargins'>
                <script>
                icon("1.3em", "1.3em", "textbubble");
                </script>
                <p>Foros</p>
            </a>
        </div>

        <div class="sideitem">
            <a href='ordersquery.php' sb='domargins'>
                <script>
                document.write(track)
                </script>
                <p>Ver tu pedido activo</p>
            </a>
        </div>

        <div class="sideitem">
            <a href="conns/logout.php" sb='domargins'>
                <script>
                document.write(logout)
                </script>
                <p>Cerrar sesión</p>
            </a>
        </div>

    </div>
</div>

<div id="sidebar_notifs">
    <div class="main-maxw main-columncenter" id='notifs_body'>
        <div class='main-rowcenter main-iconmr'>
            <script>
            icon("2em", "2em", "bell")
            </script>
            <h2 class='main-textcenter' id='text_loading'>Cargando notificaciones...</h2>
        </div>
        <p class='main-nmt' id='text_p'></p>
        <div id='notifs_container' class='main-maxw main-nm main-columncenter'>
            <script>
            //ajax es re melo q hablaaan 
            var translations = {
                "1": {
                    "header": "Alguien comentó en tu perfil",
                    "body": "Revisa tu perfil para ver que opina la gente de tí.",
                    "icon": notifs_bubble
                },
                "2": {
                    "header": "Alguien comentó en tu creación",
                    "body": "Un usuario hizo un comentario en uno de tus pasteles.",
                    "icon": notifs_bubble
                },
                "3": {
                    "header": "Alguien comentó en tu post del foro.",
                    "body": "Un usuario comentó en un post que hiciste en el foro.",
                    "icon": notifs_bubble
                },
                "4": {
                    "header": "Fuiste mencionado en un post!",
                    "body": "Alguien te referenció en un post hecho en el foro, revisalo!",
                    "icon": notifs_at
                },
                "5": {
                    "header": "Tu orden fue actualizada!",
                    "body": "Un administrador actualizó tu orden, entra para saber más detalles.",
                    "icon": notifs_light
                },
                "6": {
                    "header": "Un administrador borró tu foto de perfil",
                    "body": "Esto es una medida de moderación, lamentamos el inconveniente.",
                    "icon": notifs_warning
                },
                "7": {
                    "header": "Un administrador modificó tus datos",
                    "body": "Revisa tu información, esto es una medida de moderación.",
                    "icon": notifs_warning
                },
                "8": {
                    "header": "Tu pedido fue rechazado",
                    "body": "Revisa tu pedido para tener más detalles, lamentamos el inconveniente.",
                    "icon": notifs_sad
                },
                "9": {
                    "header": "Un nuevo producto fue añadido al catálogo",
                    "body": "Tenemos un nuevo producto disponible!",
                    "icon": notifs_stars
                },
                "10": {
                    "header": "Tu post del foro fue borrado por un administrador",
                    "body": "Esto es una medida de moderación, lamentamos el inconveniente.",
                    "icon": notifs_sad
                },
                "11": {
                    "header": "Un comentario tuyo fue borrado por un administrador",
                    "body": "Esto es una medida de moderación, lamentamos el inconveniente.",
                    "icon": notifs_sad
                },
            }

            setInterval(refreshNotifs, 1000);

            function refreshNotifs() {
                //console.log("refreshed notifications!")
                fetch('fetch/checknotifs.php', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(notifications => {
                        var container = document.getElementById("notifs_body");
                        var parent = document.getElementById("notifs_container");

                        // delete notifications to prevent accumulation :3
                        if (parent) {
                            while (parent.firstChild) {
                                parent.removeChild(parent.firstChild);
                            }
                        }

                        if (notifications.length === 0) {
                            document.getElementById("text_loading").textContent = "No tienes notificaciones.";
                            document.getElementById("text_p").textContent = "Aquí aparecerán tus notificaciones importantes.";
                        } else {
                            var num_rows = notifications.length;
                            document.getElementById("text_loading").textContent = `Tienes ${num_rows} notificacion(es).`;
                            document.getElementById("text_p").textContent = "Haz click en cualquier notificación para navegar a ella.";

                            var showClearbt = `
                                <button style='color: rgb(50, 82, 117)' id='clearnotifs_bt'>
                                    Limpiar notificaciones propias
                                </button>
                            `;
                            parent.insertAdjacentHTML('beforeend', showClearbt);

                            notifications.forEach(notification => {
                                var notif_id = notification.notif_id;
                                var notif_type = notification.notif_type;
                                var notif_link = notification.notif_link;
                                var notif_date = notification.notif_date;

                                var proper_date = formatDateSpanish(notif_date);

                                var header = translations[notif_type]["header"];
                                var body = translations[notif_type]["body"];
                                var icon = translations[notif_type]["icon"];

                                var htmlData = `
                                    <div class='main-columncenter'>
                                        <p class='main-smallfont main-nm'>${proper_date}</p>
                                        <a href='${notif_link}' class="notification main-iconmr" data-id='${notif_id}'>
                                            ${icon}
                                            <div class='main-column'>
                                                <h4 class='main-nm'>${header}</h4>
                                                <p class='main-nm'>${body}</p>
                                            </div>
                                        </a>
                                    </div>
                                `;
                                parent.insertAdjacentHTML('beforeend', htmlData);
                            });

                            document.querySelectorAll(".notification").forEach(element => {
                                element.addEventListener("click", function(e) {
                                    e.preventDefault();

                                    var notif_id = this.getAttribute('data-id');
                                    var notif_link = this.getAttribute('href');
                                    console.log(notif_id);

                                    fetch('fetch/deletenotif.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded'
                                            },
                                            body: `id=${encodeURIComponent(notif_id)}`
                                        })
                                        .then(() => {
                                            window.location.href = notif_link;
                                        });
                                });
                            });

                            document.getElementById("clearnotifs_bt").addEventListener("click", function() {
                                fetch('fetch/cleannotifs.php', {
                                        method: 'POST'
                                    })
                                    .then(() => {
                                        refreshNotifs();
                                    });
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

            }

            function formatDateSpanish(dateString) {
                // Create a new date object from the input string
                var date = new Date(dateString);

                // Array to map month names in Spanish
                var monthNames = [
                    "Enero", "Febrero", "Marzo",
                    "Abril", "Mayo", "Junio",
                    "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ];

                // Get the day, month, and year components
                var day = date.getDate();
                var monthIndex = date.getMonth();
                var year = date.getFullYear();

                // Format the date string
                var formattedDate = `${monthNames[monthIndex]} ${day} del ${year}`;

                return formattedDate;
            }
            </script>
        </div>
    </div>
</div>

<!--
ALL NOTIFICATIONS:

-- SOCIAL --
(! = DONE)
(X = DISCARDED)
1 = comment on profile (comment) !
2 = comment on creation (comment) !
3 = comment on forum post (comment) !
4 = mentioned in forum post (@a) !
5 = admin updated your order (warning) !
6 = admin deleted your profile picture (warning) !
7 = admin modified your data (warning) !
8 = admin rejected your order (warning) !
9 = new product on the catalogue (star) X
10 = admin deleted your forum post
11 = admin deleted a comment of yours

-->