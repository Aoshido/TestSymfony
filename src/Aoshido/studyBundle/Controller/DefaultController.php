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

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($preguntas, $this->getRequest()->query->get('page', 1), 10);
        $pagination->setPageRange(6);
        
        $cant = count($preguntas);

        $pregunta = new Pregunta();
        $form = $this->createFormPregunta($pregunta);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pregunta);
            $em->flush();
            return $this->redirect($this->generateUrl('preguntas_ABM'));
        }

        return $this->render('AoshidostudyBundle:Default:abmPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'paginas' => $pagination,
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
                ->add('before','hidden',array('data' => $id))
                ->add('Falso', 'submit', array('label' => 'Falso'))
                ->add('Verdad', 'submit', array('label' => 'Verdadero'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $respuesta = $form->get('Verdad')->isClicked() ? TRUE : FALSE;
            $last_question = $form->getData();
            
            
            $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($last_question['before']);
            
            /*echo "La respuesta tuya fue: " . $respuesta . "Y la respuesta era:" . $pregunta->getVof();
                    die();*/
                    
            if ($respuesta === $pregunta->getVof()) {
                $request->getSession()->getFlashBag()->add('notice', 'La respuesta es Correcta!');
            } else {
                $request->getSession()->getFlashBag()->add('notice', 'La respuesta es Incorrecta!');
            }
            return $this->redirect($this->generateUrl('preguntas_QUIZ'));
        }

        return $this->render('AoshidostudyBundle:Default:quizPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'pregunta' => $pregunta,
                        //'resultado' => $resultado,
        ));
    }
    
    private function createFormPregunta(Pregunta $pregunta){
        
        $form = $this->createFormBuilder($pregunta)
                ->add('contenido', 'text')
                ->add('materia','text')
                ->add('tema','text')
                ->add('respuesta','text')
                ->add('vof', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,
                    'multiple' => false,
                    'expanded' => true,
                ))
                ->add('save', 'submit', array('label' => 'Agregar Pregunta'))
                ->getForm();
        return ($form);
    }

}
