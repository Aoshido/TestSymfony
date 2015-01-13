<?php

namespace Aoshido\studyBundle\Controller;

use Aoshido\studyBundle\Entity\Pregunta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AoshidostudyBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function homepageAction(Request $request)
    {
        $pregunta = new Pregunta();
        
        $form = $this->createFormBuilder($pregunta)
                ->add('contenido','text')
                ->add('vof','boolean')
                ->getForm();
        
        return $this->render('AoshidostudyBundle:Default:homepage.html.twig',array(
            'form' => $form->createView(),
        ));
    }
    public function cargar_preguntas()
    {
        
        return $preguntas;
    }
}
