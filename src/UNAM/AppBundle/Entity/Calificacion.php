<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificacion
 *
 * @ORM\Table(name="calificaciones")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\CalificacionRepository")
 */
class Calificacion
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
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="calificaciones")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="calificaciones")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     */
    protected $alumno;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date")
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion", type="decimal")
     */
    private $calificacion;

    const STATUS_CURSANDO=1;
    const STATUS_APROBADO=2;
    const STATUS_REPROBADO=3;
        
    static public $sStatus=array(
        self::STATUS_CURSANDO=>'Cursando',
        self::STATUS_APROBADO=>'Aprobado',
        self::STATUS_REPROBADO=>'Reprobado',
    );
    
    public function getStringStatus(){
        return self::$sStatus[$this->getStatus()];
    }
    
    static function getArrayStatus(){
        return self::$sStatus;
    }
    
    static function getPreferedStatus(){
        return array(self::STATUS_CURSANDO);
    }
    
    const TIPO_INSCRITO=1;
    const TIPO_REINSCRITO=2;
        
    static public $sTipo=array(
        self::TIPO_INSCRITO=>'Inscrito',
        self::TIPO_REINSCRITO=>'Reinscrito',
    );
    
    public function getStringTipo(){
        return self::$sTipo[$this->getTipo()];
    }
    
    static function getArrayTipo(){
        return self::$sTipo;
    }
    
    static function getPreferedTipo(){
        return array(self::TIPO_INSCRITO);
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
     * Set status
     *
     * @param integer $status
     * @return Calificacion
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Calificacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return Calificacion
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set calificacion
     *
     * @param string $calificacion
     * @return Calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set grupo
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupo
     * @return Calificacion
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
     * @return Calificacion
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
}
