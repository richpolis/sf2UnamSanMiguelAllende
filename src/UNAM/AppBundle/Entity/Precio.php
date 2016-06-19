<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Precio
 *
 * @ORM\Table(name="precios")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\PrecioRepository")
 */
class Precio
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
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="precios")
     */
    protected $cursos;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal")
     */
    private $precio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date")
     */
    private $fechaFinal;
}
