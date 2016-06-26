<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use UNAM\AppBundle\Entity\Pago;
use UNAM\AppBundle\Form\DataTransformer\UsuarioToNumberTransformer;

class PagoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        //$is_super_admin = $options['is_super_admin'];
        $usuarioTransformer = new UsuarioToNumberTransformer($em);
        
        $builder
            ->add('status','choice',array(
                'label'=>'Status del pago',
                'empty_value'=>false,
                'read_only'=> true,
                'choices'=> Pago::getArrayStatus(),
                'preferred_choices'=> Pago::getPreferedStatus(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Status',
                    'data-bind'=>'value: status'
                )))    
            ->add('descuento','choice',array(
                'label'=>'Descuento',
                'empty_value'=>false,
                'read_only'=> false,
                'choices'=> Pago::getArrayDescuentos(),
                'preferred_choices'=> Pago::getPreferedDescuento(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Status',
                    'data-bind'=>'value: status',
                    'onchange' => 'cambioPrecioOPago()'
                )))
            ->add('precio',null, array(
                'label'=>'Precio del curso',
                'read_only'=> true,
                'attr'=>array('onchange'=>'cambioPrecioOPago()')
                ))
            ->add('pago',null, array('label'=>'Pago realizado'))
            ->add('adeudo','hidden')    
            ->add('fechaPago','date',array(
                'label'=>'Fecha de pago',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))
            ->add($builder->create('usuarioRegistro', 'hidden')->addModelTransformer($usuarioTransformer))
            ->add($builder->create('usuarioPago','hidden')->addModelTransformer($usuarioTransformer))
            ->add('grupo', null, array('label'=>'Grupo asignado','attr'=>array('onchange'=>'cambioGrupo()')))
            ->add('alumno',null, array('label'=>'Alumno'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Pago'
        ))
        ->setRequired(array('em'))
        ->setAllowedTypes(array('em'=>'Doctrine\Common\Persistence\ObjectManager'))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_pago';
    }
}
