<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Grupo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Entity\GrupoRepository")
 */
class Grupo
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
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150)
     */
    private $descripcion;

   
    /**
     * @var string
     *
     * @ORM\Column(name="horario", type="string", length=150)
     */
    private $horario;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Nivel", inversedBy="grupos")
     * @ORM\JoinColumn(name="nivel_id", referencedColumnName="id")
     */
    protected $nivel;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="grupo")
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Grupo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Grupo
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Grupo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set horario
     *
     * @param string $horario
     * @return Grupo
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string 
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set nivel
     *
     * @param \UNAM\AppBundle\Entity\Nivel $nivel
     * @return Grupo
     */
    public function setNivel(\UNAM\AppBundle\Entity\Nivel $nivel = null)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \UNAM\AppBundle\Entity\Nivel 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Add cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     * @return Grupo
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
    
    
    
    function getNumero() {
        return $this->numero;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

        
    public function __toString() {
        return "Grupo:".$this->numero." - ".$this->nivel." - ".$this->fechaInicio->format('Y-m-d')."";
    }

}
