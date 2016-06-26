<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrecioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precio',null, array('label'=>'Precio'))
            ->add('fechaInicio','date',array(
                'label'=>'Vigencia inicial',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))
            ->add('fechaFinal','date',array(
                'label'=>'Vigencia final',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Precio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_precio';
    }
}
