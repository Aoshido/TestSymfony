<?php

namespace Aoshido\studyBundle\form;

use Aoshido\studyBundle\form\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contenido', 'text', array(
            'label' => 'Pregunta:'
        ));

        $builder->add('respuesta', 'text', array(
            'label' => 'Respuesta'
        ));
        
        //$builder->add('Tema',new TemaType());

        $builder->add('activo', 'choice', array(
            'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
            'required' => true,
            'multiple' => false,
            'expanded' => true,
        ));

        $builder->add('vof', 'choice', array(
            'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
            'required' => true,
            'multiple' => false,
            'expanded' => true,
        ));

        $builder->add('choices', 'collection', array(
            'type' => new ChoiceType(),
        ));

        $builder->add('save', 'submit', array(
            'label' => 'Agregar',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aoshido\studyBundle\Entity\Pregunta',
        ));
    }

    public function getName() {
        return 'pregunta';
    }

}
