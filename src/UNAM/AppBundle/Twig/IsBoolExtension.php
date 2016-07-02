<?php

namespace UNAM\AppBundle\Twig;

class IsBoolExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('isBool', array($this, 'isBoolFilter')),
        );
    }
    public function isBoolFilter($is_active)
    {
        if($is_active){
            $img='<span class="glyphicon glyphicon-ok" aria-hidden=true></span>';
        }else{
            $img='<span class="glyphicon glyphicon-remove" aria-hidden=true></span>';
        }
        
        return $img;
    }
    public function getName()
    {
        return 'is_bool_extension';
    }
}