<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pago
 *
 * @ORM\Table(name="pagos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\PagoRepository")
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
     * @ORM\Column(name="descuento", type="integer")
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="datetime")
     */
    private $fechaPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_registro", type="integer")
     */
    private $usuarioRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_pago", type="integer")
     */
    private $usuarioPago;

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
     * @param integer $descuento
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
     * @return integer 
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
     * Set usuarioRegistro
     *
     * @param integer $usuarioRegistro
     * @return Pago
     */
    public function setUsuarioRegistro($usuarioRegistro)
    {
        $this->usuarioRegistro = $usuarioRegistro;

        return $this;
    }

    /**
     * Get usuarioRegistro
     *
     * @return integer 
     */
    public function getUsuarioRegistro()
    {
        return $this->usuarioRegistro;
    }

    /**
     * Set usuarioPago
     *
     * @param integer $usuarioPago
     * @return Pago
     */
    public function setUsuarioPago($usuarioPago)
    {
        $this->usuarioPago = $usuarioPago;

        return $this;
    }

    /**
     * Get usuarioPago
     *
     * @return integer 
     */
    public function getUsuarioPago()
    {
        return $this->usuarioPago;
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
}
