<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email','email',array('label'=>'Email','attr'=>array('class'=>'form-control')))
            ->add('password','password',array('label'=>'Password','attr'=>array('class'=>'form-control')))
            ->add('salt','hidden')    
            ->add('nombre','text',array('label'=>'Nombre','attr'=>array('class'=>'form-control')))
            ->add('apellido','text',array('label'=>'Apellidos','attr'=>array('class'=>'form-control')))
            ->add('isActive','hidden')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_usuario';
    }
}
