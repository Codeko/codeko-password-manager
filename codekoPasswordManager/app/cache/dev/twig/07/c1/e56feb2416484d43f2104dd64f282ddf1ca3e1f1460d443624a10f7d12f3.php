<?php

/* AcmeLoginPrincipalBundle::layout.html.twig */
class __TwigTemplate_07c1e56feb2416484d43f2104dd64f282ddf1ca3e1f1460d443624a10f7d12f3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        ";
        // line 4
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            echo " 
            <script>window.location.href = \"";
            // line 5
            echo $this->env->getExtension('routing')->getPath("_principal");
            echo "\";</script>
        ";
        }
        // line 7
        echo "        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Password Manager</title>
        ";
        // line 11
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "        ";
        $this->displayBlock('javascript', $context, $blocks);
        // line 21
        echo "
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
          <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>
        <div>
            ";
        // line 30
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 32
        echo "        </div>
    </body>
</html>
";
    }

    // line 11
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 12
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
            <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmeuser/images/favicon.ico"), "html", null, true);
        echo "\" />
            <!-- Bootstrap core CSS -->
            <link href=\"http://getbootstrap.com/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        ";
    }

    // line 17
    public function block_javascript($context, array $blocks = array())
    {
        // line 18
        echo "            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src=\"http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js\"></script>
        ";
    }

    // line 30
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 31
        echo "            ";
    }

    public function getTemplateName()
    {
        return "AcmeLoginPrincipalBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 31,  92 => 30,  86 => 18,  83 => 17,  75 => 13,  70 => 12,  67 => 11,  60 => 32,  58 => 30,  47 => 21,  44 => 17,  42 => 11,  36 => 7,  31 => 5,  27 => 4,  22 => 1,);
    }
}
