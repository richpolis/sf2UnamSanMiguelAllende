<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreCurso','text',array('label'=>'Nombre del curso'))
            ->add('nota','textarea',array('label'=>'Observaciones'))
            ->add('isIngles',null,array('label'=>'Es curso de ingles?',
                'attr'=>array('class'=>'checkbox-inline')
                ))
            ->add('nivel',null,array('label'=>'Nivel'))
            ->add('precio','money',array('label'=>'Precio',
                    'currency'=>'MXN',
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
            'data_class' => 'UNAM\AppBundle\Entity\Curso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_curso';
    }
}
