<?php

namespace Aoshido\studyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoiceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contenido','text',array(
            'label' => 'Respuesta'
        ));
        
        $builder->add('correcto', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,
                    'multiple' => false,
                    'expanded' => true,
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aoshido\studyBundle\Entity\Choice',
        ));
    }

    public function getName() {
        return 'choice';
    }

}
