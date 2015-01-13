<?php

namespace Aoshido\studyBundle\Controller;

use Aoshido\studyBundle\Entity\Pregunta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($pregunta);
            $em->flush();
            return $this->redirect($this->generateUrl('preguntas_ABM'));
        }

        return $this->render('AoshidostudyBundle:Default:abmPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'preguntas' => $preguntas,
                    'cantidad' => $cant,
        ));
    }

    public function quizPreguntasAction(Request $request) {

        $resultado = NULL;
        $respuesta = array();

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findAll();
        $id = rand(1, count($preguntas));

        $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($id);

        $form = $this->createFormBuilder($respuesta)
                ->add('vof', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,))
                ->add('Verdad', 'submit', array('label' => 'Verdadero'))
                ->add('Falso', 'submit', array('label' => 'Falso'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $respuesta = $form->getData();
            if ($respuesta['vof'] == $pregunta->getVof()) {
                $resultado = "ENHORABUENACAPO";
            } else {
                $resultado = "skse";
            }
        }

        return $this->render('AoshidostudyBundle:Default:quizPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'pregunta' => $pregunta,
                    'resultado' => $resultado,
        ));
    }

}
