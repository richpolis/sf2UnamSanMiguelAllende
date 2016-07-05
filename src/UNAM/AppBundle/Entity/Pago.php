<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pago
 *
 * @ORM\Table(name="pagos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\PagoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pago
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
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="pagos")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="pagos")
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
     * @ORM\Column(name="descuento", type="decimal")
     */
    private $descuento;
    
    
    /**
     * @var double
     *
     * @ORM\Column(name="precio", type="decimal")
     */
    private $precio;

    /**
     * @var double
     *
     * @ORM\Column(name="pago", type="decimal")
     */
    private $pago;
    
    /**
     * @var double
     *
     * @ORM\Column(name="adeudo", type="decimal")
     */
    private $adeudo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="datetime")
     */
    private $fechaPago;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_registro_id", referencedColumnName="id")
     */
    private $usuarioRegistro;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_pago_id", referencedColumnName="id")
     */
    private $usuarioPago;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
     */
    private $createdAt;
    
    const STATUS_ADEDUDO=1;
    const STATUS_PAGADO=2;
    const STATUS_CANCELADO=3;
        
    static public $sStatus=array(
        self::STATUS_ADEDUDO=>'Adeudo',
        self::STATUS_PAGADO=>'Pagado',
        self::STATUS_CANCELADO=>'Cancelado',
    );
    
    public function getStringStatus(){
        return self::$sStatus[$this->getStatus()];
    }
    
    static function getArrayStatus(){
        return self::$sStatus;
    }
    
    static function getPreferedStatus(){
        return array(self::STATUS_ADEDUDO);
    }
    
    static public $sDescuentos=array(
        0=>'Sin descuento',
        5=>'5%',
        10=>'10%',
        15=>'15%',
        20=>'20%',
        25=>'25%',
        30=>'30%',
        35=>'35%',
        40=>'40%',
        45=>'45%',
        50=>'50%',
        55=>'55%',
        60=>'60%',
        65=>'65%',
        70=>'70%',
        75=>'75%',
        80=>'80%',
        85=>'85%',
        90=>'90%',
        95=>'95%',
        100=>'100%',
    );
    
    public function getStringDescuento(){
        return self::$sDescuentos[$this->getDescuento()];
    }
    
    static function getArrayDescuentos(){
        return self::$sDescuentos;
    }
    
    static function getPreferedDescuento(){
        return array(0);
    }
    
    /*
     * Timestable
     */
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
          $this->createdAt = new \DateTime();
        }
    }
	
	public function __construct()
	{
		
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
     * @return Pago
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
     * Set descuento
     *
     * @param string $descuento
     * @return Pago
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Pago
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set pago
     *
     * @param string $pago
     * @return Pago
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

    /**
     * Get pago
     *
     * @return string 
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set adeudo
     *
     * @param string $adeudo
     * @return Pago
     */
    public function setAdeudo($adeudo)
    {
        $this->adeudo = $adeudo;

        return $this;
    }

    /**
     * Get adeudo
     *
     * @return string 
     */
    public function getAdeudo()
    {
        return $this->adeudo;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     * @return Pago
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return \DateTime 
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Pago
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set grupo
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupo
     * @return Pago
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
     * @return Pago
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

    /**
     * Set usuarioRegistro
     *
     * @param \UNAM\AppBundle\Entity\Usuario $usuarioRegistro
     * @return Pago
     */
    public function setUsuarioRegistro(\UNAM\AppBundle\Entity\Usuario $usuarioRegistro = null)
    {
        $this->usuarioRegistro = $usuarioRegistro;

        return $this;
    }

    /**
     * Get usuarioRegistro
     *
     * @return \UNAM\AppBundle\Entity\Usuario 
     */
    public function getUsuarioRegistro()
    {
        return $this->usuarioRegistro;
    }

    /**
     * Set usuarioPago
     *
     * @param \UNAM\AppBundle\Entity\Usuario $usuarioPago
     * @return Pago
     */
    public function setUsuarioPago(\UNAM\AppBundle\Entity\Usuario $usuarioPago = null)
    {
        $this->usuarioPago = $usuarioPago;

        return $this;
    }

    /**
     * Get usuarioPago
     *
     * @return \UNAM\AppBundle\Entity\Usuario 
     */
    public function getUsuarioPago()
    {
        return $this->usuarioPago;
    }
}