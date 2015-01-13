<?php

namespace Aoshido\studyBundle\Controller;

use Aoshido\studyBundle\Entity\Pregunta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('AoshidostudyBundle:Default:index.html.twig');
    }

    public function abmPreguntasAction(Request $request) {

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findAll();
        
        $cant = count($preguntas);

        $pregunta = new Pregunta();

        $form = $this->createFormBuilder($pregunta)
                ->add('contenido', 'text')
                ->add('vof', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,
                ))
                ->add('save', 'submit', array('label' => 'Agregar Pregunta'))
                ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($pregunta);
            $em->flush();
        }

        return $this->render('AoshidostudyBundle:Default:abmPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'preguntas' => $preguntas,
                    'cantidad' => $cant,
        ));
    }

    public function quizPreguntasAction(Request $request) {

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findAll();

        $id = rand(1, count($preguntas));

        $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($id);

        $respuesta = array();
        $form = $this->createFormBuilder($respuesta)
                ->add('vof', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,))
                ->add('save', 'submit', array('label' => 'Responder!'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $respuesta = $form->getData();
            
            if ($respuesta['vof'] == $pregunta->getVof()){
                echo "ENHORABUENACAPO";
            }else{
                echo "skse";
            }
        }

        return $this->render('AoshidostudyBundle:Default:quizPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'pregunta' => $pregunta,
        ));
    }

}
