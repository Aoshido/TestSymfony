<?php

namespace Aoshido\studyBundle\Controller;

use Aoshido\studyBundle\Entity\Choice;
use Aoshido\studyBundle\Entity\Pregunta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('AoshidostudyBundle::index.html.twig');
    }
    
    public function bioAction() {
        return $this->render('AoshidostudyBundle::bio.html.twig');
    }

    public function abmPreguntasAction(Request $request) {

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findBy(array('activo' => TRUE));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($preguntas, $this->getRequest()->query->get('page', 1), 10);
        $pagination->setPageRange(6);

        $cant = count($preguntas);

        $pregunta = new Pregunta();
        $form = $this->createFormPregunta($pregunta);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $choice = new Choice();
            
            $choice->setCorrecto($pregunta->getVof());
            $choice->setContenido($pregunta->getRespuesta());
            $choice->setActivo(TRUE);
            
            $pregunta->addChoice($choice);
            $pregunta->setActivo(TRUE);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pregunta);
            $em->flush();
            return $this->redirect($this->generateUrl('preguntas_ABM'));
        }

        return $this->render('AoshidostudyBundle:ABM:newForm.html.twig', array(
                    'form' => $form->createView(),
                    'paginas' => $pagination,
                    'cantidad' => $cant,
        ));
    }

    public function editPreguntasAction(Request $request, $id) {

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findBy(array('activo' => TRUE));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($preguntas, $this->getRequest()->query->get('page', 1), 10);
        $pagination->setPageRange(6);

        $cant = count($preguntas);

        $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($id);

        $form = $this->editFormPregunta($pregunta);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $pregunta->setActivo(TRUE);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pregunta);
            $em->flush();
            return $this->redirect($this->generateUrl('preguntas_ABM'));
        }

        return $this->render('AoshidostudyBundle:ABM:editForm.html.twig', array(
                    'form' => $form->createView(),
                    'paginas' => $pagination,
                    'cantidad' => $cant,
        ));
    }

    public function deletePreguntasAction(Request $request, $id) {

        $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($id);

        $pregunta->setActivo(FALSE);
        $request->getSession()->getFlashBag()->add('warning', 'Pregunta nro ' . $id . ' eliminada!');

        $em = $this->getDoctrine()->getManager();
        $em->persist($pregunta);
        $em->flush();

        return $this->redirect($this->generateUrl('preguntas_ABM'));
    }

    public function quizPreguntasAction(Request $request) {

        $resultado = NULL;
        $respuesta = array();

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findBy(array('activo' => TRUE));

        $id = rand(1, count($preguntas));

        $pregunta = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->find($id);

        $form = $this->createFormBuilder($respuesta)
                ->add('before', 'hidden', array('data' => $id))
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

            if ($respuesta === $pregunta->getVof()) {
                $request->getSession()->getFlashBag()->add('success', 'La respuesta es Correcta!');
            } else {
                $request->getSession()->getFlashBag()->add('error', 'La respuesta es Incorrecta!');
            }
            return $this->redirect($this->generateUrl('preguntas_QUIZ'));
        }

        return $this->render('AoshidostudyBundle:Quiz:quizPreguntas.html.twig', array(
                    'form' => $form->createView(),
                    'pregunta' => $pregunta,
        ));
    }

    private function createFormPregunta(Pregunta $pregunta) {

        $form = $this->createFormBuilder($pregunta)
                ->add('contenido', 'text')
                ->add('respuesta', 'text')
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

    private function editFormPregunta(Pregunta $pregunta) {

        $form = $this->createFormBuilder($pregunta)
                ->add('contenido', 'text')
                ->add('respuesta', 'text')
                ->add('vof', 'choice', array(
                    'choices' => array(TRUE => 'Verdadero', FALSE => 'Falso'),
                    'required' => true,
                    'multiple' => false,
                    'expanded' => true,
                ))
                ->add('save', 'submit', array('label' => 'Editar Pregunta'))
                ->getForm();
        return ($form);
    }

    public function cardsIndexAction(Request $request) {

        $preguntas = $this->getDoctrine()
                ->getRepository('AoshidostudyBundle:Pregunta')
                ->findBy(array('activo' => TRUE));


        return $this->render('AoshidostudyBundle:Cards:cardsIndex.html.twig', array(
                    'preguntas' => $preguntas,
        ));
    }

}
