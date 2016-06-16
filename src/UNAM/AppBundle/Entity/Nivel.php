<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Nivel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Entity\NivelRepository")
 */
class Nivel
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
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    
    /**
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="nivel")
     */
    protected $grupos;
 
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nombre
     *
     * @param string $nombre
     * @return Nivel
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add grupos
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupos
     * @return Nivel
     */
    public function addGrupo(\UNAM\AppBundle\Entity\Grupo $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\UNAM\AppBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }
    
    public function __toString() {
        return $this->nombre;
    }

}
