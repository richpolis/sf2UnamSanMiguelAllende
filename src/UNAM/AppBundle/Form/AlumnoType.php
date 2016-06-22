<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlumnoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label'=>'Nombre'))
            ->add('apellidoPadre','text',array('label'=>'Apellido paterno'))
            ->add('apellidoMadre','text',array('label'=>'Apellido materno'))
            ->add('file','file',array(
                'label'=>'Foto Alumno',
                'required'=>false,
            ))
            ->add('imagen','hidden')    
            ->add('email','text',array('label'=>'Email'))
            ->add('domicilio','textarea',array('label'=>'Domicilio'))
            ->add('identificacion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Alumno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_alumno';
    }
}
