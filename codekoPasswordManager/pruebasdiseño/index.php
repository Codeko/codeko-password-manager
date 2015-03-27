<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Password Manager</title>
            <link href="estilos/style.css" rel="stylesheet">
			<link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon.ico" />

            <!-- Bootstrap core CSS -->
                <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
        </head>
        <body lang="es">

                <main class="container">
                    <div class="alert alert-danger" style="display:none">Error al logearte, bla bla bla</div>
                      <form class="form-signin bounceIn animated" action="paginas/principal.php" method="post">
                        <header class="decoracionCabecera"></header>
                            <section class="cuerpoFormulario">
                                <h2 class="form-signin-heading"><img id="headerLogo" src="imagenes/headerLogo.png"/></h2>
                                    <label for="inputUsuario" class="sr-only">Usuario</label>
                                        <input type="text" id="inputUsuario" class="form-control" placeholder="Nombre de usuario" maxlength="30" title="Introduzca un nombre de usuario" alt = "Nombre de usuario" required>
                                    <label for="inputPassword" class="sr-only">Contraseña</label>
                                        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" maxlength="30" title="Introduzca una contraseña" alt = "Contraseña" required>
                                <div class="checkbox"></div>
                                    <button class="btn btn-lg btn-success btn-block" type="submit">Acceder</button>
                                <div class="nuevoUsuario">
                                    <ul class="nav nav-pills">
                                      <li><a href="./paginas/registro.php">Registrar nuevo usuario</a></li>
                                    </ul>
                                </div>
                            </section>
                      </form>
                </main>

                    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
                        <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
        </body>
    </html>
