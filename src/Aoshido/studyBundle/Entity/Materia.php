<?php

namespace Aoshido\studyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Materia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Materia {

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
     * @var integer
     *
     * @ORM\Column(name="idCarrera", type="integer")
     */
    private $idCarrera;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="Tema", mappedBy="materia",cascade={"persist"})
     */
    protected $temas;

    public function __construct() {
        $this->temas = new ArrayCollection();
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
     * @return Materia
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
     * Set idCarrera
     *
     * @param integer $idCarrera
     * @return Materia
     */
    public function setIdCarrera($idCarrera) {
        $this->idCarrera = $idCarrera;

        return $this;
    }

    /**
     * Get idCarrera
     *
     * @return integer 
     */
    public function getIdCarrera() {
        return $this->idCarrera;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     * @return Materia
     */
    public function setAnio($anio) {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio() {
        return $this->anio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Materia
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
     * Add temas
     *
     * @param \Aoshido\studyBundle\Entity\Tema $temas
     * @return Materia
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
