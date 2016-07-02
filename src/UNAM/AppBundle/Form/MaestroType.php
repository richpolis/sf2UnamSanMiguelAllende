<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaestroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('label'=>'Nombre'))
            ->add('apellidoPaterno', 'text', array('label'=>'Apellido paterno'))
            ->add('apellidoMaterno', 'text', array('label'=>'Apellido materno'))
            ->add('email','email',array('label'=>'Email','attr'=>array('class'=>'form-control')))
            ->add('telefono','text',array('label'=>'Telefono','attr'=>array('class'=>'form-control')))    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Maestro'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_maestro';
    }
}
