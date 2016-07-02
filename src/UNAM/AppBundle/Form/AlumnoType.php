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
            ->add('nombre','text',array('label'=>'Nombre','attr'=>array('class'=>'form-control')))
            ->add('apellidoPadre','text',array('label'=>'Apellido paterno','attr'=>array('class'=>'form-control')))
            ->add('apellidoMadre','text',array('label'=>'Apellido materno','attr'=>array('class'=>'form-control')))
            ->add('file','file',array(
                'label'=>'Foto Alumno',
                'required'=>false,
                'attr'=>array('class'=>'form-control')
            ))
            ->add('imagen','hidden')
            ->add('fechaInscripcion','date',array(
                'label'=>'Fecha de inscripcion',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))    
            ->add('email','text',array('label'=>'Email','attr'=>array('class'=>'form-control')))
            ->add('domicilio','textarea',array('label'=>'Domicilio','attr'=>array('class'=>'form-control')))
            ->add('identificacion','text',array('label'=>'Identificacion','attr'=>array('class'=>'form-control')))
            ->add('telefono','text',array('label'=>'Telefono','attr'=>array('class'=>'form-control')))
            ->add('isBeca',null,array('label'=>'Beca','attr'=>array('class'=>'checkbox-inline')))
            ->add('ocupacion','text',array(
                'label'=>'Ocupacion',
                'attr'=>array('class'=>'form-control')  
                ))
            ->add('comoSeEntero','text',array(
                'label'=>'¿Como se entero del programa?',
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
