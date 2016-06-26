<?php

namespace UNAM\AppBundle\Twig;

class DescuentoExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('descuento', array($this, 'descuentoFilter')),
        );
    }

    public function descuentoFilter($number)
    {
        if($number >= 10){
            $output = "" + $number + "%";
        }else{
            $output = "0" + $number + "%";
        }    
        return $output;
    }

    public function getName()
    {
        return 'descuento_extension';
    }
}
