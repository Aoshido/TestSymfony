<?php

namespace Aoshido\studyBundle\form;

use Aoshido\studyBundle\form\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('contenido');
        $builder->add('vof');
        $builder->add('respuesta');

        $builder->add('choices', 'collection', array(
            'type' => new ChoiceType(),
            'allow_add' => true,
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
