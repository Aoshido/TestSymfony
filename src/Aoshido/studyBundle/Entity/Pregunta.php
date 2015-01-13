<?php

namespace AoshidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Pregunta {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $contenido;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $vof;

}
