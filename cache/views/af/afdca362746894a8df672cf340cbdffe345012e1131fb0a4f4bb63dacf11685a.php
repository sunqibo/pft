<?php

/* layout.html */
class __TwigTemplate_0395a8647e5e2787c430e1d20add251fa662381ae7be655661c5c6c00ddb4fd7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Document</title>
</head>
<body>
<content>
    ";
        // line 9
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "</content>
<footer>footer</footer>
</body>
</html>";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  46 => 10,  43 => 9,  36 => 12,  34 => 9,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html", "/Users/sunqibo/www/my/MF/app/views/layout.html");
    }
}
