<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PagoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status')
            ->add('descuento')
            ->add('precio')
            ->add('pago')
            ->add('fechaPago')
            ->add('usuarioRegistro')
            ->add('usuarioPago')
            ->add('grupo')
            ->add('alumno')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Pago'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_pago';
    }
}
