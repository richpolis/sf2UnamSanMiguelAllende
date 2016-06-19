<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Grupo
 *
 * @ORM\Table(name="grupos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\GrupoRepository")
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
     * @ORM\Column(name="grupo", type="string", length=30)
     */
    private $grupo;
    
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
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="grupo")
     */
    protected $cursos;
    
    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="grupo")
     */
    protected $pagos;
    
    /**
     * @ORM\ManyToOne(targetEntity="Maestro", inversedBy="grupos")
     * @ORM\JoinColumn(name="maestro_id", referencedColumnName="id")
     */
    protected $maestro;
    
   
    public function __toString() {
        return "Grupo:".$this->numero." - ".$this->nivel." - ".$this->fechaInicio->format('Y-m-d')."";
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pagos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set grupo
     *
     * @param string $grupo
     * @return Grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string 
     */
    public function getGrupo()
    {
        return $this->grupo;
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

    /**
     * Add pagos
     *
     * @param \UNAM\AppBundle\Entity\Pago $pagos
     * @return Grupo
     */
    public function addPago(\UNAM\AppBundle\Entity\Pago $pagos)
    {
        $this->pagos[] = $pagos;

        return $this;
    }

    /**
     * Remove pagos
     *
     * @param \UNAM\AppBundle\Entity\Pago $pagos
     */
    public function removePago(\UNAM\AppBundle\Entity\Pago $pagos)
    {
        $this->pagos->removeElement($pagos);
    }

    /**
     * Get pagos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * Set maestro
     *
     * @param \UNAM\AppBundle\Entity\Maestro $maestro
     * @return Grupo
     */
    public function setMaestro(\UNAM\AppBundle\Entity\Maestro $maestro = null)
    {
        $this->maestro = $maestro;

        return $this;
    }

    /**
     * Get maestro
     *
     * @return \UNAM\AppBundle\Entity\Maestro 
     */
    public function getMaestro()
    {
        return $this->maestro;
    }
}
