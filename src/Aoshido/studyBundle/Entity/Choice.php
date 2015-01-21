<?php

namespace Aoshido\studyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choice
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Choice
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPregunta", type="integer")
     */
    private $idPregunta;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=1000)
     */
    private $contenido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="correcto", type="boolean")
     */
    private $correcto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPregunta
     *
     * @param integer $idPregunta
     * @return Choice
     */
    public function setIdPregunta($idPregunta)
    {
        $this->idPregunta = $idPregunta;

        return $this;
    }

    /**
     * Get idPregunta
     *
     * @return integer 
     */
    public function getIdPregunta()
    {
        return $this->idPregunta;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Choice
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set correcto
     *
     * @param boolean $correcto
     * @return Choice
     */
    public function setCorrecto($correcto)
    {
        $this->correcto = $correcto;

        return $this;
    }

    /**
     * Get correcto
     *
     * @return boolean 
     */
    public function getCorrecto()
    {
        return $this->correcto;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Choice
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
