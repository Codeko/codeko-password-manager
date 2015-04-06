<?php

/* AcmeLoginPrincipalBundle:Registro:registro.html.twig */
class __TwigTemplate_667d28dc279380e4bb67e3d63bb5e359068e3ce4f8c526ee9ffe55eb37f4a6d8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("AcmeLoginPrincipalBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

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

    // line 2
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        if (array_key_exists("session", $context)) {
            // line 4
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 5
                echo "            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 6
                    echo "                <div class=\"flash-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo "\">
                    ";
                    // line 7
                    echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                    echo "
                </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 10
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "    ";
        }
        // line 12
        echo "
    <script type=\"text/javascript\">
        function comprobarClaves() {
            clave1 = document.getElementById(\"inputPassword\");
            clave2 = document.getElementById(\"inputPassword2\");

            if (document.getElementById(\"inputPassword\").value === document.getElementById(\"inputPassword2\").value) {
                return true;
            } else {
                clave1.focus();
                clave1.value = \"\";
                clave2.value = \"\";
                clave1.placeholder = \"Las contraseñas no coinciden\";
                clave2.placeholder = \"Las contraseñas no coinciden\";
                return false;
            }
        }
    </script>

    <main class=\"container\">
        <form action=\"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_registration_register form-signin bounceIn animated\" onsubmit=\"return comprobarClaves()\">
            <header class=\"decoracionCabecera\"></header>
            <section class=\"cuerpoFormulario\">
                <h2 class=\"form-signin-heading\"><img id=\"headerLogo\" src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/images/headerLogo.png"), "html", null, true);
        echo "\"/></h2>
                <h3>Registro de usuario</h3>   
                ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
                <!--
                <label for=\"inputUsuario\" class=\"sr-only\">Usuario</label>
                <input type=\"text\" id=\"inputUsuario\" class=\"form-control\" placeholder=\"Nombre de usuario\" maxlength=\"30\" title=\"Introduzca un nombre de usuario\" alt = \"Nombre de usuario\" required name=\"fos_user_registration_form[username]\">
                <label for=\"inputPassword\" class=\"sr-only\">Contraseña</label>
                <input type=\"password\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Contraseña\" maxlength=\"30\" title=\"Introduzca una contraseña\" alt = \"Contraseña\" name=\"fos_user_registration_form[plainPassword][first]\" required>
                <label for=\"inputPassword2\" class=\"sr-only\">Repita la contraseña</label>
                <input type=\"password\" id=\"inputPassword2\" class=\"form-control\" placeholder=\"Repita la contraseña\" maxlength=\"30\" title=\"Repita la contraseña\" alt = \"Repita contraseña\" name=\"fos_user_registration_form[plainPassword][second]\" required>
                <label for=\"inputCorreo\" class=\"sr-only\">Correo electrónico</label>
                <input type=\"email\" id=\"inputCorreo\" class=\"form-control\" placeholder=\"Correo electrónico\" maxlength=\"30\" title=\"Correo electrónico\" alt = \"Correo electrónico\" name=\"fos_user_registration_form[email]\" required>
                -->
                <div class=\"checkbox\"></div>
                <input class=\"btn btn-lg btn-success btn-block\" type=\"submit\" value=\"Registrar\">
                <div class=\"nuevoUsuario\">
                    <ul class=\"nav nav-pills\">
                        <li><a href=\"";
        // line 52
        echo $this->env->getExtension('routing')->getPath("_login");
        echo "\">Volver al login</a></li>
                    </ul>
                </div>
            </section>
        </form>
    </main>
";
    }

    public function getTemplateName()
    {
        return "AcmeLoginPrincipalBundle:Registro:registro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 52,  110 => 37,  105 => 35,  97 => 32,  75 => 12,  72 => 11,  66 => 10,  57 => 7,  52 => 6,  47 => 5,  42 => 4,  39 => 3,  36 => 2,  11 => 1,);
    }
}
