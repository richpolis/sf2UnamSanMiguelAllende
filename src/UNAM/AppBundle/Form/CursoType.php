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
            ->add('nombreCurso')
            ->add('nota')
            ->add('isIngles')
            ->add('nivel')
            ->add('grupo')
            ->add('precios')
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
