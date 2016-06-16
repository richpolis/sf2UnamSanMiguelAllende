<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Cursos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Entity\CursosRepository")
 */
class Curso
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
     * @ORM\Column(name="nota", type="integer")
     */
    private $nota;

    
    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="cursos")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;
 
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="cursos")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     */
    protected $alumno;
    
    
   
    

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
     * Set nota
     *
     * @param integer $nota
     * @return Curso
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return integer 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set grupo
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupo
     * @return Curso
     */
    public function setGrupo(\UNAM\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \UNAM\AppBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set alumno
     *
     * @param \UNAM\AppBundle\Entity\Alumno $alumno
     * @return Curso
     */
    public function setAlumno(\UNAM\AppBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \UNAM\AppBundle\Entity\Alumno 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }
    
    public function __toString() {
        return $this->grupo->getFechaInicio()." - ".$this->grupo->getNivel();
    }
}
