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
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="pagos")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @ORM\Id
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
}
