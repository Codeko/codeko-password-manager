<?php

/* AcmeLoginPrincipalBundle:Security:base_login.html.twig */
class __TwigTemplate_6435794de0feca6f5907242de9c3884dce46590ac63f6c07c519fcb5ac9b1b92 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("AcmeLoginPrincipalBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeLoginPrincipalBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if (array_key_exists("session", $context)) {
            // line 16
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 17
                echo "            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 18
                    echo "                <div class=\"flash-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo "\">
                    ";
                    // line 19
                    echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                    echo "
                </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "    ";
        }
        // line 24
        echo "
    <main class=\"container\">
        <form class=\"form-signin bounceIn animated\" action=\"";
        // line 26
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\">
            <header class=\"decoracionCabecera\"></header>
            <section class=\"cuerpoFormulario\">
                <h2 class=\"form-signin-heading\"><img id=\"headerLogo\" src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/images/headerLogo.png"), "html", null, true);
        echo "\"/></h2>
                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\" />    
                <label for=\"inputUsuario\" class=\"sr-only\">Usuario</label>
                <input type=\"text\" id=\"inputUsuario\" class=\"form-control\" name=\"_username\" placeholder=\"Nombre de usuario\" maxlength=\"30\" title=\"Introduzca un nombre de usuario\" alt = \"Nombre de usuario\" required>
                <label for=\"inputPassword\" class=\"sr-only\">Contraseña</label>
                <input type=\"password\" id=\"inputPassword\" class=\"form-control\" name=\"_password\" placeholder=\"Contraseña\" maxlength=\"30\" title=\"Introduzca una contraseña\" alt = \"Contraseña\" required>
                <div class=\"checkbox\"></div>
                ";
        // line 36
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            echo " 
                    <div id=\"login-error\" class=\"alert alert-danger\">
                        ";
            // line 38
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message", array()), array(), "FOSUserBundle"), "html", null, true);
            echo "
                    </div>
                ";
        }
        // line 41
        echo "                <button class=\"btn btn-lg btn-success btn-block\" type=\"submit\">Acceder</button>
                <div class=\"nuevoUsuario\">
                    <ul class=\"nav nav-pills\">
                        <li><a href=\"";
        // line 44
        echo $this->env->getExtension('routing')->getPath("_registro");
        echo "\">Registrar nuevo usuario</a></li>
                    </ul>
                </div>
            </section>          
        </form>
    </main>
";
    }

    public function getTemplateName()
    {
        return "AcmeLoginPrincipalBundle:Security:base_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 44,  109 => 41,  103 => 38,  98 => 36,  89 => 30,  85 => 29,  79 => 26,  75 => 24,  72 => 23,  66 => 22,  57 => 19,  52 => 18,  47 => 17,  42 => 16,  39 => 15,  36 => 14,  11 => 12,);
    }
}
