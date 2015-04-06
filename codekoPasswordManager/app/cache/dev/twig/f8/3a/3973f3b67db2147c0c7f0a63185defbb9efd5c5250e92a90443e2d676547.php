<?php

/* :SonataUserBundle/views/ChangePassword:changePassword_content.html.twig */
class __TwigTemplate_f83a3973f3b67db2147c0c7f0a63185defbb9efd5c5250e92a90443e2d676547 extends Twig_Template
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
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), array(0 => "MopaBootstrapBundle:Form:fields.html.twig"));
        // line 2
        echo "<form action=\"";
        echo $this->env->getExtension('routing')->getPath("sonata_user_change_password");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_change_password form-horizontal\">
    ";
        // line 3
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
    <button type=\"submit\" class=\"btn btn-danger pull-right\"><i class=\"icon-lock icon-white glyphicon glyphicon-lock\"></i>&nbsp;";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("change_password.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button>
</form>
";
    }

    public function getTemplateName()
    {
        return ":SonataUserBundle/views/ChangePassword:changePassword_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 4,  28 => 3,  21 => 2,  19 => 1,);
    }
}
