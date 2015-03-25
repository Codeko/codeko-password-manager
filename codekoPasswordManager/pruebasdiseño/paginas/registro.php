<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Registro</title>
            <link href="../estilos/style.css" rel="stylesheet">
			<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />

            <!-- Bootstrap core CSS -->
                <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->

            <script type="text/javascript">
                function comprobarClaves(){
                    clave1 = document.getElementById("inputPassword");
                    clave2 = document.getElementById("inputPassword2");

                    if(document.getElementById("inputPassword").value === document.getElementById("inputPassword2").value)  {
                        return true;
                    } else {
                            clave1.focus();
                            clave1.value = "";
                            clave2.value = "";
                            clave1.placeholder = "Las contraseñas no coinciden";
                            clave2.placeholder = "Las contraseñas no coinciden";
                        return false;
                    }
                } 
            </script>
        </head>
        <body lang="es">

                <main class="container">
                      <form class="form-signin bounceIn animated" action="./principal.php" method="post" onsubmit="return comprobarClaves()">
                        <header class="decoracionCabecera"></header>
                            <section class="cuerpoFormulario">
                                <h2 class="form-signin-heading"><img id="headerLogo" src="../imagenes/headerLogo.png"/></h2>
                                <h3>Registro de usuario</h3>
                                    <label for="inputUsuario" class="sr-only">Usuario</label>
                                        <input type="text" id="inputUsuario" class="form-control" placeholder="Nombre de usuario" maxlength="30" title="Introduzca un nombre de usuario" alt = "Nombre de usuario" required>
                                    <label for="inputPassword" class="sr-only">Contraseña</label>
                                        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" maxlength="30" title="Introduzca una contraseña" alt = "Contraseña" required>
                                    <label for="inputPassword2" class="sr-only">Repita la contraseña</label>
                                        <input type="password" id="inputPassword2" class="form-control" placeholder="Repita la contraseña" maxlength="30" title="Repita la contraseña" alt = "Repita contraseña" required>
                                    <label for="inputCorreo" class="sr-only">Correo electrónico</label>
                                        <input type="email" id="inputCorreo" class="form-control" placeholder="Correo electrónico" maxlength="30" title="Correo electrónico" alt = "Repita contraseña" required>
                                <div class="checkbox"></div>
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Registrar">
                                        <div class="nuevoUsuario">
                                            <ul class="nav nav-pills">
                                              <li><a href="../index.php">Volver al login</a></li>
                                            </ul>
                                        </div>
                            </section>
                      </form>
                </main>

                    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
                        <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
        </body>
    </html>
