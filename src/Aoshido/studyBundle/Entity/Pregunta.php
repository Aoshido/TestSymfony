<?php

namespace Aoshido\studyBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pregunta {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenido", type="text")
     */
    private $contenido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Vof", type="boolean")
     */
    private $vof;

    /**
     * @var string
     *
     * @ORM\Column(name="Respuesta", type="text",options={"default":""})
     */
    private $respuesta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean",options={"default":"TRUE"})
     */
    private $activo;

    /**
     * @ORM\ManyToMany(targetEntity="Tema", inversedBy="preguntas")
     * @ORM\JoinTable(name="Preguntas_Temas")
     **/
    private $temas;
    
    /**
     * 
     *
     * @ORM\OneToMany(targetEntity="Choice", mappedBy="pregunta",cascade={"persist"})
     */
    private $choices;

    public function __construct() {
        $this->temas = new ArrayCollection();
        $this->choices = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Pregunta
     */
    public function setContenido($contenido) {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido() {
        return $this->contenido;
    }

    /**
     * Set vof
     *
     * @param boolean $vof
     * @return Pregunta
     */
    public function setVof($vof) {
        $this->vof = $vof;

        return $this;
    }

    /**
     * Get vof
     *
     * @return boolean 
     */
    public function getVof() {
        return $this->vof;
    }

    /**
     * Set respuesta
     *
     * @param string $respuesta
     * @return Pregunta
     */
    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta() {
        return $this->respuesta;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Pregunta
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo() {
        return $this->activo;
    }


    /**
     * Add choices
     *
     * @param \Aoshido\studyBundle\Entity\Choice $choices
     * @return Pregunta
     */
    public function addChoice(\Aoshido\studyBundle\Entity\Choice $choices)
    {
        $this->choices[] = $choices;

        return $this;
    }

    /**
     * Remove choices
     *
     * @param \Aoshido\studyBundle\Entity\Choice $choices
     */
    public function removeChoice(\Aoshido\studyBundle\Entity\Choice $choices)
    {
        $this->choices->removeElement($choices);
    }

    /**
     * Get choices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Add temas
     *
     * @param \Aoshido\studyBundle\Entity\Tema $temas
     * @return Pregunta
     */
    public function addTema(\Aoshido\studyBundle\Entity\Tema $temas)
    {
        $this->temas[] = $temas;

        return $this;
    }

    /**
     * Remove temas
     *
     * @param \Aoshido\studyBundle\Entity\Tema $temas
     */
    public function removeTema(\Aoshido\studyBundle\Entity\Tema $temas)
    {
        $this->temas->removeElement($temas);
    }

    /**
     * Get temas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTemas()
    {
        return $this->temas;
    }
}
