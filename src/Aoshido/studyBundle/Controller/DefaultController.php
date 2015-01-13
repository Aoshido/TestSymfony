<?php

namespace Aoshido\studyBundle\Controller;

use Aoshido\studyBundle\Entity\Pregunta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('AoshidostudyBundle:Default:index.html.twig', array('name' => $name));
    }

    public function homepageAction(Request $request) {
        
        $preguntas =  $this->getDoctrine()
                                ->getRepository('AoshidostudyBundle:Pregunta')
                                    ->findAll();
        
        $pregunta = new Pregunta();

        $form = $this->createFormBuilder($pregunta)
                ->add('contenido', 'text')
                ->add('vof', 'choice', array(
                    'choices' => array( TRUE => 'Verdadero', FALSE => 'Falso'),
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

        return $this->render('AoshidostudyBundle:Default:homepage.html.twig', array(
                    'form' => $form->createView(),
                    'preguntas' => $preguntas,
        ));
    }

    public function cargar_preguntas() {

        return $preguntas;
    }

}
