<?php

namespace Aoshido\studyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AoshidostudyBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function homepageAction()
    {
        return $this->render('AoshidostudyBundle:Default:homepage.html.twig');
    }
    public function cargar_preguntas()
    {
        
        return $preguntas;
    }
}
