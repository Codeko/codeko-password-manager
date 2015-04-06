<?php

/* :SonataUserBundle/views/Security:base_login.html.twig */
class __TwigTemplate_36101c2de8814b88970dc9c7ff1c584548e6187746a8cdcf02fcb79bf4a96974 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataUserBundle::layout.html.twig");
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
        return "SonataUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"panel panel-info\">

                <div class=\"panel-heading\">
                    <h2 class=\"panel-title\">";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_authentication", array(), "SonataUserBundle"), "html", null, true);
        echo "</h2>
                </div>

                <div class=\"panel-body\">

                    ";
        // line 25
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 26
            echo "                        <div class=\"alert alert-danger alert-error\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), array(), "FOSUserBundle"), "html", null, true);
            echo "</div>
                    ";
        }
        // line 28
        echo "
                    <form action=\"";
        // line 29
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\" role=\"form\"
                          class=\"form-horizontal\">
                        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\"/>

                        <div class=\"form-group\">
                            <label for=\"username\"
                                   class=\"col-lg-3 col-sm-3 control-label\">";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>

                            <div class=\"col-lg-9 col-sm-9\"><input type=\"text\" class=\"form-control\" id=\"username\"
                                                                  name=\"_username\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\"
                                                                  required=\"required\"/></div>
                        </div>


                        <div class=\"form-group control-group\">
                            <label for=\"password\"
                                   class=\"col-lg-3 col-sm-3 control-label\">";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>

                            <div class=\"col-lg-9 col-sm-9\"><input type=\"password\" class=\"form-control\" id=\"password\"
                                                                  name=\"_password\" required=\"required\"/></div>
                        </div>

                        <div class=\"form-group\">
                            <div class=\"col-sm-offset-3 col-sm-9\">
                                <div class=\"checkbox control-group\">
                                    <label for=\"remember_me\">
                                        <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"/>
                                        ";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class=\"form-group control-group\">
                            <div class=\"controls col-sm-offset-3 col-sm-9\">
                                <a href=\"";
        // line 64
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("forgotten_password", array(), "SonataUserBundle"), "html", null, true);
        echo "</a>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <div class=\"col-sm-offset-3 col-sm-9\">
                                <input type=\"submit\" id=\"_submit\" name=\"_submit\" class=\"btn btn-primary\"
                                       value=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class=\"col-md-6\">
            ";
        // line 80
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('http_kernel')->controller("FOSUserBundle:Registration:register"), array());
        // line 81
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return ":SonataUserBundle/views/Security:base_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 81,  142 => 80,  130 => 71,  118 => 64,  107 => 56,  93 => 45,  83 => 38,  77 => 35,  70 => 31,  65 => 29,  62 => 28,  56 => 26,  54 => 25,  46 => 20,  39 => 15,  36 => 14,  11 => 12,);
    }
}
