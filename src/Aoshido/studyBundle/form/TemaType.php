<?php

namespace Aoshido\studyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TemaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre', 'text', array(
            'label' => 'Tema'
        ));

        $builder->add('activo', 'choice', array(
            'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
            'required' => true,
            'multiple' => false,
            'expanded' => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aoshido\studyBundle\Entity\Tema',
        ));
    }

    public function getName() {
        return 'tema';
    }

}
