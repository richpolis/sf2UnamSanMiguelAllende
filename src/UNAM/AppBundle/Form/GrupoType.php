<?php

namespace UNAM\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use UNAM\AppBundle\Entity\Grupo;

class GrupoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupo', null, array('label'=>'Grupo'))
            ->add('fechaInicio','date',array(
                'label'=>'Fecha de inicio',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))
            ->add('fechaFin','date',array(
                'label'=>'Fecha final',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'attr'=>array('class'=>'form-control')
                ))
            ->add('descripcion','textarea',array('label'=>'Descripcion'))
            ->add('horario','choice',array(
                'label'=>'Horario de clase',
                'empty_value'=>false,
                'choices'=> Grupo::getArrayHorarios(),
                'preferred_choices'=> Grupo::getPreferedHorario(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Hoario',
                    'data-bind'=>'value: horario'
                )))
            ->add('curso', null, array('label'=>'Curso asignado'))
            ->add('maestro', null, array('label'=>'Maestro asignado'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNAM\AppBundle\Entity\Grupo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unam_appbundle_grupo';
    }
}
