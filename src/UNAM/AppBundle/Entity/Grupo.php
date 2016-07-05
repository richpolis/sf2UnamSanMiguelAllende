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
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="grupos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    protected $curso;
    
    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="grupo")
     */
    protected $pagos;
    
    /**
     * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="grupo")
     */
    protected $asistencias;
    
    /**
     * @ORM\OneToMany(targetEntity="Calificacion", mappedBy="grupo")
     */
    protected $calificaciones;
    
    /**
     * @ORM\ManyToOne(targetEntity="Maestro", inversedBy="grupos")
     * @ORM\JoinColumn(name="maestro_id", referencedColumnName="id")
     */
    protected $maestro;
    
    /**
     * @var \Booolean
     *
     * @ORM\Column(name="is_active", type="boolean",nullable=true)
     */
    private $isActive = true;
    
   
    public function __toString() {
        return $this->getNombreGrupoCompleto();
    }
    
    public function getNombreGrupoCompleto(){
        return "Grupo: ".$this->grupo." (".$this->fechaInicio->format('d-m-Y').")";
    }
    
    static public $sHorario=array(
        '07:00:00'=>'07:00 am',
        '07:30:00'=>'07:30 am',
        '08:00:00'=>'08:00 am',
        '08:30:00'=>'08:30 am',
        '09:00:00'=>'09:00 am',
        '09:30:00'=>'09:30 am',
        '10:00:00'=>'10:00 am',
        '10:30:00'=>'10:30 am',
        '11:00:00'=>'11:00 am',
        '11:30:00'=>'11:30 am',
        '12:00:00'=>'12:00 am',
        '12:30:00'=>'12:30 am',
        '13:00:00'=>'01:00 pm',
        '13:30:00'=>'01:30 pm',
        '14:00:00'=>'02:00 pm',
        '14:30:00'=>'02:30 pm',
        '15:00:00'=>'03:00 pm',
        '15:30:00'=>'03:30 pm',
        '16:00:00'=>'04:00 pm',
        '16:30:00'=>'04:30 pm',
        '17:00:00'=>'05:00 pm',
        '17:30:00'=>'05:30 pm',
        '18:00:00'=>'06:00 pm',
        '18:30:00'=>'06:30 pm',
        '19:00:00'=>'07:00 pm',
        '19:30:00'=>'07:30 pm',
        '20:00:00'=>'08:00 pm',
        '20:30:00'=>'08:30 pm',
        '21:00:00'=>'09:00 pm',
        '21:30:00'=>'09:30 pm',
        '22:00:00'=>'10:00 pm',
    );
    
    public function getStringHorario(){
        return self::$sHorario[$this->getHorario()];
    }
    
    static function getArrayHorarios(){
        return self::$sHorario;
    }
    
    static function getPreferedHorario(){
        return array('07:00:00');
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pagos = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
        $this->calificaciones = new ArrayCollection();
        $this->isActive = true;
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Grupo
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set curso
     *
     * @param \UNAM\AppBundle\Entity\Curso $curso
     * @return Grupo
     */
    public function setCurso(\UNAM\AppBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \UNAM\AppBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
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
     * Add asistencias
     *
     * @param \UNAM\AppBundle\Entity\Asistencia $asistencias
     * @return Grupo
     */
    public function addAsistencia(\UNAM\AppBundle\Entity\Asistencia $asistencias)
    {
        $this->asistencias[] = $asistencias;

        return $this;
    }

    /**
     * Remove asistencias
     *
     * @param \UNAM\AppBundle\Entity\Asistencia $asistencias
     */
    public function removeAsistencia(\UNAM\AppBundle\Entity\Asistencia $asistencias)
    {
        $this->asistencias->removeElement($asistencias);
    }

    /**
     * Get asistencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsistencias()
    {
        return $this->asistencias;
    }

    /**
     * Add calificaciones
     *
     * @param \UNAM\AppBundle\Entity\Calificacion $calificaciones
     * @return Grupo
     */
    public function addCalificacione(\UNAM\AppBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones[] = $calificaciones;

        return $this;
    }

    /**
     * Remove calificaciones
     *
     * @param \UNAM\AppBundle\Entity\Calificacion $calificaciones
     */
    public function removeCalificacione(\UNAM\AppBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones->removeElement($calificaciones);
    }

    /**
     * Get calificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalificaciones()
    {
        return $this->calificaciones;
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