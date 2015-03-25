<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Principal</title>
            <link href="../estilos/principal.css" rel="stylesheet">
			<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />

            <!-- Bootstrap core CSS -->
                <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
        </head>
        <body lang="es">

                <main class="container bounceIn animated">
                    <header class="row"><section class="col-md-12 col-xs-12 cabereraMenu"><img id="headerMenu" src="../imagenes/headerMenu.png"/></section></header>
                    <nav class="row">
                        <nav class="col-md-12 col-xs-12 navegadorMenu">

                           <ul class="nav nav-pills">
                                <li role="presentation" class="active"><a role="button" src="#">Principal</a></li>
                                <li role="presentation"><a role="button" src="#">Opcion 1</a></li>
                                <li role="presentation"><a role="button" src="#">Opcion 2</a></li>
                                    <div class="decoracion"></div><div class="decoracion"></div><div class="decoracion"></div>
                            </ul> 

                            <div id="menuMovil">
                                <dropdown>
                                  <input id="toggle2" type="checkbox">
                                      <label for="toggle2" class="animate">☰</label>
                                          <ul class="animate">
                                            <li class="animate">Principal</li>
                                            <li class="animate">Opcion 1</li>
                                            <li class="animate">Opcion 2</li>
                                          </ul>
                                </dropdown>
                            </div>
                        </nav>

                    </nav>
                    <div class="row">
                        <section class="col-md-4 col-xs-6 contenido1Menu">
                            <div class="cajaContenido1">
                                <div class="list-group">
                                    <div class="opciones list-group-item active">
                                        <a href="#"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></a>
                                        <a href="#"><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></a>
                                        <a href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
                                        <a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="#"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                                        <a href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    </div>
                                    <div id="listaCategorias" >
                                        <!--<select data-placeholder="Elige categoria" multiple>
                                            <option class="list-group-item" value="Prueba categoria 1">Prueba categoria 1</option>
                                            <option class="list-group-item" value="Prueba categoria 2">Prueba categoria 2</option>
                                            <option class="list-group-item" value="Prueba categoria 3">Prueba categoria 3</option>
                                            <option class="list-group-item" value="Prueba categoria 4">Prueba categoria 4</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-md-8 col-xs-6 contenido2Menu">
                            <div class="cajaContenido2">
                                <div class="list-group">
                                    <div class="opciones list-group-item active">
                                        <a href="#">Claves</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>

                    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
                        <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
        </body>
    </html>
