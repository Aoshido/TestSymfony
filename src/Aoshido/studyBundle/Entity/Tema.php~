<?php

namespace Aoshido\studyBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tema
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tema {

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="temas")
     * @ORM\JoinColumn(name="idMateria", referencedColumnName="id")
     */
    protected $materia;

    /**
     * @ORM\ManyToMany(targetEntity="Pregunta", mappedBy="temas")
     **/
    private $preguntas;

    public function __construct() {
        $this->preguntas = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Tema
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Tema
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
     * Set materia
     *
     * @param \Aoshido\studyBundle\Entity\Materia $materia
     * @return Tema
     */
    public function setMateria(\Aoshido\studyBundle\Entity\Materia $materia = null)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \Aoshido\studyBundle\Entity\Materia 
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Add preguntas
     *
     * @param \Aoshido\studyBundle\Entity\Pregunta $preguntas
     * @return Tema
     */
    public function addPregunta(\Aoshido\studyBundle\Entity\Pregunta $preguntas)
    {
        $this->preguntas[] = $preguntas;

        return $this;
    }

    /**
     * Remove preguntas
     *
     * @param \Aoshido\studyBundle\Entity\Pregunta $preguntas
     */
    public function removePregunta(\Aoshido\studyBundle\Entity\Pregunta $preguntas)
    {
        $this->preguntas->removeElement($preguntas);
    }

    /**
     * Get preguntas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }
}
