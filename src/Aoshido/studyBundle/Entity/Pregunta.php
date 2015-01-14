<?php

namespace Aoshido\studyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pregunta
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
     * @ORM\Column(name="Materia", type="text",options={"default":"General"})
     */
    private $materia ;

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
     * Set contenido
     *
     * @param string $contenido
     * @return Pregunta
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
     * Set vof
     *
     * @param boolean $vof
     * @return Pregunta
     */
    public function setVof($vof)
    {
        $this->vof = $vof;

        return $this;
    }

    /**
     * Get vof
     *
     * @return boolean 
     */
    public function getVof()
    {
        return $this->vof;
    }

    /**
     * Set materia
     *
     * @param string $materia
     * @return Pregunta
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return string 
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
