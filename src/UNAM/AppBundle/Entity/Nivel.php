<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Nivel
 *
 * @ORM\Table(name="niveles")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\NivelRepository")
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
     * @ORM\Column(name="nivel", type="string", length=30)
     */
    private $nivel;
    
    /**
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="nivel")
     */
    protected $cursos;
 
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nivel
     *
     * @param string $nivel
     * @return Nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Add cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     * @return Nivel
     */
    public function addCurso(\UNAM\AppBundle\Entity\Curso $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }

    /**
     * Remove cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     */
    public function removeCurso(\UNAM\AppBundle\Entity\Curso $cursos)
    {
        $this->cursos->removeElement($cursos);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCursos()
    {
        return $this->cursos;
    }
}
