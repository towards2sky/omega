<?php

/* core/modules/system/templates/system-themes-page.html.twig */
class __TwigTemplate_e8d65f110b18bacb1eaa3ff196b8688dd0fda990e3b759a9d27d082c6173bcd3 extends Twig_Template
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
        // line 33
        echo "<div";
        echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["theme_groups"]) ? $context["theme_groups"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme_group"]) {
            // line 35
            echo "    ";
            // line 36
            $context["theme_group_classes"] = array(0 => "system-themes-list", 1 => ("system-themes-list-" . $this->getAttribute(            // line 38
$context["theme_group"], "state", array())), 2 => "clearfix");
            // line 42
            echo "    <div";
            echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["theme_group"], "attributes", array()), "addClass", array(0 => (isset($context["theme_group_classes"]) ? $context["theme_group_classes"] : null)), "method"), "html", null, true);
            echo ">
      <h2 class=\"system-themes-list__header\">";
            // line 43
            echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme_group"], "title", array()), "html", null, true);
            echo "</h2>
      ";
            // line 44
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["theme_group"], "themes", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 45
                echo "        ";
                // line 46
                $context["theme_classes"] = array(0 => (($this->getAttribute(                // line 47
$context["theme"], "is_default", array())) ? ("theme-default") : ("")), 1 => (($this->getAttribute(                // line 48
$context["theme"], "is_admin", array())) ? ("theme-admin") : ("")), 2 => "theme-selector", 3 => "clearfix");
                // line 53
                echo "        <div";
                echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["theme"], "attributes", array()), "addClass", array(0 => (isset($context["theme_classes"]) ? $context["theme_classes"] : null)), "method"), "html", null, true);
                echo ">
          ";
                // line 54
                if ($this->getAttribute($context["theme"], "screenshot", array())) {
                    // line 55
                    echo "            ";
                    echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "screenshot", array()), "html", null, true);
                    echo "
          ";
                }
                // line 57
                echo "          <div class=\"theme-info\">
            <h3 class=\"theme-info__header\">";
                // line 59
                echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "name", array()), "html", null, true);
                echo " ";
                echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "version", array()), "html", null, true);
                // line 60
                if ($this->getAttribute($context["theme"], "notes", array())) {
                    // line 61
                    echo "                (";
                    echo $this->env->getExtension('drupal_core')->renderVar(twig_drupal_join_filter($this->getAttribute($context["theme"], "notes", array()), ", "));
                    echo ")";
                }
                // line 63
                echo "</h3>
            <div class=\"theme-info__description\">";
                // line 64
                echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "description", array()), "html", null, true);
                echo "</div>
            ";
                // line 66
                echo "            ";
                if ($this->getAttribute($context["theme"], "incompatible", array())) {
                    // line 67
                    echo "              <div class=\"incompatible\">";
                    echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "incompatible", array()), "html", null, true);
                    echo "</div>
            ";
                } else {
                    // line 69
                    echo "              ";
                    echo $this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["theme"], "operations", array()), "html", null, true);
                    echo "
            ";
                }
                // line 71
                echo "          </div>
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/system-themes-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 76,  109 => 74,  101 => 71,  95 => 69,  89 => 67,  86 => 66,  82 => 64,  79 => 63,  74 => 61,  72 => 60,  68 => 59,  65 => 57,  59 => 55,  57 => 54,  52 => 53,  50 => 48,  49 => 47,  48 => 46,  46 => 45,  42 => 44,  38 => 43,  33 => 42,  31 => 38,  30 => 36,  28 => 35,  24 => 34,  19 => 33,);
    }
}
