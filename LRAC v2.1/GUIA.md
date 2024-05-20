## GUIA DE ARCHIVOS 

### bd/
- `lrac_bd.sql` = Base de datos del sitio (incluye comando "CREATE", solo importar en phpmyadmin)

### common/
Módulos que importan otras paginas
- `comments.php` = Modulo para comentarios, se incluye en el archivo php que desee que aparezca el modulo.
- `navbar.php` = Modulo de la barra de navegación superior, se incluye en páginas que se desee que aparezca la barra de navegación.
- `products.php` = Modulo que carga el catálogo de productos (solo se usa en catalogue.php)
- `sidebar.php` = Modulo de la barra lateral, necesita de la navbar, que contiene el botón para abrir aquella sidebar.


### conns/
Peticiones que se hacen al servidor
- `access.php` = Código de iniciar sesión y registro de cuenta, usa método post.
- `accrecovery.php` = Código que consulta lo relacionado a la recuperación de la cuenta, usa método post.
- `admineditorder.php` = Código con las solicitudes relacionadas a editar ordenes, usa metodos post y get.
- `adminmngusers.php` = Código que envia solicitudes relacionadas al manejo de usuarios, usa metodos post y get.
- `adminmodifyprod.php` Código que se encarga de editar productos y borrarlos, usa post mayormente.
- `adminuploadprod.php` = Código para subir productos al catalogo, usa post.
- `cancelorder.php` = Código que manda la petición para cancelar la orden del usuario.
- `conexion.php` = Conexión con base de datos e inicialización de $_SESSION, también guarda el nombre base de la página.
- `confirmReceived.php` = Petición del usuario para confirmar una orden recibida.
- `createcustomcake.php` = Petición para crear un pastel personalizado, usa GET.
- `createorder.php` = Petición del usuario para crear una orden en base a su carrito, usa POST y GET.
- `createpost.php` = Petición del usuario para crear un comentario, usa POST.
- `deletecreation.php` = Borra un pastel personalizado por parte del usuario, usa GET.
- `deletethreadpost.php` = Borra un post del foro por parte del usuario, usa GET.
- `logout.php` = Cierra sesión, limpia las variables de session y establece que el usuario no está loggeado.
- `scproduct.php` = Código que maneja añadir/borrar un producto del carrito.
- `threadcreate.php` = Petición del usuario para crear un post de foro, usa POST.
- `usermodifyacc.php` = Código que maneja editar información del usuario loggeado, usa POST o GET dependiendo del contexto.

### debug/
- `view_session_vars.php` = Página cruda solo para ver las variables session activas, solo se puede ver si es admin.

### fetch/
Peticiones asíncronas con la base de datos
- `checkavail.php` = Código que se ejecuta al elegir una opción en un producto del catálogo, para verificar si ya está añadido o no.
- `checkifcake.php` = Petición del creador de pasteles para verificar si el codigo del pastel creado existe para permitir su creación.
- `checknotifs.php` = Código que obtiene las notificaciones del usuario logeado.
- `cleannotifs.php` = Petición para borrar las notificaciones del usuario logeado.
- `deletenotif.php` = Petición para borrar una notificación individualmente dado al que el usuario ya le dió click.

### files/
Archivos de la página, productos, imagenes, assets del creador de pasteles, sonidos, etc.

### phpfuncs/
Funciones de php usadas en otras páginas
- `main.php` = Módulo principal para todas las funciones como formatear fechas y precios, enviar popups, etc.

### scripts/
Scripts Javascript
- `dialog.js` = no sé q hace eso ahi eso esta vacio jaja (me da hueva borrarlo)
- `icons.js` = Todos los iconos usados en el sitio, usa document.write para mostrarlos (pq no usé append)
- `newcreator.js` = Código completo y nuevo del creador de pasteles, tiene 1000 lineas, no lo vean jaja
- `oldcreator.js` = Código incompleto viejo del creador de pasteles, el que se mostró en la pre-sustentación
- `stuff.js` = Generalidades y funciones, como renderizar y esconder los popups, el codigo para la sidebar y navbar, etc.

### Archivos sin carpeta (las 24 páginas del sitio)
- `adminconfirmation.php` = Página para confirmar acciones o peticiones a la base de datos
- `adminindex.php` = Página principal para los admins
- `adminorders.php` = Página de administradores para manejar ordenes
- `adminprodmng.php` = Página para administrar el catálogo
- `adminusers.php` = Página de admins para manejar la base de usuarios
- `bridge_order.php` = Recibo del pedido activo
- `cakemaker.php` = Creador de pasteles
- `catalogue.php` = Catálogo de productos
- `index.php` = Página principal
- `login.php` = Login de usuario
- `ordersquery.php` = Página para ver el pedido activo
- `recover.php` = Pagina de recuperar cuenta
- `sharedorder.php` = Pagina para ver ordenes compartidas
- `shopcart.php` = Pagina para ver el carrito de compras
- `signin.php` = Página para registro de usuario
- `style.css` = CSS universal
- `threadpost.php` = Página para ver un post del foro
- `threads.php` =  Foro del sitio
- `threads_create.php` = Apartado para crear un post para el foro
- `usercomments.php` = Apartado para ver comentarios de un usuario
- `userconfig.php` = Pagina para opciones del perfil del usuario
- `userorders.php` = Apartado para ver ordenes de otros usuarios
- `usersindex.php` = Index de perfiles de usuarios registrados en el sitio
- `viewproduct.php` = Página para ver información de un producto del catalogo
