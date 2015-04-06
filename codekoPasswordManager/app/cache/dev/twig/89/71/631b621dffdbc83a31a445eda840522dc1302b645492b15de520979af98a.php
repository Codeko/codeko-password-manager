<?php

/* AcmeLoginPrincipalBundle:Principal:principal.html.twig */
class __TwigTemplate_8971631b621dffdbc83a31a445eda840522dc1302b645492b15de520979af98a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Principal</title>
        <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/css/principal.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
        <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/images/favicon.ico"), "html", null, true);
        echo "\" />
        <!-- Bootstrap core CSS -->
        <link href=\"http://getbootstrap.com/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
        <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body lang=\"es\">
        <main class=\"container bounceIn animated\">
            <div id=\"logout\">
                ";
        // line 21
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 22
            echo "                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array())), "FOSUserBundle"), "html", null, true);
            echo " |
                    <a href=\"";
            // line 23
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">
                        ";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "
                    </a>
                ";
        }
        // line 27
        echo "            </div>
            <header class=\"row\"><section class=\"col-md-12 col-xs-12 cabereraMenu\"><img id=\"headerMenu\" src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/images/headerMenu.png"), "html", null, true);
        echo "\"/></section></header>
            <nav class=\"row\">
                <nav class=\"col-md-12 col-xs-12 navegadorMenu\">
                    <ul class=\"nav nav-pills\">
                        <li role=\"presentation\" class=\"active\"><a role=\"button\" src=\"#\">Principal</a></li>
                        <li role=\"presentation\"><a role=\"button\" src=\"#\">Opcion 1</a></li>
                        <li role=\"presentation\"><a role=\"button\" src=\"#\">Opcion 2</a></li>
                        <div class=\"decoracion\"></div><div class=\"decoracion\"></div><div class=\"decoracion\"></div>
                    </ul>
                    <div id=\"menuMovil\">
                        <dropdown>
                            <input id=\"toggle2\" type=\"checkbox\">
                            <label for=\"toggle2\" class=\"animate\">☰</label>
                            <ul class=\"animate\">
                                <li class=\"animate\">Principal</li>
                                <li class=\"animate\">Opcion 1</li>
                                <li class=\"animate\">Opcion 2</li>
                            </ul>
                        </dropdown>
                    </div>
                </nav>
            </nav>
            <div class=\"row\">
                <section class=\"col-md-4 col-xs-6 contenido1Menu\">
                    <div class=\"cajaContenido1\">
                        <div class=\"list-group\">
                            <div class=\"opciones list-group-item active\">
                                <a href=\"#\"><span class=\"glyphicon glyphicon-triangle-bottom\" aria-hidden=\"true\"></span></a>
                                <a href=\"#\"><span class=\"glyphicon glyphicon-triangle-top\" aria-hidden=\"true\"></span></a>
                                <a href=\"#\"><span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span></a>
                                <a href=\"#\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a>
                                <a href=\"#\"><span class=\"glyphicon glyphicon-refresh\" aria-hidden=\"true\"></span></a>
                                <a href=\"#\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>
                            </div>
                            <div id=\"listaCategorias\" >
                                <!--<select data-placeholder=\"Elige categoria\" multiple>
                                <option class=\"list-group-item\" value=\"Prueba categoria 1\">Prueba categoria 1</option>
                                <option class=\"list-group-item\" value=\"Prueba categoria 2\">Prueba categoria 2</option>
                                <option class=\"list-group-item\" value=\"Prueba categoria 3\">Prueba categoria 3</option>
                                <option class=\"list-group-item\" value=\"Prueba categoria 4\">Prueba categoria 4</option>
                                </select>-->
                            </div>
                        </div>
                    </div>
                </section>
                <section class=\"col-md-8 col-xs-6 contenido2Menu\">
                    <div class=\"cajaContenido2\">
                        <div class=\"list-group\">
                            <div class=\"opciones list-group-item active\">
                                <a href=\"#\">Claves</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src=\"http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "AcmeLoginPrincipalBundle:Principal:principal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 28,  64 => 27,  58 => 24,  54 => 23,  49 => 22,  47 => 21,  32 => 9,  28 => 8,  19 => 1,);
    }
}
